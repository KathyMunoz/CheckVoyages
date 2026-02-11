<?php
class Destination {
    // ATRIBUTS
    private ?int $id_destination;
    private ?string $title;
    private ?string $content;
    private ?string $thumbnail;
    private ?string $publication_date;
    private ?PDO $bdd; // lien avec la base de données

    // CONSTRUCTEUR
    public function __construct(?PDO $bdd) {
        $this->bdd = $bdd;
    }

    // GETTERS & SETTERS
    public function getIdDestination(): ?int {
        return $this->id_destination;
    }
    public function setIdDestination(?int $id_destination): Destination {
        $this->id_destination = $id_destination;
        return $this;
    }
    public function getTitle(): ?string {
        return $this->title;
    }
    public function setTitle(?string $title): Destination {
        $this->title = $title;
        return $this;
    }
    public function getContent(): ?string {
        return $this->content;
    }
    public function setContent(?string $content): Destination {
        $this->content = $content;
        return $this;
    }
    public function getThumbnail(): ?string {
        return $this->thumbnail;
    }
    public function setThumbnail(?string $thumbnail): Destination {
        $this->thumbnail = $thumbnail;
        return $this;
    }
    public function getPublicationDate(): ?string {
        return $this->publication_date;
    }
    public function setPublicationDate(?string $publication_date): Destination {
        $this->publication_date = $publication_date;
        return $this;
    }
    public function getBDD(): ?PDO {
        return $this->bdd;
    }
    public function setBDD(?PDO $newBdd): Destination {
        $this->bdd = $newBdd;
        return $this;
    }

    // METHODES
    public function readIdByTitle():int {
        try {
            // Je prépare ma requête pour obtenir l'id à partir du titre (query = requête)
            $query = $this->getBDD()->prepare('SELECT id_destination FROM destination WHERE title = ?');
            // Je récupère le titre depuis les attributs de mon objet
            $title = $this->getTitle();
            // Binding du paramètre
            $query->bindParam(1, $title, PDO::PARAM_STR);
            // Execution de la requête
            $query->execute();
            // Je récupère le résultat
            $data = $query->fetch(PDO::FETCH_ASSOC);
            // (int) pour convertir en entier (le cast), $data["id_destination"] pour accéder à la valeur de mon tableau associatif
            return (int)$data["id_destination"]; 
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function readDestinationById(): array {
        try {
            $query = $this->getBDD()->prepare('SELECT id_destination, title, content, thumbnail, publication_date FROM destination WHERE id_destination = ?');
            $id = $this->getIdDestination();
            $query->bindParam(1, $id, PDO::PARAM_INT);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC) ?: [];
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }

    public function getRandomDestination(int $number): array {
        try {
            // Je prépare ma requête pour obtenir une destination aléatoire
            $query = $this->getBDD()->prepare('SELECT id_destination, title, thumbnail FROM destination ORDER BY RAND() LIMIT ?');
            // Binding du paramètre, prépare et découpe ma requête une par une
            $query->bindParam(1, $number, PDO::PARAM_INT);
            // Execution de la requête
            $query->execute();
            // Je récupère le résultat
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            // La réponse de Fetch est gardé dans $data
            return $data;
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
    public function listDestinationsByGroup(int $id_group): array {
        try {
            $query = $this->getBDD()->prepare('SELECT id_destination, title, thumbnail FROM destination WHERE id_destinationGroup = ?');
            $query->bindParam(1, $id_group, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
}

?>