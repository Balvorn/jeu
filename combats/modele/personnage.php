<?php

class personnage
{
    protected $id, $degats, $nom, $erreur, $image;
const frappe = 1, tue = 2;

    /**
     * @param int $degats
     */

        public function __construct($data =[])
    {
        $this->erreur = [];
        $this->hydratation($data);
    }
    protected function hydratation($data){
        foreach ($data as $key => $value){
            $setter = 'set' . ucfirst($key);
            if(method_exists($this, $setter))
                $this->$setter($value);
        }
    }
    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
    /**
     * @param $degats
     */
    public function setDegats($degats)
    {
        $this->degats = $degats;
    }

    /**
     * @param mixed $erreur
     */
    public function setErreur($erreur)
    {
        $this->erreur = $erreur;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        if ($nom != ""){
        $this->nom = $nom;
        }else{
            array_push($this->erreur, "nom invalide");
        }
    }
/////////////////////////////////////////////////////////////
///
///
    /**
     * @return int
     */
    public function getDegats()
    {
        return $this->degats;
    }

    /**
     * @return mixed
     */
    public function getErreur()
    {
        return $this->erreur;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }
///////////////////////////////////////////
///
///
    public function attaquer($cible)
     {$cible->degats += 5;
      return $cible->recevoirDegats();

    }

    public function recevoirDegats()
    {
        if ($this->degats >= 100) {
            return self::tue;
        } else {
            return self::frappe;
        }

    }
}