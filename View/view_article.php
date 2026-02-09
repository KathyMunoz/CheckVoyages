<?php
class ArticleView {
    public function renderArticle(array $article): string {
        $title = $article['title'];
        $content = nl2br($article['content']);
        $thumbnail = $article['thumbnail'];
        $date = date('d/m/Y', strtotime($article['creation_date']));
        $author = (!empty($article['firstname']) || !empty($article['lastname'])) 
            ? $article['firstname'] . ' ' . $article['lastname'] 
            : "Auteur inconnu";
        
        $destId = $article['id_destination'];
        $destTitle = $article['destination_title'];

            $imageHtml = "";
            if (!empty($thumbnail)) {
                $imageHtml = "
                <div style='text-align: center; margin: 20px 0;'>
                    <img src='images/$thumbnail' alt='$title' style='max-width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'>
                </div>";
            }

            return "
            <article style='max-width: 800px; margin: 20px auto; font-family: \"Manrope\", sans-serif; padding: 0 20px;'>
                <h1 style='color: rgb(255 113 12); text-align: center;'>$title</h1>
                <p style='text-align: center; color: #666; font-style: italic;'>
                    Par $author, le $date
                </p>
                $imageHtml
                <div style='line-height: 1.6; font-size: 1.1rem; color: #333;'>
                    $content
                </div>
                <div style='margin-top: 40px; text-align: center; display: flex; justify-content: center; gap: 20px;'>
                    <a href='destination.php?id=$destId' style='text-decoration: none; color: black; border: solid 2px rgb(255 113 12); border-radius: 15px; padding: 10px 20px;'>Retour à $destTitle</a>
                    <a href='index.php' style='text-decoration: none; color: white; background-color: rgb(255 113 12); border: solid 2px rgb(255 113 12); border-radius: 15px; padding: 10px 20px;'>Retour à l'accueil</a>
                </div>
            </article>
            ";
    }
}
