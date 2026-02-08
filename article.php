<?php
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './Model/ArticleModel.php';
include './View/header.php';
include './View/view_article.php';
include './View/footer.php';

class ArticleController {
    private PDO $bdd;
    private Header $header;
    private ArticleView $view;
    private Footer $footer;

    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setBdd($this->bdd);
        $this->header->setStyle('./src/style/style-index.css');
        $this->view = new ArticleView();
        $this->footer = new Footer();
    }

    public function display() {
        if (!isset($_GET['id'])) {
            header('Location: index.php');
            exit();
        }

        $id = (int)$_GET['id'];
        $articleModel = new Article($this->bdd);
        $articleModel->setIdArticle($id);
        $articleData = $articleModel->readArticleById();

        if (empty($articleData)) {
            header('Location: index.php');
            exit();
        }

        $this->header->setTitle($articleData['title'] . " - CheckVoyages");

        echo $this->header->renderHeader();
        echo $this->view->renderArticle($articleData);
        echo $this->footer->renderFooter();
    }
}

$controller = new ArticleController();
$controller->display();
