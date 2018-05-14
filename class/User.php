<?php

class User
{
  protected $id_user,
            $pseudo,
            $email,
            $mdp,
            $niveau,
            $or_,
            $argent,
            $xp,
            $Xp_Max,
            $endu,
            $endu_Max,
            $emp_team_max;


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

  public function payer_argent($somme)
  {
    $this->argent = $this->argent - $somme;
  }

	// GETTERS //

  public function id_user() { return $this->id_user; }
  public function pseudo() { return $this->pseudo; }
  public function endu() { return $this->endu; }
  public function endu_Max() { return $this->endu_Max; }
  public function mdp() { return $this->mdp; }
  public function niveau() { return $this->niveau; }
  public function email() { return $this->email; }
  public function xp() { return $this->xp; }
  public function xp_Max() { return $this->xp_Max; }
  public function or_() { return $this->or_; }
  public function argent() { return $this->argent; }
  public function emp_team_max() { return $this->emp_team_max; }

  public function nomValide()
  {
    if (!empty($this->pseudo))
    {
      return true;
    }
  }

  public function setId_user($id_user)
  {
    // L'identifiant du personnage sera, quoi qu'il arrive, un nombre entier.
    $this->id_user = (int) $id_user;
  }

  public function setPseudo($pseudo)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($pseudo) && strlen($pseudo) <= 30)
    {
      $this->pseudo = $pseudo;
    }
  }

  public function setMdp($mdp)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($mdp) && strlen($mdp) <= 30)
    {
      $this->mdp = $mdp;
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

  public function setXp($xp)
  {
    $xp = (int) $xp;

    // On vérifie que l'xp n'est pas négatif.
    if ($xp >= 0)
    {
      $this->xp = $xp;
    }
  }

  public function setXp_Max($xp_Max)
  {
    $xp_Max = (int) $xp_Max;

    // On vérifie que l'XpMax n'est pas négatif.
    if ($xp_Max >= 0)
    {
      $this->Xp_Max = $xp_Max;
    }
  }

  public function setEndu($endu)
  {
    $endu = (int) $endu;

    $this->endu = $endu;

  }

  public function setEndu_Max($endu_Max)
  {
    $endu_Max = (int) $endu_Max;

    // On vérifie que l'XpMax n'est pas négatif.
    if ($endu_Max >= 0)
    {
      $this->endu_Max = $endu_Max;
    }
  }

  public function setOr_($or_)
  {
    $or_ = (int) $or_;

    // On vérifie que l'XpMax n'est pas négatif.
    if ($or_ >= 0)
    {
      $this->or_ = $or_;
    }
  }

  public function setArgent($argent)
  {
    $argent = (int) $argent;

    // On vérifie que l'XpMax n'est pas négatif.
    if ($argent >= 0)
    {
      $this->argent = $argent;
    }
  }

  public function setEmail($email)
  {
    // On vérifie qu'il s'agit bien d'une chaîne de caractères.
    // Dont la longueur est inférieure à 30 caractères.
    if (is_string($email) && strlen($email) <= 30)
    {
      $this->email = $email;
    }
  }

  public function setEmp_team_max($emp_team_max)
  {
    $emp_team_max = (int) $emp_team_max;

    $this->emp_team_max = $emp_team_max;

  }
}

?>
