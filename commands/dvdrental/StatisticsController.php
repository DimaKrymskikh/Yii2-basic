<?php

namespace app\commands\dvdrental;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Query;

/**
 * Собирает статистику модуля dvdrental
 */
class StatisticsController extends Controller
{
    /**
     * Сохраняет данные о пользователях
     * @return int
     */
    public function actionUsersList(): int
    {
        $fileName = Yii::getAlias('@app') . '/files/commands/dvdrental/usersList_' . date_format(date_create(), 'Y-m-d');
        if (!$fp = fopen($fileName, "w+")) {
            Yii::error("Не удалось открыть или создать файл [$fileName]");
            return ExitCode::UNSPECIFIED_ERROR;
        }
        
        $users = (new Query)
                ->select([
                    'u.id', 
                    'u.login', 
                    'count(fu.film_id) AS n'
                ])
                ->from('info.users u')
                ->leftJoin('info.film_users fu', 'fu.user_id = u.id')
                ->groupBy(['u.id'])
                ->orderBy(['n' => SORT_DESC])
                ->all();
        
        foreach ($users as $user) {
            if (!fwrite($fp, "Пользователь {$user['login']}[{$user['id']}] владеет {$user['n']} фильмами \n")) {
                Yii::error("Не удалось записать данные в файл [$fileName]");
                return ExitCode::UNSPECIFIED_ERROR;
            }
        }
        
        fclose($fp);

        return ExitCode::OK;
    }
}
