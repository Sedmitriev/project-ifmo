<?php
namespace Sedmit\Ronda\Controllers;

use Sedmit\Ronda\Core\Request;
use Sedmit\Ronda\Core\Controller;
use Sedmit\Ronda\Models\VisitModel;
use Sedmit\Ronda\Models\DoctorModel;
use Sedmit\Ronda\Models\MedcardModel;
use Sedmit\Ronda\Models\ServiceModel;

class ServiceController extends Controller
{
    private $medcardModel;
    private $doctorModel;
    private $serviceModel;

    public function __construct()
    {
        $this->medcardModel = new MedcardModel();
        $this->doctorModel = new DoctorModel();
        $this->serviceModel = new ServiceModel();
    }

    public function indexAction(Request $request)
    {
        $id = $request->getParams()['id'];
        $medcard = $this->medcardModel->getMedcardById($id);
        $doctors = $this->doctorModel->getDoctors();
        $services = $this->serviceModel->getServices();
        $servicesById = $this->serviceModel->getServicesById($id);
        $content = 'Medcard/services.php';
        $data = [
            'page_title' => 'Оказанные услуги',
            'medcard' => $medcard,
            'doctors' => $doctors,
            'services' => $services,
            'servicesById' => $servicesById
        ];
        return $this->generateResponse($content, $data);
    }
}