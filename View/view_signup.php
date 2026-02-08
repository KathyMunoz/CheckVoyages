<?php
class SignUpView {
    // ATTRIBUTES
    private PDO $bdd;

    // CONSTRUCTOR
    public function __construct() {}

    // METHODS
    public function getBdd(): PDO {
        return $this->bdd;
    }
    public function setBdd(PDO $newBdd): SignUpView {
        $this->bdd = $newBdd;
        return $this;
    }
    public function renderSignUp(): string {
        return "<form class='registration-form' action='' method='POST'>
                    <legend>Inscription</legend>
                    <ul>
                        <li>
                            <label for='firstname'>Prénom :</label>
                            <input type='text' id='firstname' name='firstname' required placeholder='Votre prénom'>
                        </li>
                        <li>
                            <label for='lastname'>Nom :</label>
                            <input type='text' id='lastname' name='lastname' required placeholder='Votre nom'>
                        </li>
                        <li>
                            <label for='email'>Adresse e-mail :</label>
                            <input type='email' id='email' name='email' size='30' required placeholder='...@...' >
                        </li>
                        <li>
                            <label for='confirm-email'>Confirmer Email :</label>
                            <input type='email' id='confirm-email' name='confirm-email' required placeholder='Confirmez votre email'>
                        </li>  
                        <li>
                            <label for='password'>Mot de passe :</label>
                            <input type='password' id='password' name='password' minlength='8' required />
                        </li>
                        <li>
                            <label for='confirm-password'>Confirmer mot de passe :</label>
                            <input type='password' id='confirm-password' name='confirm-password' required placeholder='Confirmez mot de passe'>
                        </li>
                        <li>
                            <input class='btn-minscrire' type='submit' name='signup-submit' value=\"M'inscrire\">
                        </li>
                        <a href='signIn.php'>Vous aviez déjà une compte?</a>
                        <li>
                            <label for='conditions'>
                                <input type='checkbox' name='conditions' value='forever' checked='checked' id='conditions' tabindex='13' required /> J'accepte les Conditions Générales d'Utilisation et les Conditions Générales d'Intervention. Je comprends que les informations de mon compte seront utilisées conformément à la Politique de confidentialité et de protection des données à caractère personnel de Check Voyages.
                            </label>
                        </li>
                    </ul>
                </form>";
    }
}
