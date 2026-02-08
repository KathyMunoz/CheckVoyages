<?php
class AccueilView {
    // ATTRIBUTES
    private PDO $bdd;

    // CONSTRUCTOR
    public function __construct() {}

    // METHODS
    public function getBdd(): PDO {
        return $this->bdd;
    }
    public function setBdd(PDO $newBdd): AccueilView {
        $this->bdd = $newBdd;
        return $this;
    }
    public function renderRandomCards() {
        $destination = new Destination($this->getBdd());
        $cardsInfos = $destination->getRandomDestination(4);
        $cards = '';
        foreach ($cardsInfos as $card) {
            $cards .= "<a href='destination.php?id=".$card['id_destination']."' class='card card-image'>
                        <img src='images/".$card['thumbnail']."' alt='".$card['title']."'>
                        <p class='card-description'>".$card['title']."</p>
                     </a>";
        }
        return $cards;
    }
    public function renderAccueil(): string {
        return "<section class='hero'>
                <div class='hero-content'>
                    <a href='#' class='btn-destin'>
                <span class='material-symbols-outlined'>search</span>Cherche ton destin</a>
                </div>
            </section>
            <section class='cards-section' id='btn-popular-destinations'>
                <div class='cards-grid'>  
                    ".$this->renderRandomCards()."
                </div>

            </section>";
    }
}