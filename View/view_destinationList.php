<?php
class DestinationListView {
    public function renderList(array $destinations, string $groupName): string {
        $html = "<section style='padding: 50px; font-family: \"Manrope\", sans-serif;'>";
        $html .= "<h1>Destinations en " . $groupName . "</h1>";
        
        if (empty($destinations)) {
            $html .= "<p>Aucune destination trouvée pour ce groupe.</p>";
        } else {
            $html .= "<div class='cards-grid' style='display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; justify-content: center; margin-top: 30px;'>";
            foreach ($destinations as $dest) {
                $img = !empty($dest['thumbnail']) ? "<img src='images/".$dest['thumbnail']."' alt='".$dest['title']."' style='width: 100%; max-width:150px; height: 160px; object-fit: cover; margin-bottom: 1rem; border-radius: 8px;'>" : "";
                $html .= "<a href='destination.php?id=".$dest['id_destination']."' class='card card-image'>
                            $img
                            <p class='card-description' style='font-size: 1rem; font-weight: bold;'>".$dest['title']."</p>
                         </a>";
            }
            $html .= "</div>";
        }
        $html .= "</section>";
        return $html;
    }
}
