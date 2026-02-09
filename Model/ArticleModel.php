<?php
class Article {
    // ATRIBUTS
    private ?int $id_article;
    private ?string $title;
    private ?string $content;
    private ?string $thumbnail;
    private ?string $creation_date;
    private ?int $id_user;
    private ?int $idDestination;
    private ?PDO $bdd;

    // CONSTRUCTOR
    public function __construct(?PDO $bdd) {
        $this->bdd = $bdd;
    }

    // GETTERS & SETTERS
    public function getIdArticle(): ?int {
        return $this->id_article;
    }
    public function setIdArticle(?int $id_article): Article {
        $this->id_article = $id_article;
        return $this;
    }
    public function getTitle(): ?string {
        return $this->title;
    }
    public function setTitle(?string $title): Article {
        $this->title = $title;
        return $this;
    }
    public function getContent(): ?string {
        return $this->content;
    }
    public function setContent(?string $content): Article {
        $this->content = $content;
        return $this;
    }
    public function getThumbnail(): ?string {
        return $this->thumbnail;
    }
    public function setThumbnail(?string $thumbnail): Article {
        $this->thumbnail = $thumbnail;
        return $this;
    }
    public function getCreationDate(): ?int {
        return $this->creation_date;
    }
    public function setCreationDate(?int $creation_date): Article {
        $this->creation_date = $creation_date;
        return $this;
    }
    public function getIdUser(): ?int {
        return $this->id_user;
    }
    public function setIdUser(?int $id_user): Article {
        $this->id_user = $id_user;
        return $this;
    }
    public function getIdDestination(): ?int {
        return $this->idDestination;
    }
    public function setIdDestination(?int $idDestination): Article {
        $this->idDestination = $idDestination;
        return $this;
    }
    public function getBDD(): ?PDO {
        return $this->bdd;
    }
    public function setBDD(?PDO $newBdd): Article {
        $this->bdd = $newBdd;
        return $this;

    }

    // METHODES
    public function readArticleByIdDestination():array {
        try {
            $query = $this->getBDD()->prepare('SELECT id_article, title, content, thumbnail, creation_date, id_user, id_destination FROM article WHERE id_destination = ?');
            $idDestination = $this->getIdDestination();
            $query->bindParam(1, $idDestination, PDO::PARAM_INT);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            return $data;

        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function readArticleByDestinationTitle(string $destinationTitle):array {
        try {
            $query = $this->getBDD()->prepare('SELECT a.id_article, a.title, a.content, a.thumbnail, a.creation_date, a.id_user, a.id_destination FROM article a INNER JOIN destination d ON a.id_destination = d.id_destination WHERE d.title = ?');
            $query->bindParam(1, $destinationTitle, PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetchAll(PDO::FETCH_ASSOC); // Utiliser fetchAll car il peut y avoir plusieurs articles
            
            return $data;
            
        } catch (Exception $error) {
            die($error->getMessage());
        }


    }

    public function readArticleById(): array {
        try {
            $query = $this->getBDD()->prepare('
                SELECT a.id_article, a.title, a.content, a.thumbnail, a.creation_date, a.id_user, a.id_destination, 
                       u.firstname, u.lastname, d.title as destination_title
                FROM article a 
                LEFT JOIN user u ON a.id_user = u.id_user 
                JOIN destination d ON a.id_destination = d.id_destination
                WHERE a.id_article = ?
            ');
            $id = $this->getIdArticle();
            $query->bindParam(1, $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    // --- ADD ARTICLE ---
    public function addArticle(string $title, string $content, int $id_user, int $id_destination): bool {
        try {
            $query = "INSERT INTO article (title, content, id_user, id_destination, creation_date) VALUES (?, ?, ?, ?, NOW())";
            $req = $this->getBDD()->prepare($query);
            return $req->execute([$title, $content, $id_user, $id_destination]);
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
}

?>