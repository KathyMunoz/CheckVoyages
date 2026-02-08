<?php
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './Model/ArticleModel.php';
include './View/header.php';
include './View/view_destination.php';
include './View/footer.php';

class DestinationController {
    private PDO $bdd;
    private Header $header;
    private DestinationView $view;
    private Footer $footer;

    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setBdd($this->bdd);
        $this->header->setStyle('./src/style/style-index.css');
        $this->view = new DestinationView();
        $this->view->setBdd($this->bdd);
        $this->footer = new Footer();
    }

    public function display() {
        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit();
        }

        $id = (int)$_GET['id'];
        $destModel = new Destination($this->bdd);
        $destModel->setIdDestination($id);
        $destinationData = $destModel->readDestinationById();

        if (empty($destinationData)) {
            header('Location: index.php');
            exit();
        }

        $this->header->setTitle($destinationData['title'] . " - CheckVoyages");

        $articleModel = new Article($this->bdd);
        $articleModel->setIdDestination($id);
        $articles = $articleModel->readArticleByIdDestination();

        echo $this->header->renderHeader();
        echo $this->view->renderDestination($destinationData, $articles);
        echo $this->footer->renderFooter();
    }
}

$controller = new DestinationController();
$controller->display();
