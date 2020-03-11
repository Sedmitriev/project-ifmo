<?php
namespace Sedmit\Ronda\Models;

use Sedmit\Ronda\Core\DBConnection;

class DoctorModel
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getDoctors() 
    {
        $sql = "SELECT * FROM `doctors`";
        return $this->db->queryAll($sql);
    }
}