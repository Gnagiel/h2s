<?php
class Stuff
{
  protected $id_stuff,
  					$nom,
  					$types,
            $etoile,
            $niveau,
            $qualite,
            $atr_1,
  					$atr_2,	
  					$id_base,	
  					$descr;
  					    
  public function __construct($valeurs = array())
  {
    if(!empty($valeurs))
        $this->hydrate($valeurs);
    $this->type = strtolower(static::class);
  }
  
  // Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees)
	{
	  foreach ($donnees as $key => $value)
	  {
	    // On récupère le nom du setter correspondant à l'attribut.
	    $method = 'set'.ucfirst($key);
	        
	    // Si le setter correspondant existe.
	    if (method_exists($this, $method))
	    {
	      // On appelle le setter.
	      $this->$method($value);
	    }
	  }
	}
	
	// GETTERS //

  public function nom() { return $this->nom; }
  public function id_stuff() { return $this->id_stuff; }
  public function id_base() { return $this->id_base; }
  public function niveau() { return $this->niveau; }  
  public function qualite() { return $this->qualite; }
  public function types() { return $this->types; }
  public function etoile() { return $this->etoile; }
  public function atr_1() { return $this->atr_1; }
  public function atr_2() { return $this->atr_2; }
  public function descr() { return $this->descr; }



  public function setId_stuff($id_stuff)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->id_stuff = (int) $id_stuff;
  }

  public function setId_base($id_base)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->id_base = (int) $id_base;
  }

  public function setNiveau($niveau)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->niveau = (int) $niveau;
  }
    
  public function setNom($nom)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($nom) && strlen($nom) <= 30)
    {
      $this->nom = $nom;
    }
  }

  public function setQualite($qualite)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($qualite) && strlen($qualite) <= 30)
    {
      $this->qualite = $qualite;
    }
  }

  public function setDescr($descr)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($descr) && strlen($descr) <= 150)
    {
      $this->descr = $descr;
    }
  }
  
  public function setTypes($types)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($types) && strlen($types) <= 30)
    {
      $this->types = $types;
    }
  }
  
  public function setEtoile($etoile)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($etoile) && strlen($etoile) <= 30)
    {
      $this->etoile = $etoile;
    }
  }
  
  public function setAtr_1($atr_1)
  {
    $atr_1 = (int) $atr_1;

    // On vérifie que la vie n'est pas négative.
    if ($atr_1 >= 0)
    {
      $this->atr_1 = $atr_1;
    }
  }  

  public function setAtr_2($atr_2)
  {
    $atr_2 = (int) $atr_2;

    // On vérifie que la vie n'est pas négative.
    if ($atr_2 >= 0)
    {
      $this->atr_2 = $atr_2;
    }
  }
}

?>