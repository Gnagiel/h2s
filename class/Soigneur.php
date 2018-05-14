<?php

class Soigneur extends Personnage
{
  public function lancerUnSoin(Personnage $perso)
  {        
    if ($perso->id == $this->id)
    {
      $this->soigner($this);
    }
        
    if ($this->estEndormi())
    {
      return self::PERSO_ENDORMI;
    }
    
    $this->soigner($perso, $this);
    $this->recevoirXP(5);    
    return self::PERSONNAGE_SOIGNE;
  }
}