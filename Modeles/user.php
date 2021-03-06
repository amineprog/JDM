<?php

/* require_once ROOT . '/Modeles/modele.php'; */
require_once  'modele.php';

class User extends Modele {
	private $id;
	private $login;
	private $passe;
	private $email;
	private $score;
	private $typeUser;
	private $dateCreation;
	private $dateModif;
	
	public function __construct() {
		$this->id = -1;
		$this->login = '';
		$this->passe = '';
		$this->email = '';
		$this->score = '';
		$this->typeUser = '';
		$this->dateCreation = '';
		$this->dateModif = '';
		
	}
				
	public function initDonneeUser ($valeurs=array())
	{
		if (!empty($valeurs))
			$this->hydrate($valeurs);
	}
	
	public function hydrate ($donnees)
	{
		foreach ($donnees as $attribut => $valeur)
		{
		
			$methode='set'.ucfirst($attribut);
			if (is_callable(array($this,$methode)))
			{
				$this->$methode($valeur);
			}
		}
	
	}	
		
	/******************* Setter ***********************/
	public function setId($id){
		$this->id=$id;
		
	}
	public function setLogin($login){
	
		if (is_string($login)|| !empty($login))
			$this->login=$login;
	}
	
	public function setPasse($passe){
	
		if (is_string($passe)|| !empty($passe))
			$this->passe=$passe;
	}
	
	public function setEmail($email){
		if (is_string($email)|| !empty($email))
			$this->email=$email;
	}
	
	public function setScore($score){
		if (is_string($score)|| !empty($score))
			$this->score=$score;
	}
	public function setTypeUser($typeUser){
		if (is_string($typeUser)|| !empty($typeUser))
			$this->typeUser=$typeUser;
	}
	public function setdDateCreation($dateCreation){
	
		if (is_string($nom)|| !empty($dateCreation))
			$this->dateCreation=$dateCreation;
	}
	public function setDateModif($dateModif){
	
		if (is_string($dateModif)|| !empty($dateModif))
			$this->dateModif=$dateModif;
	}
	
/************* Getter ********************/
	public function getId(){
		return $this->id;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function getPasse(){
		return $this->passe;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getScore(){
		return $this->score;
	}
	
	public function getTypeUser(){
		return $this->typeUser;
	}
	
	public function getDateCreation(){
		return $this->dateCreation;
	}
	
	public function getDateModif(){
		return $this->dateModif ;
	}
	
	/*
public function __sleep()
    {
        return array("id","login","passe","email","score","typeUser","dateCreation","dateModif");
    }
   
    public function __wakeup()
    {
         echo '';
    }
	
*/
	
		
/*************** Méthodes **********************/
//spprimer
	public function delete($login)
    {            
        $sql="DELETE FROM admin FROM admin WHERE loginA=?";
        $bloc = $this->executerRequete($sql, array($login));
        return $bloc;
    }
   //add 

   // Retourne un objet User
    public function getUser ($login, $passe){
	   	$sql ="	SELECT user_id as id, user_login as login, user_passe as passe,user_passe as passe, user_email as email, user_score as score, user_type as type, user_dateCreat as dateCreat, user_dateModif as dateModif
				FROM  user 
				WHERE user_login = ? AND user_passe =? ";
			
			$user = $this->executerRequete($sql, array($login,$passe));
		if ($user->rowCount() == 1)
			return  $user->fetch();  // Accès à la première ligne de résultat
		else
			return "";

    }


    /***Permet de récuper***/ 
	    public function getListeUsers (){

	   	$sql ="	SELECT user_id as id, user_login as login, user_passe as passe,user_passe as passe, user_score as score, user_type as typeUser, user_dateCreat as dateCreation, user_dateModif as dateModif
				FROM  user Limit 1' 
			";
			
			$user = $this->executerRequete($sql);
			return $user; 
    }
    
  
    
   	   /***Permet de récuper***/ 
	    public function ajoutUser ($pseudo,$email,$passe){
	  ///  $nb=10;
	  		$passe=MD5($passe);
	   		$sql ="INSERT INTO user SET user_login=?, user_email= ?,user_passe = ?,user_dateCreat=NOW(),user_dateModif=NOW()";
			
	   		//echo "INSERT INTO user SET user_login='".$pseudo."', user_email='".$email."',user_passe ='".$passe."',user_dateCreat=NOW(),user_dateModif=NOW()";

			$user = $this->executerRequete($sql, array($pseudo,$email,$passe));
			return $user; 
		
		}
		
		
		public function userExiste ($pseudo)
		{
			$sql="SELECT user_login FROM user WHERE user_login=?";
			$user = $this->executerRequete($sql, array($pseudo));
			
			if ($user->rowCount() == 1)
				return  true;  // Accès à la première ligne de résultat
			else
				return false;
			
				
			
		}
} // fin de la classe Usre
		
		
		
		
		
		
		
		
/*
	echo 'Test <br>';
		$user = new User();
		
		echo $user->getId();
		
		$data=$user-> getUser("admin", md5("admin"));
		
		echo $data['id'].'-'.$data['login'];
		
		echo '<br>Init<br>';
		
		$user->initDonneeUser($data);
		
		echo "getId Apres Init " .$user->getId()." - " .$user->getLogin()." - " .$user->getPasse()." - " .$user->getEmail()." - " .$user->getScore()." - " .$user->getTypeUser()." - " .$user->getDateCreation()." - " .$user->getDateModif();
		
		try {
			$_SESSION['user']= $user;
		}catch(Exception $e){
			echo 'Erreur : '.$e->getMessage().'<br />';
				echo 'N° : '.$e->getCode();
				exit();
		}
		
		if(isset($_SESSION['user']))
		{
			
			$u=$_SESSION['user'];
			echo 'test';		
				
				echo "$$$$$$$ getId Apres Init " .$user->getId()." - " .$user->getLogin()." - " .$user->getPasse()." - " .$user->getEmail()." - " .$user->getScore()." - " .$user->getTypeUser()." - " .$user->getDateCreation()." - " .$user->getDateModif();
			
			
		}
		


*/






		