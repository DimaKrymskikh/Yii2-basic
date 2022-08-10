<?php
use yii\bootstrap4\Modal;
use yii\bootstrap4\ActiveForm;

Modal::begin([
    'title' => 'Удаление фильма',
    'id' => 'modal-film-deleting',
    'footer' => '                    
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <button type="submit" class="btn btn-danger" form="film-deleting">Да</button>',
]);

echo 'Вы хотите удалить фильм <span id="deleted-film-name"></span>?';

$form = ActiveForm::begin([
    'id' => 'film-deleting',
    'action' => '/dvdrental/person/delete-film',
    'method' => 'post',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'col-lg-8 col-form-label mr-lg-3'],
        'inputOptions' => ['class' => 'col-lg-8 form-control'],
        'errorOptions' => ['class' => 'col-lg-8 invalid-feedback'],
    ],
]);

echo $form->field($model, 'password')->passwordInput()->label('Введите пароль:');

echo '<input type="hidden" id="deleted-film-film_id" name="film_id" value=""/>';

ActiveForm::end();

Modal::end();
