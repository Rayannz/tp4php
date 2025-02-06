<?php
class Nationalite {

    /**
     * numero de la nationalité
     *
     * @var int
     */
    private $num;



    /**
     * Libelle de la nationalité 
     * 
     * @var string
     */ 
    private $libelle;



    /**
     * num nationalité (clé étrangère) relié à num de nationalité 
     *
     * @var int
     */
    private $numcontinent;
    


    
    /**
     * Get the value of num
     * 
     * @var string
     */ 
    public function getNum()
    {
    return $this->num;
    }




    /**
     * lit le libelle 
     *
     * @return sting
     */
    public function getLibelle() : sting
    {
    return $this->libelle;
    }





    /**
     * ecrit dans le libelle
     *
     * @param string $libelle
     * @return self
     */
    public function setLibelle(string $libelle) : self
    {
    $this->libelle = $libelle;

    return $this;
    }
    




    /**
     * Get the value of numnaContinent
     */ 
    public function getNumcontinent()
    {
        return $this->numcontinent;
    }





    /**
     * Set the value of numContinent
     *
     * @return  self
     */ 
    public function setNumContinent($numContinent)
    {
        $this->numContinent = $numContinent;

        return $this;
    }





    /**
     * retourne l'ensemble des nationalité 
     *
     * @return nationalite[] tableau d'objet nationalité
     */
    public static function findAll() :array{
    
        $req=monPdo::getInstance()->prepare("select * from nationalite");
        $req->setFetchMode(PDO::FETCH_OBJ);
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats; 
    }





    /**
     * Trouve une nationalité par son num 
     *
     * @param integer $id numero du nationalité 
     * @return nationalite objet nationalité trouvé
     */
    public static function findById(int $id) :nationalité
    {
        $req=monPdo::getInstance()->prepare("select * from nationalité where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'nationalité');
        $req ->bindParam(':id', $id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat; 
    }
    




    /**
     * Permet d'ajouter un nationalité 
     *
     * @param Nationalite $nationalité continent à ajouter 
     * @return integer resultat (1 si loption et réussi, 0 sinon)
     */
    public static function add(nationalité $nationalite) :int
    {
        $req=monPdo::getInstance()->prepare("insert into nationalite (libelle,numContinent) values(:libelle, :numContinent)");
        $req ->bindParam(':libelle', $nationalite->getlibelle());
        $nb=$req->execute();
        return $nb;
    }





    /**
     * Permet de modifier un nationalité 
     *
     * @param nationalite $nationalité nationalité à modifier 
     * @return integer resultat (1 si loption et réussi, 0 sinon)
     */
    public static function update(nationalite $nationalite) :int 
    {
        $req=monPdo::getInstance()->prepare("update nationalite set libelle= :libelle where num= :id");
        $req ->bindParam(':id', $nationalite->getNum());
        $req ->bindParam(':libelle', $nationalite->getlibelle());
        $nb=$req->execute();
        return $nb;
    }





    /**
     * permet de suprimer une nationalité 
     *
     * @param nationalite $nationalite
     * @return integer
     */
    public static function delete(nationalite $nationalite) :int
    {
        $req=monPdo::getInstance()->prepare("delete from nationalite where num= :id");
        $req ->bindParam(':id', $nationalite->getNum());
        $nb=$req->execute();
        return $nb;
    }

}