<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\User;

/**
 * Модель формы регистрации пользователя
 */
class RegistrationForm extends Model
{
    public $login;
    public $password;
    public $verification;
    
    /**
     * @return array - правила проверки
     */
    public function rules(): array
    {
        return [
            // Все поля формы обязательные при заполнении
            [['login', 'password', 'verification'], 'required'],
            // Проверка совпадения пароля с его подтверждением
            ['password', 'passwordVerification'],
            // Проверяется существование логина в info.users
            ['login', 'loginExistence'],
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
            'verification' => 'Подтверждение пароля',
        ];
    }
    
    /**
     * Регистрация пользователя (содание новой записи в таблице 'info.users') 
     * @return bool - Если запись выполняется успешно, то возвращается true, иначе - false
     */
    public function registration(): bool
    {
        if ($this->validate()) {
            $user = new User();
            $user->login = $this->login;
            $user->password = password_hash($this->password, PASSWORD_DEFAULT);
            $user->save();
            Yii::$app->user->login($user);
            return true;
        }
        
        return false;
    }
    
    /**
     * Проверяется существование логина в таблице 'info.users'
     * @param string $attribute - см. метод rules()
     * @return void
     */
    public function loginExistence(string $attribute): void
    {
        if (User::findByLogin($this->login)) {
            $this->addError($attribute, 'Данный логин уже существует.');
        }
    }
    
    /**
     * Проверка совпадения пароля с его подтверждением
     * @param string $attribute - см. метод rules()
     * @return void
     */
    public function passwordVerification(string $attribute): void
    {
        if ($this->password !== $this->verification) {
            $this->addError($attribute, 'Введённый пароль не совпадает с подверждённым.');
        }
    }
}
