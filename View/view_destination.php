<?php
class DestinationView {
    private PDO $bdd;

    public function __construct() {}

    public function setBdd(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function renderDestination(array $destination, array $articles): string {
        $imgHeader = "";
        if (!empty($destination['thumbnail'])) {
            $imgHeader = "style='background-image: url(\"images/".$destination['thumbnail']."\");'";
        } else {
            $imgHeader = "style='background-color: #f0f0f0; color: #333;'";
        }
        $html = "<div class='destination-header' $imgHeader>";
        $html .= "<h1>".$destination['title']."</h1>";
        $html .= "</div>";

        $html .= "<section class='destination-content'>";
        $html .= "<div class='destination-about'>";
        $html .= "<h2>À propos de ".$destination['title']."</h2>";
        $html .= "<p>".$destination['content']."</p>";
        $html .= "</div>";
        
        // Widget Météo (Conteneur)
        $html .= "<div id='weather-widget' class='weather-widget' data-city='".htmlspecialchars($destination['title'], ENT_QUOTES)."'>";
        $html .= "<p class='weather-loading'>Chargement de la météo...</p>";
        $html .= "</div>";
        
        $html .= "</section>";

        if (!empty($articles)) {
            $html .= "<section class='destination-articles'>";
            $html .= "<h2>Articles liés à cette destination</h2>";
            $html .= "<div class='articles-grid'>";
            foreach ($articles as $article) {
                $html .= "<a href='article.php?id=".$article['id_article']."' class='article-card'>";
                if ($article['thumbnail']) {
                    $html .= "<img src='images/".$article['thumbnail']."' alt='".$article['title']."'>";
                }
                $html .= "<div class='article-card-content'>";
                $html .= "<h3>".$article['title']."</h3>";
                $html .= "<p>".substr($article['content'], 0, 150)."...</p>";
                $html .= "</div>";
                $html .= "</a>";
            }
            $html .= "</div></section>";
        }

        return $html;
    }
}
