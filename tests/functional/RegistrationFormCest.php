<?php

/**
 * Тестирование страницы 'Регистрация'
 */
class RegistrationFormCest
{
    public function _before(FunctionalTester $I)
    {
        // Переход на страицу 'Регистрация'
        $I->amOnRoute('site/registration');
        // Пользователь должен быть не аутентифицированным
        expect_that(\Yii::$app->user->isGuest);
    }

    /**
     * Проверка, что открыта страница 'Регистрация'
     * @param \FunctionalTester $I
     */
    public function openRegistrationPage(\FunctionalTester $I)
    {
        $I->see('Регистрация', 'h1');
    }

    /**
     * Регистрация с пустыми данными формы
     * @param \FunctionalTester $I
     */
    public function registrationWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->registration();
        $I->expectTo('see validations errors');
        $I->see('Логин cannot be blank.');
        $I->see('Пароль cannot be blank.');
        $I->see('Подтверждение пароля cannot be blank.');
        $I->seeElement('form#registration-form'); 
        // Пользователь остался не аутентифицированным
        expect_that(\Yii::$app->user->isGuest);
    }

    /**
     * Регистрация с ошибкой подтверждения пароля
     * @param \FunctionalTester $I
     */
    public function registrationWithWrongVerification(\FunctionalTester $I)
    {
        $I->registration('NewUser', 'some_password', 'other_password');
        $I->expectTo('see validations errors');
        $I->see('Введённый пароль не совпадает с подверждённым.');
        $I->seeElement('form#registration-form');              
        // Пользователь остался не аутентифицированным
        expect_that(\Yii::$app->user->isGuest);
    }

    /**
     * Регистрация с сущуствующим логином
     * @param \FunctionalTester $I
     */
    public function registrationWithExistenceLogin(\FunctionalTester $I)
    {
        $I->registration('TestUser', 'some_password', 'some_password');
        $I->expectTo('see validations errors');
        $I->see('Данный логин уже существует.');
        $I->seeElement('form#registration-form');              
        // Пользователь остался не аутентифицированным
        expect_that(\Yii::$app->user->isGuest);
    }

    /**
     * Успешная регистрация
     * @param FunctionalTester $I
     */
    public function registrationSuccessfully(FunctionalTester $I)
    {
        $I->registration('NewUser', 'some_password', 'some_password');
        $I->see('Аккаунт', 'a');
        $I->see('Выход', 'button');
        $I->dontSee('Вход', 'a');              
        $I->dontSeeElement('form#registration-form');    
        // Произошла аутентифиция пользователя 
        expect_not(\Yii::$app->user->isGuest);
    }
}
