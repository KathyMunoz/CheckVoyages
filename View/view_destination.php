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
            $imgHeader = "style='background-image: url(\"images/".$destination['thumbnail']."\"); background-size: cover; background-position: center; height: 300px; display: flex; align-items: center; justify-content: center; color: white; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);'";
        } else {
            $imgHeader = "style='background-color: #f0f0f0; height: 300px; display: flex; align-items: center; justify-content: center; color: #333;'";
        }
        $html = "<div class='destination-header' $imgHeader>";
        $html .= "<h1>".$destination['title']."</h1>";
        $html .= "</div>";

        $html .= "<section class='destination-content' style='padding: 50px; font-family: \"Manrope\", sans-serif; display: flex; justify-content: space-between; align-items: flex-start; gap: 40px;'>";
        $html .= "<div style='flex: 2;'>";
        $html .= "<h2>À propos de ".$destination['title']."</h2>";
        $html .= "<p>".$destination['content']."</p>";
        $html .= "</div>";
        
        // Widget Météo (Conteneur)
        $html .= "<div id='weather-widget' data-city='".htmlspecialchars($destination['title'], ENT_QUOTES)."' style='flex: 1; background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); min-width: 250px; text-align: center;'>";
        $html .= "<p style='color: #888;'>Chargement de la météo...</p>";
        $html .= "</div>";
        
        $html .= "</section>";

        if (!empty($articles)) {
            $html .= "<section class='destination-articles' style='padding: 50px; background-color: #f9f9f9; font-family: \"Manrope\", sans-serif;'>";
            $html .= "<h2>Articles liés à cette destination</h2>";
            $html .= "<div class='articles-grid' style='display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-top: 20px;'>";
            foreach ($articles as $article) {
                $html .= "<a href='article.php?id=".$article['id_article']."' class='article-card' style='border: 1px solid #ddd; border-radius: 10px; overflow: hidden; background: white; text-decoration: none; color: inherit; transition: transform 0.3s;' onmouseover='this.style.transform=\"translateY(-5px)\"' onmouseout='this.style.transform=\"translateY(0)\"'>";
                if ($article['thumbnail']) {
                    $html .= "<img src='images/".$article['thumbnail']."' alt='".$article['title']."' style='width: 100%; height: 200px; object-fit: cover;'>";
                }
                $html .= "<div style='padding: 15px;'>";
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
