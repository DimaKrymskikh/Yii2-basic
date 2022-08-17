<?php
namespace tests\unit\models;

use app\models\RegistrationForm;

class RegistrationFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    private RegistrationForm $model;


    protected function _before()
    {
    }

    protected function _after()
    {
    }

    /**
     * При регистрации введённый пароль не совпадает с существующим
     */
    public function testWrongPasswordVerification()
    {
        $this->model = new RegistrationForm([
            'login' => 'NewUser',
            'password' => 'some_password',
            'verification' => 'other_password'
        ]);
        
        expect_not($this->model->registration());
        expect($this->model->errors)->hasKey('password');
        expect($this->model->errors)->hasntKey('login');
    }

    /**
     * При регистрации введён существующий логин 
     */
    public function testLoginAlreadyExistence()
    {
        $this->model = new RegistrationForm([
            'login' => 'TestUser',
            'password' => '123456',
            'verification' => '123456'
        ]);
        
        expect_not($this->model->registration());
        expect($this->model->errors)->hasKey('login');
        expect($this->model->errors)->hasntKey('password');
    }

    /**
     * При регистрации введён новый логин и введённый пароль совпадает с существующим
     */
    public function testCorrectRegistration()
    {
        $this->model = new RegistrationForm([
            'login' => 'NewUser',
            'password' => 'some_password',
            'verification' => 'some_password'
        ]);
        
        expect_that($this->model->registration());
        expect($this->model->errors)->hasntKey('password');
        expect($this->model->errors)->hasntKey('login');
    }
}
