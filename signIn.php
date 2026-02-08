<?php

// import des ressources
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './Model/UserModel.php';
include './View/header.php';
include './View/view_signin.php';
include './View/footer.php';

class SignInController {
    // ATTRIBUTES
    private string $title = 'CheckVoyages';
    private string $style = './src/style/style-signin.css';
    private string $headerStyle = './src/style/style-index.css';
    private PDO $bdd;
    private Header $header;
    private SignInView $signInView;
    private Footer $footer;

    // CONSTRUCTOR
    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setTitle($this->title);
        $this->header->setStyle($this->headerStyle);
        $this->header->setBDD($this->bdd);
        $this->signInView = new SignInView();
        $this->signInView->setBdd($this->bdd);
        $this->footer = new Footer();
    }

    // GETTERS & SETTERS
    public function getTitle(): string {
        return $this->title;
    }
    public function setTitle(string $title): SignInController {
        $this->title = $title;
        return $this;
    }
    public function getStyle(): string {
        return $this->style;
    }
    public function setStyle(string $style): SignInController {
        $this->style = $style;
        return $this;
    }
    public function getHeader(): Header {
        return $this->header;
    }
    public function setHeader(Header $header): SignInController {
        $this->header = $header;
        return $this;
    }

    // METHODS
    public function handleSignIn() {
        if (isset($_POST['signin-submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = new UserModel($this->bdd);
            $user = $userModel->getUserByEmailAndPassword($email, $password);

            if ($user) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['login'] = $user['login'];
                
                header('Location: index.php');
                exit();
            } else {
                echo "<p style='color:red; text-align:center;'>Identifiant ou mot de passe incorrect.</p>";
            }
        }
    }

    public function displaySignIn(){
        // render header
        echo $this->header->renderHeader();
        
        echo "<link rel='stylesheet' href='".$this->getStyle()."'>";
        
        // render main
        echo $this->signInView->renderSignIn();

        // render footer
        echo $this->footer->renderFooter();
    }

}

$signInController = new SignInController();
$signInController->handleSignIn();
$signInController->displaySignIn();

?>


