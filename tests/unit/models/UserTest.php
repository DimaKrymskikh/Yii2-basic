<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->login)->equals('Dima');

        expect_not(User::findIdentity(999));
    }

    public function testFindUserByUsername()
    {
        expect_that($user = User::findByLogin('Dima'));
        expect_not(User::findByLogin('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
//    public function testValidateUser($user)
//    {
//        $user = User::findByLogin('admin');
//        expect_that($user->validateAuthKey('test100key'));
//        expect_not($user->validateAuthKey('test102key'));
//
//        expect_that($user->validatePassword('admin'));
//        expect_not($user->validatePassword('123456'));        
//    }

}
