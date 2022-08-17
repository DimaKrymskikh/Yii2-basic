<?php

use yii\helpers\Url;

/**
 * Тестирование главной страницы
 */
class MainPageCest
{
    public function _before(AcceptanceTester $I)
    {
        // Переход на главную страницу
        $I->amOnPage(Url::toRoute('/'));
    }

    /**
     * Убеждаемся, что открыта 'Главная страница'
     * @param AcceptanceTester $I
     */
    public function openMainPage(AcceptanceTester $I)
    {
        $I->see('Главная страница', 'h1');
    }
}
