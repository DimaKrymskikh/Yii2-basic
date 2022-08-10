<?php

namespace app\grid;

/**
 * GridView для списка фильмов
 */
class GridView extends \yii\grid\GridView
{
    const DEFAULT_MAX_BUTTON_COUNT = 5;
    
    public function init(): void
    {
        parent::init();
        $this->setPager();
        $this->setSummary();
    }
    
    /**
     * Задаёт пагинацию
     * @return void
     */
    private function setPager(): void
    {
        $this->pager = [
            'disableCurrentPageButton' => true,
            'maxButtonCount' => self::DEFAULT_MAX_BUTTON_COUNT,
            'activePageCssClass' => 'pagination-gridview-active',
            'pageCssClass' => 'pagination-gridview',
            'prevPageCssClass' => 'pagination-gridview-prev',
            'nextPageCssClass' => 'pagination-gridview-next',
        ];
    }
    
    /**
     * Задаёт саммери
     * @return void
     */
    private function setSummary(): void
    {
        $this->summary = 'Показано <b>{begin}-{end}</b> фильмов из <b>{totalCount}</b>';
    }
}
