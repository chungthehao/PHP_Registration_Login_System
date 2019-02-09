<?php

namespace App\Controllers;

use \Core\View;
use \App\Models\User;

class Signup extends \Core\Controller {

    public function newAction()
    {
        View::renderTemplate('Signup/new.html');
    }

    public function createAction()
    {
        $user = new User($_POST);

        if ($user->save()) {
//            View::renderTemplate('Signup/success.html');

            # POST - Redirect - GET pattern
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/signup/success', true, 303);
            exit; // Best practice, browser ko can thong tin gi nua, no chi can chuyen trang (thuc hien GET request theo yeu cau)
        } else {
//            echo '<pre>';
//            var_dump($user->errors);

            View::renderTemplate('Signup/new.html', [
                'user'  => $user // pass User model instance (old values, validation errors)
            ]);
        }

    }

    public function successAction()
    {
        View::renderTemplate('Signup/success.html');
    }

}