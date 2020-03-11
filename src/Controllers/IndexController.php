<?php
namespace Sedmit\Ronda\Controllers;

use Sedmit\Ronda\Core\Controller;

class IndexController extends Controller
{

    public function indexAction() {
        $content = 'Main/index.php';
        $data = [
            "page_title" => 'Главная'
        ];
        return $this->generateResponse($content, $data);
    }

    public function aboutAction() {
        $content = 'Main/about.php';
        $data = [
            "page_title" => 'О нас'
        ];
        return $this->generateResponse($content, $data);
    }

    public function servicesAction() {
        $content = 'Main/services.php';
        $data = [
            "page_title" => 'Услуги'
        ];
        return $this->generateResponse($content, $data);
    }
}