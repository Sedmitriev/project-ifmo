<?php
namespace Sedmit\Ronda\Models;

use Sedmit\Ronda\Core\DBConnection;

class ServiceModel
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getServices() 
    {
        $sql = "SELECT * FROM `services`";
        return $this->db->queryAll($sql);
    }

    public function getServicesById($id) 
    {
        $sql = "SELECT visits.`visits_date`, doctors.`doctors_name`, services.`services_code`, services.`services_name`, services.`services_price`
                FROM `visits` INNER JOIN `medcard_visits` ON (visits.`visits_id` = medcard_visits.`visits_id`)
                LEFT JOIN `medcard` ON (medcard.`medcard_id` = medcard_visits.`medcard_id`)
                INNER JOIN `doctors_visits` ON (visits.`visits_id` = doctors_visits.`visits_id`)
                LEFT JOIN `doctors` ON (doctors.`doctors_id` = doctors_visits.`doctors_id`)
                INNER JOIN `services_visits` ON (visits.`visits_id` = services_visits.`visits_id`)
                LEFT JOIN `services` ON (services.`services_id` = services_visits.`services_id`)
                WHERE medcard.`medcard_id` = :id";
        return $this->db->execute($sql, ['id' => $id], true);
    }
}