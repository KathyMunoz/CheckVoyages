<?php

class Header {
    //ATTRIBUTES
    private string $title = '';
    private string $style = '';
    private PDO $bdd;

    // CONSTRUCTOR
    public function __constructr(){}

    // GETTER & SETTERS
    public function getTitle(): string {
        return $this->title;
    }
    public function setTitle(string $newTitle): Header {
        $this->title = $newTitle;
        return $this;
    }
    public function getStyle(): string {
        return $this->style;
    }
    public function setStyle(string $newStyle): Header {
        $this->style = $newStyle;
        return $this;
    }
    public function getBdd(): PDO {
        return $this->bdd;
    }
    public function setBdd(PDO $newBdd): Header {
        $this->bdd = $newBdd;
        return $this;
    }

    // METHODS
    public function renderExplorer():string {
        $destinationGroup = new DestinationGroup($this->getBdd());
        $groups = $destinationGroup->readDestinationGroups();
        $links = '';
        foreach ($groups as $group) {
            $links .= "<a href='destinationList.php?id_group=".$group['id_destinationGroup']."'>".$group['name']."</a>";
        }
        return $links;
    }
    public function renderHeader():string {
        $linkSession = '';
        $mobileLinkSession = '';

        if (isset($_SESSION['login'])) {
            $linkSession = '
            <div class="dropdown">
                <button id="btn-account">Mon Compte</button>
                <div id="menuAccount" class="dropdown-content">
                    <a href="profile.php">Mes infos</a>
                    <a href="addArticle.php">Ajouter un article</a>
                </div>
            </div>
            <a href="./signOut.php">Deconnexion</a>';
            $mobileLinkSession = '
            <a href="profile.php" class="mobile-item"><i class="fa-solid fa-user-gear"></i><span>Mon Compte</span></a>
            <a href="./signOut.php" class="mobile-item"><i class="fa-solid fa-user-slash"></i><span>Deconnexion</span></a>';
        } else {
            $linkSession = '<a href="./signIn.php">Connexion</a>
            <a href="./signUp.php">S\'inscrire</a>';
            $mobileLinkSession = '<a href="./signIn.php" class="mobile-item"><i class="fa-solid fa-user"></i><span>Connexion</span></a>
            <a href="./signUp.php" class="mobile-item"><i class="fa-solid fa-user-plus"></i><span>S\'inscrire</span></a>';
        }

        return "<!DOCTYPE html>
        <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>".$this->getTitle()."</title>
                <link rel='stylesheet' href='".$this->getStyle()."'>
                <link href='https://fonts.googleapis.com/css2?family=Mansalva&display=swap' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Mansalva&display=swap' rel='stylesheet'>
                <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=search' />
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css'> <!-- Pour les icônes version mobile -->
            </head>
            <body>
                <header>
                    <nav>
                        <p class='logo'>Check<span class='orange'>V</span>oyages</p>
                        <div class='nav-links'>
                            <div class='dropdown'><!-- conteneur global pour le positionnement -->
                        <button id='btn-explorer'>Explorer</button>
                        <div id='menuExplorer' class='dropdown-content'>
                            ".$this->renderExplorer()."
                        </div><!-- container vide pour le menu qui s'affiche au click -->
                    </div>
                    <a href='index.php#btn-popular-destinations' class='nav-popular'>Destinations aléatoires</a>
                    ".$linkSession."
                </div>
            </nav>
        </header>
        <!-- VERSION MENU MOBILE EN BAS -->
        <div class='mobile-menu'>
            <a href='#' class='mobile-item'><i class='fa-solid fa-compass'></i><span>Explorer</span></a><!--balise i: Lien Font Awesome transforme balise i en icônes -->
            <a href='index.php#btn-popular-destinations' class='mobile-item nav-popular'><i class='fa-solid fa-dice'></i><span>Aléatoires</span></a>
            ".$mobileLinkSession."
        </div>
        <script>
            const btnAccount = document.getElementById('btn-account');
            const menuAccount = document.getElementById('menuAccount');

            if (btnAccount && menuAccount) {
                btnAccount.addEventListener('click', () => {
                    menuAccount.style.display = menuAccount.style.display === 'block' ? 'none' : 'block';
                });

                document.addEventListener('click', function (e) {
                    if (e.target !== btnAccount && !menuAccount.contains(e.target)) {
                        menuAccount.style.display = 'none';
                    }
                });
            }
        </script>
        <main> ";
    }
}