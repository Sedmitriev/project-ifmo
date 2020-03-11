<?php
namespace Sedmit\Ronda\Controllers;

use Sedmit\Ronda\Core\Request;
use Sedmit\Ronda\Core\Controller;
use Sedmit\Ronda\Models\LoginModel;

class LoginController extends Controller
{
    private $loginModel;

    public function __construct()
    {
        $this->loginModel = new LoginModel();
    }

    public function indexAction() {
        $content = 'Login/login.php';
        $data = [
            "page_title" => 'Главная'
        ];
        return $this->generateResponse($content, $data);
    }

    public function regAction() {
        $content = 'Login/registration.php';
        $data = [
            'page_title'=>'Регистрация',
        ];

        return $this->generateResponse($content, $data);
    }

    public function addUserAction(Request $request) {
        //$user_data = $request->post();
        $result = $this->loginModel->addUser($request->post());
        $content = 'Login/registration.php';
        $data = [
            'page_title'=>'Регистрация',
            'result' => $result
        ];
        return $this->generateResponse($content, $data);
    }

    public function loginAction(Request $request) {
        $formData = $request->post();
        $result = $this->loginModel->login($formData);
        if ($result === LoginModel::SUCCESS) {
            $_SESSION['login'] = $formData['users_login'];
        }
        return $this->ajaxResponse($result);
    }

    public function logoutAction() {
        unset($_SESSION['login']);
        header('Location: /');
    }
}