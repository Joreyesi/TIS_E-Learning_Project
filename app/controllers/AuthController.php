<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\User;


class AuthController extends Controller
{

  public function login()
  {

    $this->setLayout('auth');
    return $this->render('login');
  }
 
  public function register(Request $request)
  {
    $registerModel = new User();
    if ($request->isPost()) {
        $registerModel->loadData($request->getBody());

      if ($registerModel->validate() && $registerModel->register()) {
        return 'Exito';
      }
        

      return $this->render('register', [
        'model' => $registerModel
      ]);
    }
    $this->setLayout('auth');
    return $this->render('register', [
      'model' => $registerModel
    ]);
  }
}