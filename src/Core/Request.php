<?php
namespace Sedmit\Ronda\Core;

class Request
{
    private $get;
    private $post;
    private $files;
    private $server;
    private $params;
    public function __construct()
    {
        // инициализация свойств объекта значениями суперглобальных массивов
        $this->get = $_GET;
        $this->post = $_POST;
        $this->files = $_FILES;
        $this->server = $_SERVER;
    }
    // установка параметров запроса, например articles/{id}, где id - параметр запроса -> articles/1
    public function setParams($params){
        $this->params = $params;
    }
    public function getParams(){
        return $this->params;
    }
    // получение метода запроса
    public function getMethod(){
        return $this->server['REQUEST_METHOD'];
    }
    // получение строки запроса REQUEST_URI
    public function getUri(){
        return $this->server['REQUEST_URI'];
    }
    public function get(){
        return $this->get;
    }
    public function post(){
        return $this->post;
    }
    public function files(){
        return $this->files;
    }
    public function server(){
        return $this->server;
    }
    public function getIp() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $this->server['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $this->server['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $this->server['REMOTE_ADDR'];
        }
        return $ip;
    }
}