<?php

class UserManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(User $user)
  {
    $user->hydrate([

		  'niveau' => 1,
		  'xp' => 0,
      'or_' => 500,
      'argent' => 2000,
      'endu' => 50,    
    ]);
    
    $q = $this->db->prepare('INSERT INTO users(pseudo, email, niveau, mdp, xp, or_, argent, endu) 
    VALUES(:pseudo, :email, :niveau, :mdp, :xp, :or_, :argent, :endu)');

    $q->bindValue(':pseudo', $user->pseudo(), PDO::PARAM_STR);
    $q->bindValue(':email', $user->email(), PDO::PARAM_STR);
    $q->bindValue(':niveau', $user->niveau(), PDO::PARAM_INT);
    $q->bindValue(':mdp', $user->mdp(), PDO::PARAM_STR);
    $q->bindValue(':xp', $user->xp(), PDO::PARAM_INT);
    $q->bindValue(':or_', $user->or_(), PDO::PARAM_INT);
    $q->bindValue(':argent', $user->argent(), PDO::PARAM_INT);
    $q->bindValue(':endu', $user->endu(), PDO::PARAM_INT);


    $q->execute();
    
    $user->hydrate([
      'id_user' => $this->db->lastInsertId(),
    ]);
  }

	public function verifMdp($pseudo, $pass)
	{
    $q = $this->db->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
    $q->execute([':pseudo' => $pseudo]);
    while ($d = $q->fetch())
    {
    	if ($pass == $d["MDP"])
    	{    		
    		return true;
    	}
    }
	}

	
  public function count()
  {
    return $this->db->query('SELECT COUNT(*) FROM users')->fetchColumn();
  }

  public function delete(User $user)
  {
    $this->db->exec('DELETE FROM users WHERE id_user = '.$user->id());
  }
    
  public function exists($info)
  {
    if (is_int($info)) // On veut voir si tel personnage ayant pour id $info existe.
    {
      return (bool) $this->db->query('SELECT COUNT(*) FROM users WHERE id_user = '.$info)->fetchColumn();
    }
    
    // Sinon, c'est qu'on veut vérifier que le nom existe ou pas.
    
    $q = $this->db->prepare('SELECT COUNT(*) FROM users WHERE pseudo = :pseudo');
    $q->execute([':pseudo' => $info]);
    
    return (bool) $q->fetchColumn();
  }
  
  public function get($info)
  {
    if (is_int($info))
    {
      $q = $this->db->query('SELECT u.id_user, u.email ,u.mdp ,u.pseudo ,u.niveau ,u.or_ ,u.argent ,u.endu ,u.xp ,
      n.xp_max ,n.endu_max ,n.emp_team_max
      FROM users u
      INNER JOIN niv_user n
   		ON u.niveau = n.niv_user      
      WHERE id_user = '.$info);
      $user = $q->fetch(PDO::FETCH_ASSOC);
      return new user($user);
    }
    
    else
    {
      $q = $this->db->prepare('SELECT u.id_user, u.email ,u.mdp ,u.pseudo ,u.niveau ,u.or_ ,u.argent ,u.endu ,u.xp ,
      n.xp_max ,n.endu_max ,n.emp_team_max
      FROM users u
      INNER JOIN niv_user n
   		ON u.niveau = n.niv_user
      WHERE u.pseudo = :pseudo');
      $q->execute([':pseudo' => $info]);     
      $user = $q->fetch(PDO::FETCH_ASSOC);
      return new User($user);
    }
  }
  
  public function getList($pseudo)
  {
    $user = [];
    
    $q = $this->db->prepare('SELECT * 
    FROM users WHERE pseudo <> :pseudo ORDER BY pseudo');
    $q->execute([':pseudo' => $pseudo]);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    $user[] = new User($donnees);  
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $user[] = new User($donnees); 
    }    
    return $user;
  }

  public function update(User $user)
  {
    $q = $this->db->prepare('UPDATE users 
    SET niveau = :niveau, xp = :xp, mdp = :mdp, or_ = :or_, argent = :argent, endu = :endu 
    WHERE id_user = :id');

    $q->bindValue(':niveau', $user->niveau(), PDO::PARAM_INT);
    $q->bindValue(':xp', $user->xp(), PDO::PARAM_INT);
    $q->bindValue(':mdp', $user->mdp(), PDO::PARAM_STR);
    $q->bindValue(':id', $user->id_user(), PDO::PARAM_INT);
    $q->bindValue(':endu', $user->endu(), PDO::PARAM_INT);
    $q->bindValue(':or_', $user->or_(), PDO::PARAM_INT);
    $q->bindValue(':argent', $user->argent(), PDO::PARAM_INT);

    $q->execute();
  }

  public function setDb($db)
  {
    $this->db = $db;
  }
}
?>