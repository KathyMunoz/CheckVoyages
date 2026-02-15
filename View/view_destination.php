<?php
class DestinationView {
    private PDO $bdd;

    public function __construct() {}

    public function getBdd(): PDO {
        return $this->bdd;
    }

    public function setBdd(PDO $newBdd): self {
        $this->bdd = $newBdd;
        return $this;
    }

    // Je génère ma banière pour ma destination à partir des infos en BDD
    private function renderImgDestination(array $destination): string {
        $style = !empty($destination['thumbnail']) 
            ? "style='background-image: url(\"images/".$destination['thumbnail']."\");'" 
            : "style='background-color: #f0f0f0; color: #333;'";

        return "<div class='destination-header' $style>
                    <h1>".$destination['title']."</h1>
                </div>";
    }

    private function renderWeatherWidget(array $destination): string {
        // htmlspecialchars permet de remplacer les caractères spéciaux. ENT_QUOTES permet de s'assurer que les ' et les " sont bien convertis pour raison de sécurité
        // data-city est un argument de ma classe weather-widget. J'en ai besoin pour l'appeler dans mon script.js
        return "<div id='weather-widget' class='weather-widget' data-city='".htmlspecialchars($destination['title'], ENT_QUOTES)."'>
                    <p class='weather-loading'>Chargement de la météo...</p>
                </div>";
    }

    // je recupère la liste des articles de ma destinations
    private function renderArticles(array $articles): string {
        if (empty($articles)) {//dans les cas où il n'y a pas des articles
            return "";// affiche rien
        }

        // dans les cas où il y a des articles, initialisation de la liste d'article vide
        $cards = '';
        foreach ($articles as $article) {//parcours un par un du tableau array $articles
            $img = !empty($article['thumbnail']) //si image, prend la
                ? "<img src='images/".$article['thumbnail']."' alt='".$article['title']."'>" 
                : "";//si pas image affiche rien

            $cards .= "<a href='article.php?id=".$article['id_article']."' class='article-card'>
                        $img
                        <div class='article-card-content'>
                            <h3>".$article['title']."</h3>
                            <p>".substr($article['content'], 0, 150)."...</p>
                        </div>
                       </a>";
        }

        return "<section class='destination-articles'>
                    <h2>Articles liés à cette destination</h2>
                    <div class='articles-grid'>
                        $cards
                    </div>
                </section>";
    }

    // je construit ma page
    public function renderDestination(array $destination, array $articles): string {
        // je commence par la bannière image + titre
        return $this->renderImgDestination($destination).
        // puis la section A propos
        "<section class='destination-content'>
            <div class='destination-about'>
                <h2>À propos de ".$destination['title']."</h2>
                <p>".$destination['content']."</p>
            </div>".
        // j'ajoute mon widget meteo
            $this->renderWeatherWidget($destination).
        "</section>".
        // je finis ma page avec les articles de ma destination
        $this->renderArticles($articles);
    }
}
