<?php
namespace Sedmit\Ronda\Controllers;

use Sedmit\Ronda\Core\Request;
use Sedmit\Ronda\Core\Controller;
use Sedmit\Ronda\Models\VisitModel;
use Sedmit\Ronda\Models\DoctorModel;
use Sedmit\Ronda\Models\MedcardModel;
use Sedmit\Ronda\Models\ServiceModel;

class VisitController extends Controller
{
    private $visitModel;
    private $medcardModel;
    private $doctorModel;
    private $serviceModel;

    public function __construct()
    {
        $this->visitModel = new VisitModel();
        $this->medcardModel = new MedcardModel();
        $this->doctorModel = new DoctorModel();
        $this->serviceModel = new ServiceModel();
    }

    public function indexAction() {
        $visits = $this->visitModel->getVisits();
        $medcards = $this->medcardModel->getMedcards();
        $doctors = $this->doctorModel->getDoctors();
        $services = $this->serviceModel->getServices();
        $content = 'Visit/calendar.php';
        $data = [
            'page_title' => 'Журнал записи',
            'visits' => $visits,
            'medcards' => $medcards,
            'doctors' => $doctors,
            'services' => $services
        ];
        return $this->generateResponse($content, $data);
    }

    public function setAction(Request $request) 
    {
        $visitId = json_decode($request->post()['id'], true)['id'];
        $visit = json_encode($this->visitModel->getVisitById($visitId));
        return $this->ajaxResponse($visit);
    }

    public function addAction(Request $request) 
    {
        $this->visitModel->addNewVisit($request->post());
        header('Location: /visit/calendar');
    }

    public function addNewcardAction(Request $request)
    {
        $result = $this->visitModel->insertNewMedcard($request->post());
        if(!$result) var_dump($result);
        else header('Location: /visit/calendar');
    }

    public function deleteAction(Request $request)
    {
        $id = $request->post()['visits_id'];
        $this->visitModel->deleteVisit($id);
        header('Location: /visit/calendar');
    }

    public function updateAction(Request $request)
    {
        if ($this->visitModel->updateVisit($request->post())){
            header('Location: /visit/calendar');
        } else {
            $error = $this->visitModel->updateVisit($request->post());
            return $error;
        } 
    }

    public function addFromServicesAction(Request $request)
    {
        $this->visitModel->addNewVisit($request->post());
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}