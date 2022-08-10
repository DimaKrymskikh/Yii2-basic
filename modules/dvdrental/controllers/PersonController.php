<?php

namespace app\modules\dvdrental\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

use app\models\LoginForm;
use app\models\activeRecord\Film;
use app\models\activeRecord\InfoFilmUsers;
use app\modules\dvdrental\models\FilmSearch;

/**
 * Аккаунт
 */
class PersonController extends Controller
{
    public function behaviors(): array
    {
        return [
            // Пользователь должен быть аутентифицированным
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ]
                ],
            ],
            // Акшены, доступные только через post-запросы
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete-account' => ['post'],
                    'delete-film' => ['post'],
                    'adding-film' => ['post'],
                ],
            ],
        ];
    }
    
    /**
     * Отрисовка аккаунта
     * @return string
     */
    public function actionAccount(): string
    {
        $searchModel = new FilmSearch();
        $query = Film::find()
                ->joinWith('infoUsers', false, 'JOIN')
                ->where(['info.users.id' => Yii::$app->user->identity->id])
                ->with('language');
        
        return $this->render('account', [
            'model' => new LoginForm(),
            'searchModel' => $searchModel,
            'dataProvider' => $searchModel->search(Yii::$app->request->get(), $query),
        ]);
    }
    
    /**
     * Удаление аккаунта
     * @return Response
     */
    public function actionDeleteAccount(): Response
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->deleteAccount()) {
            Yii::$app->user->logout();
            return $this->goHome();
        } else {
            return $this->goBack();
        }
    }
    
    /**
     * Отрисовка карточки фильма
     * @return string
     */
    public function actionFilmCard(): string
    {
        return $this->render('filmCard', [
            'film' => Film::findOne(['film_id' => Yii::$app->request->get('filmId')]),
        ]);
    }
    
    /**
     * Добавление фильма в список пользователя
     * @return void
     */
    public function actionAddingFilm(): void
    {
        $infoFilmUsers = new InfoFilmUsers();
        $infoFilmUsers->film_id = Yii::$app->request->post('filmId');
        $infoFilmUsers->user_id = Yii::$app->user->identity->id;
        $infoFilmUsers->save();
    }
    
    /**
     * Получение данных фильма для модального окна, удаляющего фильм из списка пользователя
     * @return string
     */
    public function actionDataFilm(): string
    {
        $film = Film::findOne(['film_id' => Yii::$app->request->post('filmId')]);
        return json_encode([
            'filmId' => $film->film_id, 
            'title' => $film->title,
        ]);
    }
    
    /**
     * Удаление фильма из списка пользователя
     * @return Response
     */
    public function actionDeleteFilm(): Response
    {
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->checkingPassword()) {
            InfoFilmUsers::findOne([
                'user_id' => Yii::$app->user->identity->id,
                'film_id' => Yii::$app->request->post('film_id'),
            ])->delete();
        }
        return $this->redirect('/dvdrental/person/account');
    }
}
