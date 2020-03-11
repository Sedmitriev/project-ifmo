<?php
namespace Sedmit\Ronda\Models;

use Exception;
use Sedmit\Ronda\Core\DBConnection;

class VisitModel
{
    private $db;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getVisits() {
        $sql = "SELECT visits.`visits_id`, visits.`visits_date`, doctors.`doctors_name`, medcard.`medcard_id`, services.`services_id`, 
                services.`services_code`, services.`services_type`, services.`services_name`, services.`services_price`, services_visits.`services_count`
                FROM `visits` INNER JOIN `medcard_visits` ON (visits.`visits_id` = medcard_visits.`visits_id`)
                LEFT JOIN `medcard` ON (medcard.`medcard_id` = medcard_visits.`medcard_id`)
                INNER JOIN `doctors_visits` ON (visits.`visits_id` = doctors_visits.`visits_id`)
                LEFT JOIN `doctors` ON (doctors.`doctors_id` = doctors_visits.`doctors_id`)
                INNER JOIN `services_visits` ON (visits.`visits_id` = services_visits.`visits_id`)
                LEFT JOIN `services` ON (services.`services_id` = services_visits.`services_id`)";
        $result = $this->db->queryAll($sql);
        foreach($result as $item) {
            $data .= '{ "id": "' . $item['visits_id'] . '", "start": "' . $item['visits_date'] . '", "title": "' . 'Врач - ' . $item['doctors_name'] . ' | Номер карты - ' . $item['medcard_id'] . ' | Id услуги - ' . $item['services_id'] . ' | Код услуги - ' . $item['services_code'] . ' | Услуга - ' . $item['services_name'] . ' Стоимость - ' . $item['services_price'] . ' Кол-во - ' . $item['services_count'] . '" },';
        }
      
        return $data;
    }

    public function getVisitById($id) {
        $sql = "SELECT visits.`visits_id`, visits.`visits_date`, doctors.`doctors_name`, medcard.`medcard_id`, 
                patients.`patients_surname`, patients.`patients_name`, patients.`patients_patronymic`, services.`services_id`, services.`services_code`, 
                services.`services_type`, services.`services_name`, services.`services_price`, services_visits.`services_count`
                FROM `medcard` INNER JOIN `medcard_visits` ON (medcard.`medcard_id` = medcard_visits.`medcard_id`) 
                LEFT JOIN `visits` ON (visits.`visits_id` = medcard_visits.`visits_id`) 
                INNER JOIN `medcard_patients` ON (medcard.`medcard_id` = medcard_patients.`medcard_id`) 
                LEFT JOIN `patients` ON (patients.`patients_id` = medcard_patients.`patients_id`) 
                INNER JOIN `doctors_visits` ON (visits.`visits_id` = doctors_visits.`visits_id`) 
                LEFT JOIN `doctors` ON (doctors.`doctors_id` = doctors_visits.`doctors_id`) 
                INNER JOIN `services_visits` ON (visits.`visits_id` = services_visits.`visits_id`) 
                LEFT JOIN `services` ON (services.`services_id` = services_visits.`services_id`) 
                WHERE visits.`visits_id` = :id";
        return $this->db->execute($sql, ['id' => $id], true);
    }

    public function addNewVisit(array $visit_data) {
        $queryVisit = "INSERT INTO visits SET visits_date = :visitDate";
        $queryDoctorVisit = "INSERT INTO doctors_visits SET doctors_id = :doctorId, visits_id = :visitId";
        $queryMedcardVisit = "INSERT INTO medcard_visits SET medcard_id = :medcardId, visits_id = :visitId"; 
        $queryServicesVisit = "INSERT INTO services_visits SET services_id = :serviceId, visits_id = :visitId, services_count = :servicesCount";
        try {
            $this->db->getConnection()->beginTransaction();
            $visitParams = [
                "visitDate" => $visit_data['date']
            ];
            $this->db->executeSql($queryVisit, $visitParams);

            $lastVisitId = $this->db->getConnection()->lastInsertId();
            $doctorVisitParams = [
                "doctorId" => $visit_data['doctor'],
                "visitId" => $lastVisitId
            ];
            $this->db->executeSql($queryDoctorVisit, $doctorVisitParams);

            $medcardVisitParams = [
                "medcardId" => $visit_data['medcard'],
                "visitId" => $lastVisitId
            ];
            $this->db->executeSql($queryMedcardVisit, $medcardVisitParams);

            $countServices = count($visit_data['service']);
            for ($i = 0; $i < $countServices; $i++) {
                $servicesVisitParams = [
                    "serviceId" => $visit_data['service'][$i],
                    "visitId" => $lastVisitId,
                    "servicesCount" => $visit_data['services_count'][$i]
                ];
                $this->db->executeSql($queryServicesVisit, $servicesVisitParams);
              }
            $this->db->getConnection()->commit();
            return true;
              
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return false;
        }
    }

    public function insertNewMedcard($medcard_data)
    {
        $day = date("Y-m-d");
        $queryMedcard = "INSERT INTO medcard SET medcard_id = :medcardId, medcard_date = :medcardDate";
        $queryPatients = "INSERT INTO patients SET patients_surname = :surname, patients_name = :name, patients_patronymic = :patronymic, patients_tel = :tel";
        $query = "INSERT INTO medcard_patients SET medcard_id = :medcardId, patients_id = :patientId";
        try {
            $this->db->getConnection()->beginTransaction();
            $medcardParams = [
                'medcardId' => $medcard_data['medcard'],
                'medcardDate' => $day
            ];
            $this->db->executeSql($queryMedcard, $medcardParams);

            $patientsParams = [
                'surname' => $medcard_data['patients_surname'],
                'name' => $medcard_data['patients_name'],
                'patronymic' => $medcard_data['patients_patronymic'],
                'tel' => $medcard_data['patients_tel']
            ];
            $this->db->executeSql($queryPatients, $patientsParams);
            $lastpatientId = $this->db->getConnection()->lastInsertId();

            $queryParams = [
                'medcardId' => $medcard_data['medcard'],
                'patientId' => $lastpatientId
            ];
            $this->db->executeSql($query, $queryParams);
            $this->db->getConnection()->commit();
            $this->addNewVisit($medcard_data);

            return true;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return $e;
        }
    }

    public function deleteVisit($id)
    {
        $sql = "DELETE FROM `visits` WHERE visits_id = :id";
        return $this->db->executeSql($sql, ["id" => $id]);
    }

    public function updateVisit($visit_data)
    {
        $delVisit = "DELETE FROM `services_visits` WHERE visits_id = :visitId";
        $insertServicesVisit = "INSERT INTO `services_visits` SET services_id = :servicesId, visits_id = :visitId, services_count = :servicesCount;";
        try {
            $this->db->getConnection()->beginTransaction();
            $this->db->executeSql($delVisit, ["visitId" => $visit_data['visits_id']]);

            $countServices = count($visit_data['service']);
            $servicesVisitParams = [];
            for ($i = 0; $i < $countServices; $i++) {
                $servicesVisitParams[$i] = [
                    "servicesId" => $visit_data['service'][$i],
                    "visitId" => $visit_data['visits_id'],
                    "servicesCount" => $visit_data['services_count'][$i]
                ];
                $this->db->executeSql($insertServicesVisit, $servicesVisitParams[$i]);
            }
            $this->db->getConnection()->commit();
            return true;
        } catch (Exception $e) {
            $this->db->getConnection()->rollBack();
            return $e;
        }
    }
}