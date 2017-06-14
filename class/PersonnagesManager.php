<?php
class PersonnagesManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Base_personnage $perso, User $user, StuffManager $managerStuff)
  {
    $perso->hydrate([
		  'timeEndormi' => 0,
		  'xp' => 0,
      'atout' => 0,
      'team' => 0,
      'niveau' => 1,
      'stuff_4' => 0,
      'etat' => 'good'    
    ]);
    
		$stuff1 = New Stuff(['id_base' => $perso->stuff_1()]);
		$managerStuff->add($stuff1);
		
		$stuff2 = New Stuff(['id_base' => $perso->stuff_2()]);
		$managerStuff->add($stuff2);
		
		$stuff3 = New Stuff(['id_base' => $perso->stuff_3()]);
		$managerStuff->add($stuff3);				
		    
    $q = $this->db->prepare('INSERT INTO team(id_persos, id_user, niveau, xp, qualite, team, stuff_1, stuff_2,
    stuff_3, stuff_4, etat) 
    VALUES(:id_persos, :id_user, :niveau, :xp, :qualite, :team, :stuff_1, :stuff_2,
    :stuff_3, :stuff_4, :etat)');

    $q->bindValue(':id_persos', $perso->id_persos(), PDO::PARAM_INT);
    $q->bindValue(':id_user', $user->id_user(), PDO::PARAM_INT);    
    $q->bindValue(':qualite', $perso->qualite(), PDO::PARAM_STR);
    $q->bindValue(':team', 0, PDO::PARAM_INT);
    $q->bindValue(':stuff_1', $stuff1->id_stuff(), PDO::PARAM_INT);
    $q->bindValue(':stuff_2', $stuff2->id_stuff(), PDO::PARAM_INT);
    $q->bindValue(':stuff_3', $stuff3->id_stuff(), PDO::PARAM_INT); 
    $q->bindValue(':stuff_4', $perso->stuff_4(), PDO::PARAM_INT);   
    $q->bindValue(':etat', 'good', PDO::PARAM_STR);
    $q->bindValue(':niveau', 1, PDO::PARAM_INT);
    $q->bindValue(':xp', 0, PDO::PARAM_INT);
    $q->execute();
    
    $perso->hydrate([
      'id_perso' => $this->db->lastInsertId(),
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

      $q = $this->db->prepare('SELECT t.id_perso, t.niveau, t.xp, t.qualite, t.etat, t.stuff_1, t.stuff_2, t.stuff_3, t.stuff_4, 
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
      WHERE id_perso = :id_perso');
      $q->execute([':id_perso' => $info]);
      
      $perso = $q->fetch(PDO::FETCH_ASSOC);
    
    return new Personnage($perso);

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
    $persos = [];
    
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
  	$this->db->exec('DELETE FROM stuff WHERE id_stuff = '.$perso->stuff_1().' ');
  	$this->db->exec('DELETE FROM stuff WHERE id_stuff = '.$perso->stuff_2().' ');
  	$this->db->exec('DELETE FROM stuff WHERE id_stuff = '.$perso->stuff_3().' ');
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