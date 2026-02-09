<?php
class ProfileView {
    // ATTRIBUTES
    private PDO $bdd;

    // CONSTRUCTOR
    public function __construct() {}

    // METHODS
    public function getBdd(): PDO {
        return $this->bdd;
    }
    public function setBdd(PDO $newBdd): ProfileView {
        $this->bdd = $newBdd;
        return $this;
    }

    public function renderProfile(array $user): string {
        $firstname = htmlspecialchars($user['firstname']);
        $lastname = htmlspecialchars($user['lastname']);
        $email = htmlspecialchars($user['email']);

        return "<form class='registration-form' action='' method='POST'>
                    <legend>Mes infos</legend>
                    <ul>
                        <li>
                            <label for='firstname'>Prénom :</label>
                            <input type='text' id='firstname' name='firstname' value='$firstname' readonly style='background-color: #f0f0f0;'>
                        </li>
                        <li>
                            <label for='lastname'>Nom :</label>
                            <input type='text' id='lastname' name='lastname' value='$lastname' readonly style='background-color: #f0f0f0;'>
                        </li>
                        <li>
                            <label for='email'>Adresse e-mail :</label>
                            <input type='email' id='email' name='email' size='30' required value='$email'>
                        </li>
                        <li>
                            <label for='password'>Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
                            <input type='password' id='password' name='password' minlength='8' />
                        </li>
                        <li>
                            <label for='confirm-password'>Confirmer nouveau mot de passe :</label>
                            <input type='password' id='confirm-password' name='confirm-password' placeholder='Confirmez mot de passe'>
                        </li>
                        <li>
                            <input class='btn-minscrire' type='submit' name='profile-submit' value=\"Enregistrer les modifications\">
                        </li>
                    </ul>
                </form>";
    }
}
