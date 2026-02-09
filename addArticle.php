<?php
// import des ressources
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './Model/ArticleModel.php';
include './View/header.php';
include './View/view_add_article.php';
include './View/footer.php';

// Verification connection
if (!isset($_SESSION['id_user'])) {
    header('Location: signIn.php');
    exit();
}

// Ajax check for destinations
if (isset($_GET['action']) && $_GET['action'] == 'getDestinations' && isset($_GET['id_group'])) {
    $bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $destinationModel = new Destination($bdd);
    $destinations = $destinationModel->listDestinationsByGroup((int)$_GET['id_group']);
    header('Content-Type: application/json');
    echo json_encode($destinations);
    exit();
}

class AddArticleController {
    // ATTRIBUTES
    private string $title = 'Ajouter un article - CheckVoyages';
    private string $style = './src/style/style-signUp.css'; // Use existing style for consistency
    private string $headerStyle = './src/style/style-index.css';
    private PDO $bdd;
    private Header $header;
    private AddArticleView $addArticleView;
    private Footer $footer;

    // CONSTRUCTOR
    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setTitle($this->title);
        $this->header->setStyle($this->headerStyle);
        $this->header->setBDD($this->bdd);
        $this->addArticleView = new AddArticleView();
        $this->addArticleView->setBdd($this->bdd);
        $this->footer = new Footer();
    }

    // METHODS
    public function handleAddArticle() {
        if (isset($_POST['article-submit'])) {
            if (!isset($_POST['finished'])) {
                echo "<p style='color:red; text-align:center;'>Veuillez cocher la case indiquant que l'article est fini avant de publier.</p>";
                return;
            }

            $title = sanitize($_POST['title']);
            $content = sanitize($_POST['content']);
            $id_destination = (int)$_POST['id_destination'];
            $id_user = $_SESSION['id_user'];
            
            $articleModel = new Article($this->bdd);
            $success = $articleModel->addArticle($title, $content, $id_user, $id_destination);

            if ($success) {
                echo "<p style='color:green; text-align:center;'>Article publié avec succès !</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Erreur lors de la publication de l'article.</p>";
            }
        }
    }

    public function displayAddArticle() {
        $groupModel = new DestinationGroup($this->bdd);
        $groups = $groupModel->readDestinationGroups();

        // render header
        echo $this->header->renderHeader();

        echo "<link rel='stylesheet' href='".$this->style."'>";

        // render main
        echo $this->addArticleView->renderAddArticle($groups);

        // render footer
        echo $this->footer->renderFooter();
    }
}

$addArticleController = new AddArticleController();
$addArticleController->handleAddArticle();
$addArticleController->displayAddArticle();
?>
