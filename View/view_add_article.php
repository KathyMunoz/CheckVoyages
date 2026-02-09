<?php
class AddArticleView {
    private PDO $bdd;

    public function setBdd(PDO $bdd) {
        $this->bdd = $bdd;
    }

    public function renderAddArticle(array $groups): string {
        return "
        <section class='registration-form'>
            <legend>Ajouter un article</legend>
            <form action='' method='POST' id='add-article-form'>
                <ul>
                    <li>
                        <label for='id_destinationGroup'>Catégorie :</label>
                        <select id='id_destinationGroup' name='id_destinationGroup' required>
                            <option value=''>Choisir une catégorie</option>
                            " . $this->renderOptions($groups) . "
                        </select>
                    </li>
                    <li>
                        <label for='id_destination'>Destination :</label>
                        <select id='id_destination' name='id_destination' required disabled>
                            <option value=''>Choisir une destination</option>
                        </select>
                    </li>
                    <li>
                        <label for='title'>Titre :</label>
                        <input type='text' id='title' name='title' required placeholder=\"Titre de l'article\">
                    </li>
                    <li>
                        <label for='content'>Contenu :</label>
                        <textarea id='content' name='content' rows='10' required placeholder='Écrivez votre article ici...'></textarea>
                    </li>
                    <li>
                        <label for='finished'>
                            <input type='checkbox' id='finished' name='finished' value='1' required> L'article est fini
                        </label>
                    </li>
                    <li>
                        <input class='btn-minscrire' type='submit' name='article-submit' value=\"Publier l'article\">
                    </li>
                </ul>
            </form>
        </section>

        <script>
            const groupSelect = document.getElementById('id_destinationGroup');
            const destinationSelect = document.getElementById('id_destination');

            groupSelect.addEventListener('change', function() {
                const groupId = this.value;
                destinationSelect.innerHTML = '<option value=\"\">Chargement...</option>';
                destinationSelect.disabled = true;

                if (groupId) {
                    fetch('addArticle.php?action=getDestinations&id_group=' + groupId)
                        .then(response => response.json())
                        .then(data => {
                            destinationSelect.innerHTML = '<option value=\"\">Choisir une destination</option>';
                            data.forEach(dest => {
                                const option = document.createElement('option');
                                option.value = dest.id_destination;
                                option.textContent = dest.title;
                                destinationSelect.appendChild(option);
                            });
                            destinationSelect.disabled = false;
                        })
                        .catch(error => {
                            console.error('Erreur:', error);
                            destinationSelect.innerHTML = '<option value=\"\">Erreur de chargement</option>';
                        });
                } else {
                    destinationSelect.innerHTML = '<option value=\"\">Choisir une destination</option>';
                }
            });
        </script>
        <style>
            textarea#content {
                width: 100%;
                max-width: 500px;
                border: 1px solid rgb(239 34 157);
                border-radius: 1em;
                padding: 10px;
                font-family: inherit;
            }
            select {
                text-align: left;
                border: 1px solid rgb(239 34 157);
                border-radius: 1em;
                width: 100%;
                max-width: 300px;
                padding: 5px;
            }
        </style>
        ";
    }

    private function renderOptions(array $items): string {
        $options = "";
        foreach ($items as $item) {
            $options .= "<option value='" . $item['id_destinationGroup'] . "'>" . $item['name'] . "</option>";
        }
        return $options;
    }
}
