<?php

class personnageManager
{

    // Attributs

    /**
     * @var PDO
     *
     */
    protected $pdo;

    /**
     * @return PDO
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param PDO $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function persoExist(personnage $perso)
    {
        $sql = 'SELECT nom FROM personnages where nom = ? ';
        $result = $this->pdo->prepare($sql);
        $result->bindValue(1, $perso->getNom());
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, personnage::class);
        return $result->fetch();
    }

    public function insertPerso(personnage $perso)
    {
        $sql = 'INSERT INTO personnages VALUES(null, ?, 0, null) ';
        $result = $this->pdo->prepare($sql);
        $result->bindValue(1, $perso->getNom());
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, personnage::class);
        return $perso->setId($this->pdo->lastInsertId());
    }

    public function listPersos()
    {
        $sql = 'SELECT id, nom, degats, image FROM personnages';
        $result = $this->pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, personnage::class);
        return $result->fetchAll();
    }
    public function getPersoById($id){
        $sql = 'SELECT id, nom, degats, image FROM personnages where id = ?';
        $result = $this->pdo->prepare($sql);
        $result->bindValue(1, $id);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, personnage::class);
        return $result->fetch();
    }

public function delete(personnage $perso){
    $sql = 'DELETE FROM personnages WHERE id = ?';
    $result = $this->pdo->prepare($sql);
    $result->bindValue(1, $perso->getId());
    $result->execute();
return 'perso effacé';
}
public function update(personnage $perso){
    $sql = 'UPDATE personnages  SET degats = ? WHERE id = ?';
    $result = $this->pdo->prepare($sql);
    $result->bindValue(1, $perso->getDegats());
    $result->bindValue(2, $perso->getId());
    $result->execute();
}
}