<?php
class Footer {
    // ATTRIBUTES
    private string $containerWhoAreWe = "<div class='container-footer'>
                    <h3>Qui sommes nous?</h3>
                    <p>Nos engagements</p>
                    <p>Tourisme responsable</p>
                </div>";
    private string $containerConditions = "<div class='container-footer'>
                    <h3>Conditions</h3>
                    <p>Notice légales</p>
                    <p>CGU</p>
                    <p>Cookies</p>
                </div>";
    private string $containerInfos = "<div class='container-footer'>
                    <h3>Infos</h3>
                    <p>01 44 22 11 22</p>
                    <p>(Nos conseillers sont à votre écoute)<br> 
                9h-23h du lundi au samedi <br> 10h-23h dimanche Pour nous appeller depuis l'étranger, cliquer ici</p>
                </div>";
    private string $containerSocials = "<div class='icons-social'>
                    <img src='images/icon-instagram.png'alt='icon reseaux sociaux instagram'>
                    <img src='images/icon-facebook.png'alt='icon reseaux sociaux facebook'>
                </div>";

    // CONSTRUCTOR
    public function __construct() {}

    // GETTERS & SETTERS
    public function getWhoAreWe(): string {
        return $this->containerWhoAreWe;
    }
    public function setWhoAreWe(string $whoAreWe): Footer {
        $this->containerWhoAreWe = $whoAreWe;
        return $this;
    }

    public function getConditions(): string {
        return $this->containerConditions;
    }
    public function setConditions(string $containerConditions): Footer {
        $this->containerConditions = $containerConditions;
        return $this;
    }
    public function getInfos(): string {
        return $this->containerInfos;
    }
    public function setInfos(string $containerInfos): Footer {
        $this->containerInfos = $containerInfos;
        return $this;
    }
    public function getSocials(): string {
        return $this->containerSocials;
    }
    public function setSocials(string $containerSocials): Footer {
        $this->containerSocials = $containerSocials;
        return $this;
    }

    // METHODS
    public function renderFooter(): string {
        return "</main>
        <footer class='footer'>
            <section class='footer-links'>
                ".$this->getWhoAreWe()."
                ".$this->getConditions()."
                ".$this->getInfos()."
                ".$this->getSocials()."
            </section>
        </footer>
        <script src='./src/script/script.js'></script><!-- chemin relatif depuis le HTML vers mon fichier script.js -->
    </body>
</html>";
    }
}

?>