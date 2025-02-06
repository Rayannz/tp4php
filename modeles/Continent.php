<?php
class Continent {

    /**
     * numero du continent
     *
     * @var int
     */
    private $num;

    /**
     * Libelle du continent 
     * 
     * @var string
     */ 
    private $libelle;

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
     * lis le libelle 
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
     * retourne l'ensemble des continents 
     *
     * @return Continent[] tableau d'objet continent
     */
    public static function findAll() :array
    {
        $req=monPdo::getInstance()->prepare("select * from continent");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req->execute();
        $lesResultats=$req->fetchAll();
        return $lesResultats; 
    }
    /**
     * Trouve un continent par son num 
     *
     * @param integer $id numero du continent 
     * @return Continent objet continent trouvé
     */
    public static function findById(int $id) :Continent
    {
        $req=monPdo::getInstance()->prepare("select * from continent where num= :id");
        $req->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE,'Continent');
        $req ->bindParam(':id', $id);
        $req->execute();
        $leResultat=$req->fetch();
        return $leResultat; 
    }
    
    /**
     * Permet d'ajouter un continent 
     *
     * @param continent $continent à ajouter 
     * @return integer resultat (1 si loption et réussi, 0 sinon)
     */
    public static function add(continent $continent) :int
    {
        $req=monPdo::getInstance()->prepare("insert into continent(libelle) values(:libelle)");
        $req ->bindParam(':libelle', $continent->getlibelle());
        $nb=$req->execute();
        return $nb;
    }
    /**
     * Permet de modifier un conionent 
     *
     * @param continent $continent continent à modifier 
     * @return integer resultat (1 si loption et réussi, 0 sinon)
     */
    public static function update(continent $continent) :int 
    {
        $req=monPdo::getInstance()->prepare("update continent set libelle= :libelle where num= :id");
        $req ->bindParam(':id', $continent->getNum());
        $req ->bindParam(':libelle', $continent->getlibelle());
        $nb=$req->execute();
        return $nb;
    }
    /**
     * permet de suprimer un continent 
     *
     * @param continent $continent
     * @return integer
     */
    public static function delete(continent $continent) :int
    {
        $req=monPdo::getInstance()->prepare("delete from continent where num= :id");
        $req ->bindParam(':id', $continent->getNum());
        $nb=$req->execute();
        return $nb;
    }
}