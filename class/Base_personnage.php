<?php
/**
 * \class Base_personnage Base_personnage.php "class/Base_personnage.php" 
 * \file      Base_personnage.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date      26 Janvier 2018
 * \brief     Class de base des personnages.
 *
 * \details   Class de base des personnages. Elle définit les attributs et methodes inhérent à tous les personnages.
 */

class Base_personnage {
  protected $id_persos, /*!< id du personnage */
  					$nom, /*!< nom du personnage */
  					$types, /*!< type du personnage */
            $emp_team, /*!< emplacement si dans l'équipe */
            $etoile, /*!< étoile du personnage */
            $qualite, /*!< qualité du personnage */
            $stuff_1, /*!< id de l'équipement n°1 */
  					$stuff_2, /*!< id de l'équipement n°2 */
  					$stuff_3, /*!< id de l'équipement n°3 */
  					$stuff_4, /*!< id de l'équipement n°4 , vide par default */ 					
  					$pv, /*!< point de vie du personnage */
  					$att /*! degat du personnage */;
  					    
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
  public function id_persos() { return $this->id_persos; }
  public function qualite() { return $this->qualite; }
  public function types() { return $this->types; }
  public function etoile() { return $this->etoile; }
  public function stuff_1() { return $this->stuff_1; }
  public function stuff_2() { return $this->stuff_2; }
  public function stuff_3() { return $this->stuff_3; }
  public function stuff_4() { return $this->stuff_4; }
  public function pv() { return $this->pv; }
  public function att() { return $this->att; }



  public function setId_persos($id_persos)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->id_persos = (int) $id_persos;
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

  public function setTypes($types)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($types) && strlen($types) <= 30)
    {
      $this->types = $types;
    }
  }
    
  public function setPv($pv)
  {
    $pv = (int) $pv;

    // On vérifie que la vie n'est pas négative.
    if ($pv >= 0)
    {
      $this->pv = $pv;
    }
  }

  public function setAtt($att)
  {
    $att = (int) $att;

    // On vérifie que la vie n'est pas négative.
    if ($att >= 0)
    {
      $this->att = $att;
    }
  }

  public function setEmp_team($emp_team)
  {
    $emp_team = (int) $emp_team;

    // On vérifie que la vie n'est pas négative.
    if ($emp_team >= 0)
    {
      $this->emp_team = $emp_team;
    }
  }

  public function setStuff_1($stuff_1)
  {
    $stuff_1 = (int) $stuff_1;

    // On vérifie que la vie n'est pas négative.
    if ($stuff_1 >= 0)
    {
      $this->stuff_1 = $stuff_1;
    }
  }
  
  public function setStuff_2($stuff_2)
  {
    $stuff_2 = (int) $stuff_2;

    // On vérifie que la vie n'est pas négative.
    if ($stuff_2 >= 0)
    {
      $this->stuff_2 = $stuff_2;
    }
  }  

  public function setStuff_3($stuff_3)
  {
    $stuff_3 = (int) $stuff_3;

    // On vérifie que la vie n'est pas négative.
    if ($stuff_3 >= 0)
    {
      $this->stuff_3 = $stuff_3;
    }
  }

  public function setStuff_4($stuff_4)
  {
    $stuff_4 = (int) $stuff_4;

    // On vérifie que la vie n'est pas négative.
    if ($stuff_4 >= 0)
    {
      $this->stuff_4 = $stuff_4;
    }
  }                
     
}

?>