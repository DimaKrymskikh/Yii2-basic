<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;

/**
 * Модель формы входа
 * Также используется при подтверждении действия аутентификации пользователя, когда вводится только пароль
 *
 * @property $login - логин пользователя
 * @property $password - пароль пользователя
 * @property bool $rememberMe - нужно ли сохранять куки пользователя при закрытии браузера
 * @property User|null $_user - хранит пользователя, чтобы выполнялся один запрос в базу
 */
class LoginForm extends Model
{
    // почему-то yii не даёт типизировать $login и $password
    public $login;
    public $password;
    public bool $rememberMe = true;

    private $_user = false;

    /**
     * @return array - правила проверки
     */
    public function rules(): array
    {
        return [
            // login и password обязательные для заполнения
            [['login', 'password'], 'required'],
            // rememberMe булевое
            ['rememberMe', 'boolean'],
            // password проверяется методом validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    
    /**
     * @return array - атрибуты формы
     */
    public function attributeLabels(): array
    {
        return [
            'login' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить',
        ];
    }

    /**
     * Получает данные пользователя и проверяет введённый пароль с существующим
     * @param string $attribute - см. метод rules()
     * @return void
     */
    public function validatePassword(string $attribute): void
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser(); 

            if (!$user || !password_verify($this->password, $user->password)) {
                $this->addError($attribute, 'Неверный логин или пароль.');
            }
        }
    }

    /**
     * Выполняет вход пользователя, используя введённые логин и пароль
     * @return bool - Если пользователь вошёл в систему, возвращается true, иначе - false
     */
    public function login(): bool
    {
        if ($this->validate()) {
            // Изменяем ключ авторизации при входе пользователя
            $this->_user->auth_key = Yii::$app->security->generateRandomString();
            $this->_user->save();
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
    
    /**
     * По логину извлекаем данные пользователя
     * @return User|null
     */
    private function getUser(): ?User
    {
        if ($this->_user === false) {
            // Если логин вводился (форма входа), используем этот введённый логин.
            // Если логин не вводился (форма с паролью для аутентифицированного пользователя), берём логин из $app
            $this->_user = User::findByLogin($this->login ?: Yii::$app->user->identity->login);
        }

        return $this->_user;
    }
    
    /**
     * Удаляет пользователя (удаляет запись в таблице 'info.users')
     * @return bool - Возврящает true при успешном удалении пользователя и false - при неудачном
     */
    public function deleteAccount(): bool
    {
        $user = $this->getUser();
        if (password_verify($this->password, $user->password)) {
            $user->delete();
            return true;
        }
        return false;
    }
    
    /**
     * Проверка пароля
     * @return bool
     */
    public function checkingPassword(): bool
    {
        $user = $this->getUser();
        return password_verify($this->password, $user->password);
    }
}
