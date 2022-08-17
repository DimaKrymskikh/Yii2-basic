<?php

use yii\helpers\Url;

/**
 * Тестирование страницы "Каталог" для не аутентифицированного пользователя
 */
class CatalogCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/dvdrental/default/films'));
    }

    /**
     * Убеждаемся, что открыта страница "Каталог"
     * @param AcceptanceTester $I
     */
    public function openCatalog(AcceptanceTester $I)
    {
        $I->see('Фильмы', 'h1');
        // Не залогиненный пользователь не видит элементы, которые видит залогиненный пользователь
        $I->dontSeeElement('.adding-film');
        $I->dontSeeElement('.film-availability');
    }
}
