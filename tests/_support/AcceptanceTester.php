<?php

use yii\helpers\Url;

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
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function login(string $login, string $password)
    {
//        if ($this->loadSessionSnapshot('LoginForm[login]')) {
//            return;
//        }
        $this->amOnPage(Url::toRoute('/site/login'));
        $this->submitForm('#login-form', [
            'LoginForm[login]' => $login,
            'LoginForm[password]' => $password,
        ]);
//        $this->saveSessionSnapshot('LoginForm[login]');
    }
}
