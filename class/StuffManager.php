<?php
class StuffManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Stuff $stuff)
  {
    $r = $this->db->prepare('SELECT atr_1, atr_2 
    FROM base_stuff 
    WHERE id_base_stuff = :id_base_stuff');  
    $r->bindValue(':id_base_stuff', $stuff->id_base(), PDO::PARAM_INT);
    
    $r->execute(); 
		$base_stuff = $r->fetch(PDO::FETCH_OBJ); 
		  	
    $stuff->hydrate([
      'niveau' => 1,
      'qualite' => 1
    ]);
    
    $q = $this->db->prepare('INSERT INTO stuff(niveau, qualite, id_base, atr_1, atr_2) 
    VALUES(:niveau, :qualite , :id_base, (SELECT atr_1 
    FROM base_stuff 
    WHERE id_base_stuff = :id_base_stuff), (SELECT atr_2 
    FROM base_stuff 
    WHERE id_base_stuff = :id_base_stuff))');

    $q->bindValue(':id_base', $stuff->id_base(), PDO::PARAM_INT);    
    $q->bindValue(':qualite', 1, PDO::PARAM_INT);
    $q->bindValue(':id_base_stuff', $stuff->id_base(), PDO::PARAM_INT);
    $q->bindValue(':niveau', $stuff->niveau(), PDO::PARAM_INT);
    $q->execute();
    
    $stuff->hydrate([
      'id_stuff' => $this->db->lastInsertId(),
    ]);
  }

  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM team')->fetchColumn();
  }
    
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM team WHERE id = '.$info)->fetchColumn();
    }
  }

  public function get_id_team($info, $user)
  {
    $q = $this->db->prepare('SELECT t.id_perso, p.nom, q.etoile 
    FROM team t
    INNER JOIN persos p
 		ON t.id_persos = p.id_persos    
 		INNER JOIN q_perso q
 		ON t.qualite = q.id_q   
    WHERE t.id_user = :id_user AND t.team = :team');  
    $q->bindValue(':team', $info, PDO::PARAM_INT);
    $q->bindValue(':id_user', $user, PDO::PARAM_INT);
    
    $q->execute(); 
		$perso = $q->fetch(PDO::FETCH_ASSOC);       
    return $perso;
  }
    
  public function get($info)
  {

      $q = $this->db->prepare('SELECT s.id_stuff, s.niveau, s.qualite, s.id_base,
      b.nom, b.descr, b.types,  
      q.etoile,
      n.up_atr_1, n.up_atr_2,
      (b.atr_1 + n.up_atr_1 + q.up_atr_1) atr_1, 
      (b.atr_2 + n.up_atr_2 + q.up_atr_2) atr_2      
      FROM stuff s
      INNER JOIN base_stuff b
   		ON s.id_base = b.id_base_stuff       
      INNER JOIN q_stuff q
   		ON s.qualite = q.id_q_stuff  
	 		INNER JOIN niv_stuff n
	 		ON s.niveau = n.niv_stuff    		      
      WHERE s.id_stuff = :id_stuff');
      $q->execute([':id_stuff' => $info]);
      
      $stuff = $q->fetch(PDO::FETCH_ASSOC);
    
    return new Stuff($stuff);

  }

  public function get_base_perso($id)
  {    
    $q = $this->db->prepare('SELECT id_persos, nom, types, emp_team, q_base as qualite, stuff_1, 
    stuff_2, stuff_3,
			(pv + (
	      SELECT s.atr_2
				FROM base_stuff s
	      WHERE s.id_base_stuff = persos.stuff_3   
      )) pv, 
      (att + (
	      SELECT s.atr_1
				FROM base_stuff s
	      WHERE s.id_base_stuff = persos.stuff_1   
      )) att     
    FROM persos
    WHERE id_persos = :id_persos');
    $q->execute([':id_persos' => $id]);
      
    $perso = $q->fetch(PDO::FETCH_ASSOC);
    
    return new Base_personnage($perso);    
  }
  
  public function getListCheat()
  {
    $persos = ['coucou'];
    
    $q = $this->db->query('SELECT id_persos, nom, types, emp_team, q_base as qualite, stuff_1, 
    stuff_2, stuff_3,
			(pv + (
	      SELECT s.atr_2
				FROM base_stuff s
	      WHERE s.id_base_stuff = persos.stuff_3   
      )) pv, 
      (att + (
	      SELECT s.atr_1
				FROM base_stuff s
	      WHERE s.id_base_stuff = persos.stuff_1   
      )) att     
    FROM persos ');
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    	$persos[] = new Base_personnage($donnees);
    }
    
    return $persos;
  }
    
  public function getList(User $user)
  {
    $persos = [];
    
    $q = $this->db->prepare('SELECT t.id_perso, t.niveau, t.xp, t.qualite, t.etat, t.stuff_1, t.stuff_2, t.stuff_3, t.stuff_4, t.team,
    p.nom, p.types, p.emp_team, 
    p.id_persos, 
    q.etoile,  
    (p.pv + (
      SELECT s.atr_1
			FROM stuff s
      WHERE s.id_stuff = t.stuff_3   
    )) pv, 
    (p.att + (
      SELECT s.atr_1
			FROM stuff s
      WHERE s.id_stuff = t.stuff_1   
    )) att,
    (p.def + (
      SELECT s.atr_1
			FROM stuff s
      WHERE s.id_stuff = t.stuff_2   
    )) def, 
    p.vit, 
    p.pen, p.arm, p.pre, p.esc, p.crit, p.ten, p.soi,
    n.xp_max      
    FROM team t
    INNER JOIN persos p
 		ON t.id_persos = p.id_persos       
    INNER JOIN niv_perso n
 		ON t.niveau = n.niv_perso  
 		INNER JOIN q_perso q
 		ON t.qualite = q.id_q   		      
    WHERE id_user = :id_user
    ORDER BY t.niveau, p.nom');
    $q->execute([':id_user' => $user->id_user()]);
    
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    	$persos[] = new Personnage($donnees);
    }
    
    return $persos;
  }

  public function delete(Personnage $perso)
  {
    $this->db->exec('DELETE FROM team WHERE id_perso = '.$perso->id_perso().' ');
  }

  public function sup_team()
  {
    $q = $this->db->prepare('UPDATE team 
    SET team = 0');
    
    $q->execute();
  }
  
  public function update_team($team, $id_perso)
  {
    $q = $this->db->prepare('UPDATE team 
    SET team = :team
    WHERE id_perso = :id_perso');

    $q->bindValue(':team', $team, PDO::PARAM_INT);
    $q->bindValue(':id_perso', $id_perso, PDO::PARAM_INT);
    
    $q->execute();
  }
    
  public function update(Personnage $perso)
  {
    $q = $this->db->prepare('UPDATE team 
    SET forcePerso = :forcePerso, degats = :degats, niveau = :niveau, experience = :experience, 
    timeEndormi = :timeEndormi, atout = :atout, XpMax = :XpMax, vie = :vie, vieMax = :vieMax, 
    magie = :magie, magieMax = :magieMax, inte = :inte, etat = :etat WHERE id = :id');

    $q->bindValue(':forcePerso', $perso->forcePerso(), PDO::PARAM_INT);
    $q->bindValue(':degats', $perso->degats(), PDO::PARAM_INT);
    $q->bindValue(':niveau', $perso->niveau(), PDO::PARAM_INT);
    $q->bindValue(':experience', $perso->experience(), PDO::PARAM_INT);
    $q->bindValue(':timeEndormi', $perso->timeEndormi(), PDO::PARAM_INT);
    $q->bindValue(':atout', $perso->atout(), PDO::PARAM_INT);
    $q->bindValue(':id', $perso->id(), PDO::PARAM_INT);
    $q->bindValue(':XpMax', $perso->XpMax(), PDO::PARAM_INT);
    $q->bindValue(':vie', $perso->vie(), PDO::PARAM_INT);
    $q->bindValue(':vieMax', $perso->vieMax(), PDO::PARAM_INT);
    $q->bindValue(':magie', $perso->magie(), PDO::PARAM_INT);
    $q->bindValue(':magieMax', $perso->magieMax(), PDO::PARAM_INT);
    $q->bindValue(':inte', $perso->inte(), PDO::PARAM_INT);
    $q->bindValue(':etat', $perso->etat(), PDO::PARAM_INT);
    
    $q->execute();
  }

  public function setDb($db)
  {
    $this->db = $db;
  }
}
?>