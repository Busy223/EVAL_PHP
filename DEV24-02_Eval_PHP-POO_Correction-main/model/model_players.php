<?php
//MODEL POUR LA CLASS MODELPLAYER
class ModelPlayer{
    //Attributs
    private ?int $id;
    private ?string $pseudo;
    private ?string $email;
    private ?int $score;
    private ?string $password;
    private ?PDO $bdd;

    //CONSTRUCTEUR
    public function __construct(){
        $this->bdd = connect();
    }

    //GETTER ET SETTER
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }

    public function getPseudo(): ?string { return $this->pseudo; }
    public function setPseudo(?string $pseudo): self { $this->pseudo = $pseudo; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): self { $this->email = $email; return $this; }

    public function getScore(): ?int { return $this->score; }
    public function setScore(?int $score): self { $this->score = $score; return $this; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): self { $this->password = $password; return $this; }

    public function getBdd(): ?PDO { return $this->bdd; }
    public function setBdd(?PDO $bdd): self { $this->bdd = $bdd; return $this; }
}
?>