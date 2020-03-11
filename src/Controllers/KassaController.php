<?php
namespace Sedmit\Ronda\Controllers;

use Sedmit\Ronda\Core\Request;
use Sedmit\Ronda\Core\Controller;
use Sedmit\Ronda\Components\AtolPrinter;

class KassaController extends Controller
{
    public function indexAction(Request $request) {
        $ip = $request->getIp();
        $uri = 'http://' . $ip . ':16732';
        $kassa = new AtolPrinter($uri);
        $kassa->connect();
        $checkConnect = $kassa->checkConnect();
        $checkKKT = $kassa->checkKKT();
        $content = 'Kassa/index.php';
        $data = [
            'page_title'=>'ККТ',
            'checkConnect' => $checkConnect,
            'checkKKT' => $checkKKT
        ];
        return $this->generateResponse($content, $data);
    }
}