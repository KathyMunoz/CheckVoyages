<?php
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './View/header.php';
include './View/view_destinationList.php';
include './View/footer.php';

class DestinationListController {
    private PDO $bdd;
    private Header $header;
    private DestinationListView $view;
    private Footer $footer;

    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setBdd($this->bdd);
        $this->header->setStyle('./src/style/style-index.css');
        $this->view = new DestinationListView();
        $this->footer = new Footer();
    }

    public function display() {
        if (!isset($_GET['id_group'])) {
            header('Location: index.php');
            exit();
        }

        $id_group = (int)$_GET['id_group'];
        
        $groupModel = new DestinationGroup($this->bdd);
        $groupModel->setIdDestinationGroup($id_group);
        // We need a method to get group name by ID
        $groupName = $this->getGroupName($id_group);

        $this->header->setTitle("Destinations - CheckVoyages");

        $destModel = new Destination($this->bdd);
        $destinations = $destModel->listDestinationsByGroup($id_group);

        echo $this->header->renderHeader();
        echo $this->view->renderList($destinations, $groupName);
        echo $this->footer->renderFooter();
    }

    private function getGroupName(int $id): string {
        $query = $this->bdd->prepare('SELECT name FROM destinationGroup WHERE id_destinationGroup = ?');
        $query->execute([$id]);
        $res = $query->fetch();
        return $res ? $res['name'] : 'Inconnu';
    }
}

$controller = new DestinationListController();
$controller->display();
