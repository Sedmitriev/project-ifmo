<?php
namespace Sedmit\Ronda\Models;

use Exception;
use Sedmit\Ronda\Core\DBConnection;

class MedcardModel
{
    private $db;
    const SHOW_BY_DEFAULT = 10;

    public function __construct()
    {
        $this->db = DBConnection::getInstance();
    }

    public function getMedcardList($page = 1)
    {
       $page = intval($page);
       $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $sql = "SELECT patients.`patients_surname`, patients.`patients_name`, patients.`patients_patronymic`, patients.`patients_dob`, medcard.`medcard_id`
                FROM `patients` INNER JOIN `medcard_patients` ON (patients.`patients_id` = medcard_patients.`patients_id`)
                LEFT JOIN `medcard` ON (medcard.`medcard_id` = medcard_patients.`medcard_id`)
                ORDER BY medcard.`medcard_id` DESC LIMIT ".$offset.", ".self::SHOW_BY_DEFAULT;

        return $this->db->queryAll($sql);
    }

    public function getAllMedcards()
    {
        $query = "SELECT COUNT(*) as `count` FROM medcard";
        $result = $this->db->query($query);

        return $result['count'];
    }

    public function addNewMedcard(array $newMedcard)
    {
        $sqlMedcard = "INSERT INTO medcard (medcard_id, medcard_date) VALUES (:medcard_id, :medcard_date)";
        $sqlPatient = "INSERT INTO patients (patients_surname, patients_name, patients_patronymic, patients_dob, patients_tel, patients_sex,
                        patients_addr, patients_passp_series, patients_passp_number, patients_passp_issued_by, patients_passp_date,
                        patients_passp_code, patients_insur, patients_job, patients_drugIntolerance) VALUES (:patients_surname, :patients_name, :patients_patronymic,
                        :patients_dob, :patients_tel, :patients_sex, :patients_addr, :patients_passp_series, :patients_passp_number, :patients_passp_issued_by, :patients_passp_date,
                        :patients_passp_code, :patients_insur, :patients_job, :patients_drugIntolerance);";
        $sqlMedcardPatient ="INSERT INTO medcard_patients (medcard_id, patients_id) VALUES (:medcard_id, :patients_id)";
        try {
            $this->db->getConnection()->beginTransaction();
            $paramsMedcard = [
                "medcard_id" => $newMedcard['medcard_id'],
                "medcard_date" => $newMedcard['medcard_date'],
            ];
            $this->db->executeSql($sqlMedcard, $paramsMedcard);

            $paramsPatient = [
                "patients_surname" => $newMedcard['patients_surname'],
                "patients_name" => $newMedcard['patients_name'],
                "patients_patronymic" => $newMedcard['patients_patronymic'],
                "patients_dob" => $newMedcard['patients_dob'],
                "patients_tel" => $newMedcard['patients_tel'],
                "patients_sex" => $newMedcard['patients_sex'],
                "patients_addr" => $newMedcard['patients_addr'],
                "patients_passp_series" => $newMedcard['patients_passp_series'],
                "patients_passp_number" => $newMedcard['patients_passp_number'],
                "patients_passp_issued_by" => $newMedcard['patients_passp_issued_by'],
                "patients_passp_date" => $newMedcard['patients_passp_date'],
                "patients_passp_code" => $newMedcard['patients_passp_code'],
                "patients_insur" => $newMedcard['patients_insur'],
                "patients_job" => $newMedcard['patients_job'],
                "patients_drugIntolerance" => $newMedcard['patients_drugIntolerance']
            ];
            $this->db->executeSql($sqlPatient, $paramsPatient);

            $paramsMedcardPatient = [
                "medcard_id" => $newMedcard['medcard_id'],
                "patients_id" => $this->db->getConnection()->lastInsertId()
            ];
            $this->db->executeSql($sqlMedcardPatient, $paramsMedcardPatient);

            $this->db->getConnection()->commit();
        } catch(Exception $e) {
            $this->db->getConnection()->rollBack();
        }  
    }

    public function getMedcardById($id) {
        $sql = "SELECT patients.*, medcard.`medcard_id`, medcard.`medcard_date`
                FROM `patients` INNER JOIN `medcard_patients` ON (patients.`patients_id` = medcard_patients.`patients_id`)
                LEFT JOIN `medcard` ON (medcard.`medcard_id` = medcard_patients.`medcard_id`)
                WHERE medcard.`medcard_id` = :id";
        return $this->db->execute($sql, ['id' => $id], false);
    }

    public function deleteMedcardById($id) {
        $patientId = $this->patientIdFromMedcardPatient($id)['patients_id'];
        $sqlPatient = "DELETE FROM `patients` WHERE patients_id = :patientId";
        $sqlMedcard = "DELETE FROM `medcard` WHERE medcard.`medcard_id` = :medcardId";
        try {
            $this->db->getConnection()->beginTransaction();

            $this->db->executeSql($sqlPatient, ["patientId" => $patientId]);

            $this->db->executeSql($sqlMedcard, ["medcardId" => $id]);

            $this->db->getConnection()->commit();
            return true;
        } catch(Exception $e) {
            $this->db->getConnection()->rollBack();
            return false;
        }  
    }

    public function updateMedcardById(array $medcard) {
        $patientId = $this->patientIdFromMedcardPatient($medcard['medcard_id'])['patients_id'];
        $sqlMedcard = "UPDATE medcard SET medcard_id = :medcard_id, medcard_date = :medcard_date WHERE medcard_id = :id;";
        $sqlPatient = "UPDATE patients SET patients_surname = :patients_surname, patients_name = :patients_name, patients_patronymic = :patients_patronymic, 
                        patients_dob = :patients_dob, patients_tel = :patients_tel, patients_sex = :patients_sex,
                        patients_addr = :patients_addr, patients_passp_series = :patients_passp_series, 
                        patients_passp_number = :patients_passp_number, patients_passp_issued_by = :patients_passp_issued_by,
                        patients_passp_date = :patients_passp_date, patients_passp_code = :patients_passp_code,
                        patients_insur = :patients_insur, patients_job = :patients_job,
                        patients_drugIntolerance = :patients_drugIntolerance WHERE patients_id = :patient_id;";
                try {
                    $this->db->getConnection()->beginTransaction();
                    $paramsMedcard = [
                        "id" => $medcard['medcard_id'],
                        "medcard_id" => $medcard['medcard_id'],
                        "medcard_date" => $medcard['medcard_date']
                    ];
                    $this->db->executeSql($sqlMedcard, $paramsMedcard);
        
                    $paramsPatient = [
                        "patient_id" => $patientId,
                        "patients_surname" => $medcard['patients_surname'],
                        "patients_name" => $medcard['patients_name'],
                        "patients_patronymic" => $medcard['patients_patronymic'],
                        "patients_dob" => $medcard['patients_dob'],
                        "patients_tel" => $medcard['patients_tel'],
                        "patients_sex" => $medcard['patients_sex'],
                        "patients_addr" => $medcard['patients_addr'],
                        "patients_passp_series" => $medcard['patients_passp_series'],
                        "patients_passp_number" => $medcard['patients_passp_number'],
                        "patients_passp_issued_by" => $medcard['patients_passp_issued_by'],
                        "patients_passp_date" => $medcard['patients_passp_date'],
                        "patients_passp_code" => $medcard['patients_passp_code'],
                        "patients_insur" => $medcard['patients_insur'],
                        "patients_job" => $medcard['patients_job'],
                        "patients_drugIntolerance" => $medcard['patients_drugIntolerance']
                    ];
                    $this->db->executeSql($sqlPatient, $paramsPatient);
        
                    $this->db->getConnection()->commit();
                    return true;
                } catch(Exception $e) {
                    $this->db->getConnection()->rollBack();
                    return $e->getMessage();
                }  
    }

    private function patientIdFromMedcardPatient($medcardId) {
        $sql = "SELECT patients_id FROM medcard_patients WHERE medcard_id = :medcardId";
        return $this->db->execute($sql, ['medcardId' => $medcardId], false);
    }

    public function searchMedcardByNmb($search) {
        $sql = "SELECT patients.*, medcard.`medcard_id`, medcard.`medcard_date`
                FROM `patients` INNER JOIN `medcard_patients` ON (patients.`patients_id` = medcard_patients.`patients_id`)
                LEFT JOIN `medcard` ON (medcard.`medcard_id` = medcard_patients.`medcard_id`)
                WHERE medcard.`medcard_id` = :medcardId";
        return $this->db->execute($sql, ['medcardId' => $search]);
    }

    public function searchMedcardBySurname($search) {
        $sql = "SELECT patients.*, medcard.`medcard_id`, medcard.`medcard_date`
                FROM `patients` INNER JOIN `medcard_patients` ON (patients.`patients_id` = medcard_patients.`patients_id`)
                LEFT JOIN `medcard` ON (medcard.`medcard_id` = medcard_patients.`medcard_id`)
                WHERE patients.`patients_surname` = :surname";
        return $this->db->execute($sql, ['surname' => $search]);
    }

    public function getMedcards()
    {
        $sql = "SELECT patients.`patients_surname`, patients.`patients_name`, patients.`patients_patronymic`, medcard.`medcard_id`
                FROM `patients` INNER JOIN `medcard_patients` ON (patients.`patients_id` = medcard_patients.`patients_id`)
                LEFT JOIN `medcard` ON (medcard.`medcard_id` = medcard_patients.`medcard_id`)";
        return $this->db->queryAll($sql);
    }
}