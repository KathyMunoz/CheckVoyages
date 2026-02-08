<?php
class DestinationGroup {
    // ATRIBUTS
    private ?int $id_destinationGroup;
    private ?string $name;
    private ?PDO $bdd; // lien avec la base de données

    // CONSTRUCTEUR
    public function __construct(?PDO $bdd) {
        $this->bdd = $bdd;
    }

    // GETTERS & SETTERS
    public function getIdDestinationGroup(): ?int {
        return $this->id_destinationGroup;
    }
    public function setIdDestinationGroup(?int $id_destinationGroup): DestinationGroup {
        $this->id_destinationGroup = $id_destinationGroup;
        return $this;
    }
    public function getName(): ?string {
        return $this->name;
    }
    public function setName(?string $name): DestinationGroup {
        $this->name = $name;
        return $this;
    }
    public function getBDD(): ?PDO {
        return $this->bdd;
    }
    public function setBDD(?PDO $newBdd): DestinationGroup {
        $this->bdd = $newBdd;
        return $this;
    }

    // METHODES
    public function readDestinationGroups(): array {
        try {
            // je prépare ma requête
            $query = $this->getBDD()->prepare('SELECT id_destinationGroup, name FROM destinationGroup');
            // j'exécute ma requête
            $query->execute();
            // je récupère les résultats
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (Exception $error) {
            die($error->getMessage());
        }
    }
}