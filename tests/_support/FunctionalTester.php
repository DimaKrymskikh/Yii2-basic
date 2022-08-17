<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class FunctionalTester extends \Codeception\Actor
{
    use _generated\FunctionalTesterActions;
    
    /**
     * Отправка данных формы при регистрации
     * @param string $login
     * @param string $password
     * @param string $verification
     * @return void
     */
    public function registration(string $login = '', string $password = '', string $verification = ''): void
    {
        $this->submitForm('#registration-form', [
            'RegistrationForm[login]' => $login,
            'RegistrationForm[password]' => $password,
            'RegistrationForm[verification]' => $verification,
        ]);
    }
    
    /**
     * Отправка данных формы при аутентификации
     * @param string|null $login
     * @param string|null $password
     */
    public function login(string $login = '', string $password = '')
    {
        $this->submitForm('#login-form', [
            'LoginForm[login]' => $login,
            'LoginForm[password]' => $password,
        ]);
    }
}
