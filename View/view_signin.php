<?php
class SignInView {
    // ATTRIBUTES
    private PDO $bdd;

    // CONSTRUCTOR
    public function __construct() {}

    // METHODS
    public function getBdd(): PDO {
        return $this->bdd;
    }
    public function setBdd(PDO $newBdd): SignInView {
        $this->bdd = $newBdd;
        return $this;
    }
    public function renderSignIn(): string {
        return "<main class='image-login-container'>
                    <div class='login'>
                        <h2 class='login'>Se connecter à Check<span class='orange'>V</span>oyages</h2>
                        <form class='btns-connection' action='' method='POST'>
                            <label for='email'>Adresse e-mail </label>
                            <input type='email' id='email' name='email' size='30' required placeholder='Votre email' class='btn'/>
                            <label for='pass'>Mot de passe </label>
                            <input type='password' id='pass' name='password' minlength='8' required class='btn'/>
                            <label for='rememberme'>
                                <input type='checkbox' name='rememberme' value='forever' checked='checked' id='rememberme' tabindex='13' /> Se souvenir de moi
                            </label>
                            <input type='submit' name='signin-submit' class='btn-login' value='Se connecter'>
                            <p>
                                <a href='motDePasseOublie.html' class='forgot-pwd' target='_blank'>Mot de passe oublié?</a>
                            </p>
                        </form>
                    </div>
                    <div class='photo-login'>
                        <img src='images/photo_page_se_connecter.png' alt='Photo avec un avion et un paysage'>
                    </div>
                </main>
                <section class='navigation-register'>
                    <div>
                        <a href='#' class='link-popular-profiles'>Explorer les profils le plus populaires</a>
                    </div>
                    <div class='register-link'>
                        <p>Vous venez de découvrir CheckVoyages?</p>
                        <a href='signUp.php' >Créer un compte pour ta prochaine aventure</a>
                    </div>
                </section>";
    }
}