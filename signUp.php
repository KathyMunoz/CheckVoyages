<?php

// import des ressources
include './env.php';
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './Model/UserModel.php';
include './View/header.php';
include './View/view_signup.php';
include './View/footer.php';

class SignUpController {
    // ATTRIBUTES
    private string $title = 'CheckVoyages - Inscription';
    private string $style = './src/style/style-signUp.css';
    private string $headerStyle = './src/style/style-index.css';
    private PDO $bdd;
    private Header $header;
    private SignUpView $signUpView;
    private Footer $footer;

    // CONSTRUCTOR
    public function __construct() {
        $this->bdd = new PDO('mysql:host='.$_ENV['db_host'].';dbname='.$_ENV['db_name'].';charset=utf8mb4',$_ENV['db_user'],$_ENV['db_pwd'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setTitle($this->title);
        $this->header->setStyle($this->headerStyle);
        $this->header->setBDD($this->bdd);
        $this->signUpView = new SignUpView();
        $this->signUpView->setBdd($this->bdd);
        $this->footer = new Footer();
    }

    // GETTERS & SETTERS
    public function getTitle(): string {
        return $this->title;
    }
    public function setTitle(string $title): SignUpController {
        $this->title = $title;
        return $this;
    }
    public function getStyle(): string {
        return $this->style;
    }
    public function setStyle(string $style): SignUpController {
        $this->style = $style;
        return $this;
    }

    // METHODS
    public function handleSignUp() {
        if (isset($_POST['signup-submit'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $confirmEmail = $_POST['confirm-email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];

            if ($email !== $confirmEmail) {
                echo "<p style='color:red; text-align:center;'>Les adresses e-mail ne correspondent pas.</p>";
                return;
            }

            if ($password !== $confirmPassword) {
                echo "<p style='color:red; text-align:center;'>Les mots de passe ne correspondent pas.</p>";
                return;
            }

            $userModel = new UserModel($this->bdd);
            if ($userModel->emailExists($email)) {
                echo "<p style='color:red; text-align:center;'>Cet e-mail est déjà utilisé.</p>";
                return;
            }

            // Pour cet exemple, on utilise l'email comme login par défaut
            $login = $email; 

            if ($userModel->addUser($firstname, $lastname, $email, $login, $password)) {
                header('Location: signIn.php');
                exit();
            } else {
                echo "<p style='color:red; text-align:center;'>Une erreur est survenue lors de l'inscription.</p>";
            }
        }
    }

    public function displaySignUp(){
        // render header
        echo $this->header->renderHeader();
        
        echo "<link rel='stylesheet' href='".$this->getStyle()."'>";
        
        // render main
        echo $this->signUpView->renderSignUp();

        // render footer
        echo $this->footer->renderFooter();
    }

}

$signUpController = new SignUpController();
$signUpController->handleSignUp();
$signUpController->displaySignUp();

?>
