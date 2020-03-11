<?php
namespace Sedmit\Ronda\Controllers;

use Dompdf\Dompdf;
use Sedmit\Ronda\Core\Request;
use Sedmit\Ronda\Core\Controller;
use Sedmit\Ronda\Models\MedcardModel;
use Sedmit\Ronda\Components\Pagination;

class MedcardController extends Controller
{
    private $medcardModel;

    public function __construct()
    {
        $this->medcardModel = new MedcardModel();
    }

    public function indexAction(Request $request) {
        if (isset($request->getParams()['page'])) $page = $request->getParams()['page'];
        else $page = 1;
        $medcardsOnPage = $this->medcardModel->getMedcardList($page);
  
        $total = $this->medcardModel->getAllMedcards();
  
        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, MedcardModel::SHOW_BY_DEFAULT, 'page-');
        $content = 'Medcard/index.php';
        $data = [
            "page_title" => 'Медкарты',
            "medcardsOnPage" => $medcardsOnPage,
            "pagination" => $pagination
        ];
        return $this->generateResponse($content, $data);
    }

    public function newAction() {
        $content = 'Medcard/add.php';
        $data = [
            'page_title'=>'Новая медкарта'
        ];

        return $this->generateResponse($content, $data);
    }

    public function addAction(Request $request) {
        //var_dump($request->post());
        $this->medcardModel->addNewMedcard($request->post());
        header('Location: /medcard/index');
    }

    public function showAction(Request $request) {
        $id = $request->post()['medcard_id'];
        $medcard = $this->medcardModel->getMedcardById($id);
        $_SESSION = $medcard;
        $content = 'Medcard/view.php';
        $data = [
            'page_title' => 'Медкарта',
            'medcard' => $medcard
        ];

        return $this->generateResponse($content, $data);
    }

    public function deleteAction(Request $request) {
        $id = $request->post()['medcard_id'];
        $delMedcard = $this->medcardModel->deleteMedcardById($id);
        $content = 'Medcard/delete.php';
        $data = [
            'page_title' => 'Медкарта',
            'medcardId' => $id,
            'delMedcard' => $delMedcard
        ];

        return $this->generateResponse($content, $data);
    }

    public function updateAction(Request $request) {
        $medcard = $request->post();
        $id = $medcard['medcard_id'];
        $updMedcard = $this->medcardModel->updateMedcardById($medcard);
        $content = 'Medcard/edit.php';
        $data = [
            'page_title' => 'Медкарта',
            'medcardId' => $id,
            'updMedcard' => $updMedcard
        ];

        return $this->generateResponse($content, $data);
    }

    public function searchAction(Request $request) {
        $search = $request->post()['id'];
        $searchByNumber = $this->medcardModel->searchMedcardByNmb($search);
        $searchBySurname = $this->medcardModel->searchMedcardBySurname($search);
        if(!empty($searchByNumber)) {
            $searchMedcard = $searchByNumber;
        }
   
         elseif(!empty($searchBySurname)) {
            $searchMedcard = $searchBySurname;
        }
   
         else {
            $searchMedcard = [];
        }

        $content = 'Medcard/search.php';
        $data = [
            'page_title' => 'Поиск медкарты',
            'searchMedcard' => $searchMedcard
        ];

        return $this->generateResponse($content, $data);
    }

    public function templateAction(Request $request) {
        $templateName = $request->getParams()['filename'];
        $filename = 'static/forms/' . $templateName . '.html';

        $page = file_get_contents($filename);

        $dateReg = date("d.m.Y",strtotime($_SESSION['medcard_date']));
        $dob = date("d.m.Y",strtotime($_SESSION['patients_dob']));
        $passpDate = date("d.m.Y",strtotime($_SESSION['patients_passp_date']));
        // Массив с метками и их значениями для шаблона
        $signs = array (
            'id' => $_SESSION['medcard_id'],
            'datereg' => $dateReg,
            'surname' => $_SESSION['patients_surname'],
            'name' => $_SESSION['patients_name'],
            'patr' => $_SESSION['patients_patronymic'],
            'dob' => $dob,
            'sex' => $_SESSION['patients_sex'],
            'addr' => $_SESSION['patients_addr'],
            'tel' => $_SESSION['patients_tel'],
            'passp_series' => $_SESSION['patients_passp_series'],
            'passp_number' => $_SESSION['patients_passp_number'],
            'passp_issued_by' => $_SESSION['patients_passp_issued_by'],
            'passp_date' => $passpDate,
            'passp_code' => $_SESSION['patients_passp_code'],
            'insur' => $_SESSION['patients_insur'],
            'job' => $_SESSION['patients_job'],
            'drugIntol' => $_SESSION['patients_drugIntolerance']);
        // Замена меток в шаблоне их значениями
        foreach ($signs as $key => $value)
            $page = str_replace('{' . $key . '}', $value, $page);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($page);
        $dompdf->setPaper('A5', 'landscape');
        $dompdf->render();
        $pdfFilename = $templateName . '.pdf';
        $dompdf->stream($pdfFilename, array('Attachment'=>0));

    }
}