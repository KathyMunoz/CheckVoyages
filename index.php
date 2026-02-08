<?php
// import des ressources
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './View/header.php';
include './View/view_accueil.php';
include './View/footer.php';

class AccueilController {
    // ATTRIBUTES
    private string $title = 'CheckVoyages';
    private string $style = './src/style/style-index.css';
    private PDO $bdd;
    private Header $header;
    private AccueilView $accueilView;
    private Footer $footer;

    // CONSTRUCTOR
    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setTitle($this->title);
        $this->header->setStyle($this->style);
        $this->header->setBDD($this->bdd);
        $this->accueilView = new AccueilView();
        $this->accueilView->setBdd($this->bdd);
        $this->footer = new Footer();
    }

    // GETTERS & SETTERS
    public function getTitle(): string {
        return $this->title;
    }
    public function setTitle(string $title): AccueilController {
        $this->title = $title;
        return $this;
    }
    public function getStyle(): string {
        return $this->style;
    }
    public function setStyle(string $style): AccueilController {
        $this->style = $style;
        return $this;
    }
    public function getHeader(): Header {
        return $this->header;
    }
    public function setHeader(Header $header): AccueilController {
        $this->header = $header;
        return $this;
    }

    // METHODS
    public function displayAccueil(){
        // render header
        echo $this->header->renderHeader();
        
        // render main 
        //TODO ajouter le code HTML de la page d'accueil ici
        echo $this->accueilView->renderAccueil();

        // render footer
        echo $this->footer->renderFooter();
    }
}

$acceuilController = new AccueilController();
$acceuilController->displayAccueil();

?>