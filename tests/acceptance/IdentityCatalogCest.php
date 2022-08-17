<?php

use yii\helpers\Url;

/**
 * Тестирование страницы "Каталог" для аутентифицированного пользователя
 */
class IdentityCatalogCest
{
    public function _before(AcceptanceTester $I)
    {
        // Выполняем вход
        $I->login('TestUser', 'test');
        $I->wait(3);
        // Переход на страницу "Каталог"
        $I->amOnPage(Url::toRoute('/dvdrental/default/films'));
        $I->wait(3);
    }

    /**
     * Убеждаемся, что открыта страница "Каталог"
     * @param AcceptanceTester $I
     */
    public function openCatalog(AcceptanceTester $I)
    {
        $I->see('Фильмы', 'h1');
        $I->dontSeeElement('img.film-availability[src="/svg/check-circle.svg"][data-film_id="4"]');
        $I->click('img.adding-film[src="/svg/plus-circle.svg"][data-film_id="4"]');
        $I->wait(3);
        $I->seeElement('img.film-availability[src="/svg/check-circle.svg"][data-film_id="4"]');
    }
}
