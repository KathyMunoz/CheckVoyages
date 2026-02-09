<?php
// import des ressources
include './utils/functions.php';
include './Model/DestinationGroupModel.php';
include './Model/DestinationModel.php';
include './Model/UserModel.php';
include './View/header.php';
include './View/view_profile.php';
include './View/footer.php';

if (!isset($_SESSION['id_user'])) {
    header('Location: signIn.php');
    exit();
}

class ProfileController {
    // ATTRIBUTES
    private string $title = 'Mon Profil - CheckVoyages';
    private string $style = './src/style/style-signUp.css';
    private string $headerStyle = './src/style/style-index.css';
    private PDO $bdd;
    private Header $header;
    private ProfileView $profileView;
    private Footer $footer;

    // CONSTRUCTOR
    public function __construct() {
        $this->bdd = new PDO('mysql:host=localhost;dbname=checkvoyages;charset=utf8mb4', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $this->header = new Header();
        $this->header->setTitle($this->title);
        $this->header->setStyle($this->headerStyle);
        $this->header->setBDD($this->bdd);
        $this->profileView = new ProfileView();
        $this->profileView->setBdd($this->bdd);
        $this->footer = new Footer();
    }

    // METHODS
    public function handleProfileUpdate() {
        if (isset($_POST['profile-submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm-password'];

            if (!empty($password) && $password !== $confirmPassword) {
                echo "<p style='color:red; text-align:center;'>Les mots de passe ne correspondent pas.</p>";
                return;
            }

            $userModel = new UserModel($this->bdd);
            $success = $userModel->updateUserInfo($_SESSION['id_user'], $email, !empty($password) ? $password : null);

            if ($success) {
                echo "<p style='color:green; text-align:center;'>Informations mises à jour avec succès.</p>";
            } else {
                echo "<p style='color:red; text-align:center;'>Une erreur est survenue lors de la mise à jour.</p>";
            }
        }
    }

    public function displayProfile() {
        $userModel = new UserModel($this->bdd);
        $user = $userModel->getUserById($_SESSION['id_user']);

        // render header
        echo $this->header->renderHeader();

        echo "<link rel='stylesheet' href='".$this->style."'>";

        // render main
        echo $this->profileView->renderProfile($user);

        // render footer
        echo $this->footer->renderFooter();
    }
}

$profileController = new ProfileController();
$profileController->handleProfileUpdate();
$profileController->displayProfile();
?>
