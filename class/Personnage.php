<?php
/**
 * \class Personnage Personnage.php "class/Personnage.php"
 * \file      Personnage.php
 * \author    Guillaume Nagiel
 * \version   1.0
 * \date      26 Janvier 2018
 * \brief     Class des personnages.
 *
 * \details   Class des personnages. Elle définit les attributs et methodes des personnages.
 */

class Personnage
{
  protected $atout,
  					$id_user,
            $id_perso,
            $niveau,
            $xp,
            $xp_min,
            $xp_max,
            $timeEndormi,
            $team,
  					$etat,
            $pv, /*!< point de vie du personnage */
            $pv_fight, /*!< Niveau de vie au maximum */
  					$att, /*! degat du personnage */
  					$def,
  					$vit,
  					$pen,
  					$arm,
  					$pre,
  					$esc,
  					$crit,
  					$ten,
  					$soi,
            $id_persos, /*!< id du personnage */
  					$nom, /*!< nom du personnage */
  					$types, /*!< type du personnage */
            $emp_team, /*!< emplacement si dans l'équipe */
            $etoile, /*!< étoile du personnage */
            $qualite, /*!< qualité du personnage */
            $stuff_1, /*!< id de l'équipement n°1 */
  					$stuff_2, /*!< id de l'équipement n°2 */
  					$stuff_3, /*!< id de l'équipement n°3 */
  					$stuff_4; /*!< id de l'équipement n°4 , vide par default */



  const CEST_MOI = 1;
  const PERSONNAGE_TUE = 2;
  const PERSONNAGE_FRAPPE = 3; // Constante renvoyée par la méthode `frapper` si le personnage qui veut frapper est endormi.
  const PERSONNAGE_ENSORCELE = 4; // Constante renvoyée par la méthode `lancerUnSort` (voir classe Magicien) si on a bien ensorcelé un personnage.
  const PAS_DE_MAGIE = 5; // Constante renvoyée par la méthode `lancerUnSort` (voir classe Magicien) si on veut jeter un sort alors que la magie du magicien est à 0.
  const PERSO_ENDORMI = 6;
  const PERSONNAGE_SOIGNE = 7;
	const PERSO_FULL_LIFE = 8;
  const ATT_ESQUIVE = 9;

  public function __construct($valeurs = array())
  {
    if(!empty($valeurs))
        $this->hydrate($valeurs);
    //$this->type = strtolower(static::class);
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

  public function estEndormi()
  {
  	$this->timeEndormi == 1;
    return $this->timeEndormi;
  }

 	/**
	 * \brief       Fonction pour frapper
	 * \details    Fonction permettant à un personnage de frapper un autre personnage. S'il est sa propre cible ou s'il est endormit, il ne pourra pas frapper
	 * \param    Personnage $perso         Perso qui se fait frapper.
	 * \param    Personnage $perso2         Person qui frappe.
	 * \return    Renvoie à la fonction qui permet de recevoir des dégats ("recevoirDegats()").
	 */
  public function frapper(Personnage $perso, Personnage $perso2)
  {
    //tableau de stockage des résultats.
    $retour = [];
    if ($perso->id_perso == $this->id_perso)
    {
      $retour[0] = 'CEST_MOI';
      return $retour;
    }

    if ($this->estEndormi())
    {
      $retour[0] = 'PERSO_ENDORMI';
      return $retour;
    }

    $hit = true;
    $precision = rand(1, $perso2->pre);
    $esquive = rand(1, $perso->esc);
    if ($precision < ($esquive/3))
    {
      $hit = false;
    }

    if (!$hit)
    {
      $retour[0] = 'ATT_ESQUIVE';
      return $retour;
    }

    // On indique au personnage qu'il doit recevoir des dégâts.
    // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_TUE ou self::PERSONNAGE_FRAPPE.
    //$this->recevoirXP(3);
    return $perso->recevoirDegats($perso2);
  }

	public function recevoirXP($val)
  {
    $this->xp += $val;
  }

	public function recevoirDegats($perso2)
  {
    //tableau de stockage des résultats.
    $retour = [];

    //Calcul des dégats infligés
    $degat = $perso2->att - $this->def;

    //Calcul du coup critique
    $critique = 1;
    $crit = rand(1, $perso2->crit);
    $tenacite = rand(1, $this->ten);
    if ($crit < ($tenacite/3))
    {
      $critique = 3;
    }

    //Calcul des dégats subits
    $protection = $perso2->pen / $this->arm;
    $degat = ($degat * $protection)*$critique;



    //Application des dégats
    $this->pv_fight = $this->pv_fight - $degat;

    // Si on a 100 de dégâts ou plus, on dit que le personnage a été tué.
    if ($this->pv_fight <= 0)
    {
    	$this->pv_fight = 0;
    	$this->etat = "kill";
      $retour[0] = 'PERSONNAGE_TUE';
      $retour[1] = $degat;
      $retour[2] = $critique;
      return $retour;
    }

    // Sinon, on se contente de dire que le personnage a bien été frappé.
    $retour[0] = 'PERSONNAGE_FRAPPE';
    $retour[1] = $degat;
    $retour[2] = $critique;
    return $retour;
  }

  public function soigner(Personnage $perso)
  {

    if ($this->estEndormi())
    {
      return self::PERSO_ENDORMI;
    }
    //$this->magie -= 10;
    // On indique au personnage qu'il doit recevoir des soins.
    // Puis on retourne la valeur renvoyée par la méthode : self::PERSONNAGE_SOIGNE.
    return $perso->recevoirSoins($this);
  }

	public function recevoirSoins($perso)
  {
  	$this->pv_fight += 60;
    if ($this->pv_fight >= $this->pv)
    {
    $this->pv_fight = $this->pv;
  	}
    // Sinon, on se contente de dire que le personnage a bien été soigné.
    return self::PERSONNAGE_SOIGNE;
  }

	public function debut_combat()
  {
    $this->pv_fight = $this->pv;
  	$this->etat = 'good';
  	$this->timeEndormi = 0;
  }

  public function reveil()
  {
    $this->timeEndormi = 0;
  }

	public function incrementAtout()
  {
  	if ($this->atout == 2) {
  		$this->atout = 0;
  	}
  	else {
  		$this->atout++;
  	}
  }

	// GETTERS //


  public function id_user() { return $this->id_user; }
  public function id_perso() { return $this->id_perso; }
  public function xp() { return $this->xp; }
  public function xp_max() { return $this->xp_max; }
  public function xp_min() { return $this->xp_min; }
  public function niveau() { return $this->niveau; }
  public function qualite() { return $this->qualite; }
  public function etoile() { return $this->etoile; }
  public function atout() { return $this->atout; }
  public function timeEndormi() { return $this->timeEndormi; }
  public function types() { return $this->types; }
  public function team() { return $this->team; }
  public function def() { return $this->def; }
  public function vit() { return $this->vit; }
  public function pen() { return $this->pen; }
  public function arm() { return $this->arm; }
  public function pre() { return $this->pre; }
  public function esc() { return $this->esc; }
  public function crit() { return $this->crit; }
  public function ten() { return $this->ten; }
  public function soi() { return $this->soi; }
  public function etat() { return $this->etat; }
  public function nom() { return $this->nom; }
  public function id_persos() { return $this->id_persos; }
  public function stuff_1() { return $this->stuff_1; }
  public function stuff_2() { return $this->stuff_2; }
  public function stuff_3() { return $this->stuff_3; }
  public function stuff_4() { return $this->stuff_4; }
  public function pv() { return $this->pv; }
  public function pv_fight() { return $this->pv_fight; }
  public function att() { return $this->att; }
  public function emp_team() { return $this->emp_team; }

  public function setAtout($atout)
  {
    $atout = (int) $atout;

    if ($atout >= 0 && $atout <= 3)
    {
      $this->atout = $atout;
    }
  }

  public function setId_user($id_user)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->id_user = (int) $id_user;
  }

  public function setId_perso($id_perso)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->id_perso = (int) $id_perso;
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

  public function setXp($xp)
  {
    $xp = (int) $xp;

    $this->xp = $xp;
  }

  public function setXp_max($xp_max)
  {
    $xp_max = (int) $xp_max;

    $this->xp_max = $xp_max;
  }

  public function setXp_min($xp_min)
  {
    $xp_min = (int) $xp_min;

    $this->xp_min = $xp_min;
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

  public function setNiveau($niveau)
  {
    $niveau = (int) $niveau;

    // On vérifie que le niveau n'est pas négatif.
    if ($niveau >= 0)
    {
      $this->niveau = $niveau;
    }
  }

  public function setTimeEndormi($time)
  {
    $this->timeEndormi = (int) $time;
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

  public function setTeam($team)
  {
    $team = (int) $team;
    if ($team >= 0)
    {
      $this->team = $team;
    }
  }

  public function setDef($def)
  {
    $def = (int) $def;

    // On vérifie que la vie n'est pas négative.
    if ($def >= 0)
    {
      $this->def = $def;
    }
  }

  public function setVit($vit)
  {
    $vit = (int) $vit;

    // On vérifie que la vie n'est pas négative.
    if ($vit >= 0)
    {
      $this->vit = $vit;
    }
  }

  public function setPen($pen)
  {
    $pen = (int) $pen;

    // On vérifie que la vie n'est pas négative.
    if ($pen >= 0)
    {
      $this->pen = $pen;
    }
  }

  public function setArm($arm)
  {
    $arm = (int) $arm;

    // On vérifie que la vie n'est pas négative.
    if ($arm >= 0)
    {
      $this->arm = $arm;
    }
  }

  public function setPre($pre)
  {
    $pre = (int) $pre;

    // On vérifie que la vie n'est pas négative.
    if ($pre >= 0)
    {
      $this->pre = $pre;
    }
  }

  public function setEsc($esc)
  {
    $esc = (int) $esc;

    // On vérifie que la vie n'est pas négative.
    if ($esc >= 0)
    {
      $this->esc = $esc;
    }
  }

  public function setCrit($crit)
  {
    $crit = (int) $crit;

    // On vérifie que la vie n'est pas négative.
    if ($crit >= 0)
    {
      $this->crit = $crit;
    }
  }

  public function setTen($ten)
  {
    $ten = (int) $ten;

    // On vérifie que la vie n'est pas négative.
    if ($ten >= 0)
    {
      $this->ten = $ten;
    }
  }

  public function setSoi($soi)
  {
    $soi = (int) $soi;

    // On vérifie que la vie n'est pas négative.
    if ($soi >= 0)
    {
      $this->soi = $soi;
    }
  }

  public function setEtat($etat)
  {
    $this->etat = $etat;
  }

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

  public function setPv_fight($pv_fight)
  {
    $pv_fight = (int) $pv_fight;

    // On vérifie que la vie n'est pas négative.
    if ($pv_fight >= 0)
    {
      $this->pv_fight = $pv_fight;
    }
  }
}

?>
