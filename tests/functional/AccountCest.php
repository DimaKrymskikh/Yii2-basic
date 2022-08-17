<?php

use app\models\User;

/*
 * Тестирование страницы 'Аккаунт'
 */
class AccountCest
{
    /**
     * Для попадания на страницу 'Аккаунт' пользователь должен быть аутентифицированным
     * @param FunctionalTester $I
     */
    public function openAccountPage(FunctionalTester $I)
    {
        // Выполняем вход
        $I->amLoggedInAs(User::findByLogin('TestUser'));
        // Переход на страицу 'Аккаунт'
        $I->amOnRoute('dvdrental/person/account');
        $I->see('Аккаунт', 'h1');
        $I->see(\Yii::$app->user->identity->login, 'h1');
    }

    /**
     * Не аутентифицированный пользователь не может попасть на страницу 'Аккаунт'
     * @param FunctionalTester $I
     */
    public function dontOpenAccountPage(FunctionalTester $I)
    {
        // Переход на страицу 'Аккаунт'
        $I->amOnRoute('dvdrental/person/account');
        $I->dontSee('Аккаунт', 'h1');
    }
}
