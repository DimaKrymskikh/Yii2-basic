<?php
use yii\bootstrap4\Modal;
use yii\bootstrap4\ActiveForm;

Modal::begin([
    'title' => 'Удаление аккаунта',
    'toggleButton' => [
        'label' => 'Удалить',
        'class' => 'btn btn-danger',
        'title' => 'Удаление аккаунта'
    ],
    'footer' => '                    
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <button type="submit" class="btn btn-danger" form="delete-account">Да</button>',
]);

echo 'Вы хотите удалить свой аккаунт?';

$form = ActiveForm::begin([
    'id' => 'delete-account',
    'action' => '/dvdrental/person/delete-account',
    'method' => 'post',
    'fieldConfig' => [
        'template' => "{label}\n{input}\n{error}",
        'labelOptions' => ['class' => 'col-lg-8 col-form-label mr-lg-3'],
        'inputOptions' => ['class' => 'col-lg-8 form-control'],
        'errorOptions' => ['class' => 'col-lg-8 invalid-feedback'],
    ],
]);
        
echo $form->field($model, 'password')->passwordInput()->label('Введите пароль:');

ActiveForm::end();

Modal::end();
