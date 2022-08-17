<?php

/**
 * Тестирование страницы 'Вход'
 */
class LoginFormCest
{
    public function _before(\FunctionalTester $I)
    {
        // Переход на страицу 'Вход'
        $I->amOnRoute('site/login');
        // Пользователь должен быть не аутентифицированным
        expect_that(\Yii::$app->user->isGuest);
    }

    /**
     * Открыта страница 'Вход'
     * @param \FunctionalTester $I
     */
    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('Вход', 'h1');
    }

    /**
     * Аутентификация с пустыми данными формы
     * @param \FunctionalTester $I
     */
    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->login();
        $I->expectTo('see validations errors');
        $I->see('Логин cannot be blank.');
        $I->see('Пароль cannot be blank.');
        // Пользователь остался не аутентифицированным
        expect_that(\Yii::$app->user->isGuest);
    }

    /**
     * Аутентификация с вводом ошибочного пароля
     * @param \FunctionalTester $I
     */
    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->login('TestUser', 'some_password');
        $I->expectTo('see validations errors');
        $I->see('Неверный логин или пароль.');
        // Пользователь остался не аутентифицированным
        expect_that(\Yii::$app->user->isGuest);
    }

    /**
     * Успешная аутентификация
     * @param \FunctionalTester $I
     */
    public function loginSuccessfully(\FunctionalTester $I)
    {
        $I->login('TestUser', 'test');
        $I->see('Аккаунт');
        $I->dontSeeElement('form#login-form');              
        // Произошла аутентифиция пользователя 
        expect_not(\Yii::$app->user->isGuest);
    }
}
