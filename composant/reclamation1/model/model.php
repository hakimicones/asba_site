<?php 

class modelReclamation {
	public $db  ; 
	public $lg  ;  
	public function __construct($db,$lg)
	{

	 $this->db  = $db;
	 $this->lg	= $lg;
	 $this->num   = (isset($_GET['num']))? (int) $_GET['num']:0;
	}
	
	public function getinscription($data) {
		$msg=''; 
		$msgtype='';
	    
        $cle = md5(uniqid(rand(1000, 100000), true)) ;
        $this->db ->resetInsert();
        $this->db ->setTableForInsert('hd_users');
        $this->db ->addInserting('nick_name', ':name');
        $this->db ->addInserting('email', ':email');
        $this->db ->addInserting('password', ':password');
        $this->db ->addInserting('RIB', ':compte');
        $this->db ->addInserting('type', ':type');
        $this->db ->addInserting('cle', ':cle');
        $this->db ->setInsertingRub("tel",$data['tel']);

        $this->db ->addParamToBind('name', $data['nom']);
        $this->db ->addParamToBind('email', $data['email']);

        $this->db ->addParamToBind('password',  password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db ->addParamToBind('compte', $data['compte']);
        $this->db ->addParamToBind('type', $data['type']);
        $this->db ->addParamToBind('cle', $cle );

        if ( $this->db->insert()) {

            $lastId =  $this->db ->getLastId();
            $msg='{votrenumeroticket} '.$lastId; 
            $msgtype='success'; 
        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage();
               $msgtype='danger'; 
        }
	$retour = new stdClass ;
	$retour->contenu 		=$msg ; 
 
	$retour->type		= $msgtype ;
    $retour->id         = $lastId;
    $retour->cle        = $cle ;

	return $retour;
 }
 public function gethistorytickets($data) {
        $this->db->resetSelect();
         $this->db->addSelected('u.*', '');
        $this->db->addSelected('d.name_'.$this->lg, 'departmentname');      
        $this->db->addSelected('c.libelle_'.$this->lg, 'categorielibelle');
        $this->db->addSelected('tt.libelle_'.$this->lg, 'typelibelle');
        $this->db->addFrom('hd_tickets as u, hd_departments as d ,hd_categorie as c ,hd_type_tickets as tt');
        $this->db->addWhere('u.categorie=tt.id');
        $this->db->addWhere('u.department_id= d.id');
        $this->db->addWhere('tt.categorie_id=c.id');
    
         $this->db->addWhere('u.id = :id');
        $this->db->addParamToBind('id', $data);

        if ( $this->db->select()) {
            $result = $this->db->getAllRows();
  

        
        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage();
            $msgtype='danger';
        }
        $retour = new stdClass ;
  $retour->result  =$result; 
    $retour->contenu        =$msg ; 
 
    $retour->type       = $msgtype ;    
    return $retour;
} 


public function getreclamation($data) {
 $retour             = new stdClass ;
  if ($data) {
        $this->db->resetSelect();
     //   $this->db->addSelected('COUNT(*)', 'count');
        $this->db->addSelected('nick_name', '');
        $this->db->addSelected('allowed ', '');
        $this->db->addSelected('email', '');
        $this->db->addSelected('password', '');
        $this->db->addSelected('id', '');

        $this->db->addFrom('hd_users as u');
        $this->db->addWhere('u.email = :email');
 
        $this->db->addParamToBind('email', $data['email']);
$msg="";
$id=0; 
        if ( $this->db->select()) {
            $value = $this->db->getNextRow();
  
            if ($value["allowed"]) {
               if (password_verify($data["password"],$value["password"])) {
                

                    $msgtype='success';
                    
                    session_set_cookie_params(30);

                    $id                     = $value["id"]; 
                    $_SESSION['hd_id_user']    = $id;
                    $_SESSION['hd_name']       = $value["nick_name"];
                    $_SESSION['hd_email']      = $value["email"];


                   


            } 
            else {
               $msg= 'mot de passe ou email invalide ' ;
               $msgtype='danger';
           }

         } else {

                $msg= 'Votre compte n\'est pas encore validé ' ;
               $msgtype='danger';


         }

        
        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage()."<br>".$this->db->q;
            $msgtype='danger';
        }



       
        $retour->id         = $id; 
        $retour->contenu    = $msg ; 
 
    $retour->type       = $msgtype ;    
    return $retour;
	
  }  else {
  
   $retour->id         = 0; 
        $retour->contenu    = '' ; 
 
    $retour->type       = '' ;    
    return $retour;
  
  }
}	 
 public function getreclamationenrg($data)
{
    $msg=''; 
        $msgtype='';
            

            $data = $_POST ;

            $user_id = $_SESSION['hd_id_user'];

            $this->db ->resetInsert();
            $this->db ->setTableForInsert('hd_tickets');

            $this->db ->setInsertingRub("title",$data['title']);
            $this->db ->addInserting('user_id', ':userid');
            $this->db ->addInserting('department_id', ':department_id');
            $this->db ->addInserting('categorie', ':categorie');
            $this->db ->addInserting('init_msg', ':init_msg');
            $this->db ->addInserting('date', ':date');
            $this->db ->addParamToBind('userid', $user_id );
            $this->db ->addParamToBind('department_id', $data['department']);
            $this->db ->addParamToBind('categorie', $data['choix']);
            $this->db ->addParamToBind('init_msg', $data['text']);
            $this->db ->addParamToBind('date', date("Y-m-d"));

        if ( $this->db ->insert()) {
            $lastId =  $this->db ->getLastId();
            $msg='{votrenumeroticket} '.$lastId; 
            $msgtype='success'; 

            $bcTicket =  $this->getBase($data);
        }
        else {
            $msg= 'ERREUR INSERTION TICKET: '. $this->db->getErrMessage()."   ".$user_id;
               $msgtype='danger'; 
        }
    $retour = new stdClass ;
    $retour->contenu        =$msg ; 
 
    $retour->type       = $msgtype ; 
    $retour->bc         =  $bcTicket ;   
    return $retour;
}
/*******************Recherches dans BC********************************/

public function getBase($data) {

     $this->db->resetSelect();

     $this->db->addSelected("MATCH(tags) AGAINST( '".addslashes (strtolower($data['text']))."') ", 'score');
     $this->db->addSelected("MATCH(tags) AGAINST( '".addslashes (strtolower($data['title']))."') ", 'score');


     $this->db->addSelected('t.title', '');
     $this->db->addSelected('t.date', '');
     $this->db->addSelected('t.id', '');
     $this->db->addSelected('t.init_msg', '');

     $this->db->addFrom('hd_base b');
 
     $this->db->addFrom('hd_tickets t');

    $this->db->addWhere('t.id = b. id_ticket_reply');
 
    $this->db->addWhere( "MATCH(tags) AGAINST( '".strtolower($data['text'])."') ");
    

// OR MATCH(tags) AGAINST( '".strtolower($data['title'])."')
    $this->db->addOrderBy('score');
    $this->db->addGroupBy(' id');

       if ( $this->db->select()) {

            $result = $this->db->getAllRows();
         //  print_r(  $this->db->q );
            return $result;
        }
        else {
             echo   'ERREUR INSERTION TICKET: '. $this->db->getErrMessage(). $this->db->q;

             return false;
        }
        

}

/*******************Recherches dans ticket reply********************************/
public function getTicketBase($data) {

     $this->db->resetSelect();

     $this->db->addSelected("MATCH(tags) AGAINST( '".addslashes ($data['text'])."') ", 'score');
     $this->db->addSelected("MATCH(tags) AGAINST( '".addslashes ($data['title'])."') ", 'score');


     $this->db->addSelected('t.title', '');
     $this->db->addSelected('t.date', '');
     $this->db->addSelected('t.id', '');

     $this->db->addFrom('hd_base b');
     $this->db->addFrom('hd_ticket_replies tr');
     $this->db->addFrom('hd_tickets t');

    $this->db->addWhere('tr.id = b. id_ticket_reply');
    $this->db->addWhere('t.id  = tr.ticket_id');
    $this->db->addWhere( "MATCH(tags) AGAINST( '".$data['text']."')  OR MATCH(tags) AGAINST( '".$data['title']."')");
    


    $this->db->addOrderBy('score');

       if ( $this->db->select()) {

            $result = $this->db->getAllRows();
           print_r(  $this->db->q );
            return $result;
        }
        else {
             echo   'ERREUR INSERTION TICKET: '. $this->db->getErrMessage(). $this->db->q;

             return false;
        }
        

}

/**************************************************/

public function gettype() {
    $msg="";
    $msgtype="";
        $this->db->resetSelect();
        $this->db->addSelected('id', '');
        $this->db->addSelected('libelle_'.$this->lg, 'libelle');
    
        $this->db->addFrom('hd_categorie as c');


        if ( $this->db->select()) {
            $result = $this->db->getAllRows();
      

        
        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage();
            $msgtype='danger';
        }
        $retour = new stdClass ;
        $retour->result=$result ; 
    $retour->contenu        =$msg ; 
 
    $retour->type       = $msgtype ;    
    return $retour;
}    

public function getdepartments() {
     $msg="";
    $msgtype="";
        $this->db->resetSelect();
        $this->db->addSelected('id', '');
        $this->db->addSelected('name_'.$this->lg,'name');

        $this->db->addFrom('hd_departments as d');

         $this->db->addWhere('hidden = 1');

        if ( $this->db->select()) {
            $result = $this->db->getAllRows();



        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage();
            $msgtype='danger';
        }
        $retour = new stdClass ;
       $retour->result=$result ; 
    $retour->contenu        =$msg ; 
 
    $retour->type       = $msgtype ;    
    return $retour;
}   
public function gethistory() {
     $msg="";
    $msgtype="";
        $this->db->resetSelect();
        $this->db->addSelected('*', '');
     
        $this->db->addFrom('hd_tickets as u');
        $this->db->addWhere('resolved = 2');
         $this->db->addWhere('user_id = :id');
        $this->db->addParamToBind('id',$_SESSION['hd_id_user']);

        if ( $this->db->select()) {
            $result = $this->db->getAllRows();
    

        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage();
            $msgtype='danger';
        }
        $retour = new stdClass ;
       $retour->result=$result ; 
    $retour->contenu        =$msg ; 
 
    $retour->type       = $msgtype ;    
    return $retour;
}   
/**************************************/

public function validation() {

     $cle= ($_GET['cle']) ? $_GET['cle']: 0 ;
     $retour = new stdClass ;

    $this->db->resetUpdate();
    $this->db->setTableToUpdate('hd_users');
    $this->db->setUpdatingID('cle',  $cle )  ;

    $this->db->addUpdating('allowed', 1 );

   

     $exec = $this->db->update() ;
 
if ($exec) { 
          
        
         $res = $this->db->affected_rows();   
  // print_r($this->db->statement);

           if ($res) { 
              
                                $retour->contenu    = '{validation-ok}' ;                      
                                $retour->type       =  'success' ; 

                              } else {

                                $retour->contenu    = '{cle-introuvable}' ;
                                $retour->type       =  'danger' ; 

                              }

            
            
        }
        else {

          echo 0 ; 
                
              $retour->contenu    = 'ERREUR MODIFICATION vehicule : '.$this->db->getErrMessage().$this->db->q;  
              $retour->type       =  'danger' ; 

        }
        






 
     

    return $retour;

}
public function gettickets($data) {
	
	$msg = "" ;
	$msgtype='';
        $this->db->resetSelect();
        $this->db->addSelected('u.*', '');
        $this->db->addSelected('d.name_'.$this->lg, 'departmentname');      
        $this->db->addSelected('c.libelle_'.$this->lg, 'categorielibelle');
        $this->db->addSelected('tt.libelle_'.$this->lg, 'typelibelle');
        $this->db->addFrom('hd_tickets as u, hd_departments as d ,hd_categorie as c ,hd_type_tickets as tt');
        $this->db->addWhere('u.categorie=tt.id');
        $this->db->addWhere('u.department_id= d.id');
        $this->db->addWhere('tt.categorie_id=c.id');
        $this->db->addWhere('resolved < 2');
        $this->db->addWhere('user_id = :id');
        $this->db->addParamToBind('id', $data);


        $this->db->addOrderBy('date   , id');

        if ( $this->db->select()) {
            $result = $this->db->getAllRows();
  

        
        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage();
            $msgtype='danger';
        }
        $retour = new stdClass ;
  $retour->result  =$result; 
    $retour->contenu        =$msg ; 
 
    $retour->type       = $msgtype ;    
    return $retour;
}    
public function getcomment($data,$id) {
        $this->db->resetSelect();
        $this->db->addSelected('CASE WHEN tr.user_id > 0 THEN uu.nick_name ELSE ua.name END ','name' );
         $this->db->addSelected('CASE WHEN tr.user_id > 0 THEN "user" ELSE "admin" END ','type' );
        $this->db->addSelected('tr.*', '');
        $this->db->addFrom('hd_ticket_replies as tr');
        $this->db->addJoin('LEFT OUTER JOIN', 'hd_users uu ', 'uu.id=tr.user_id');
        $this->db->addJoin('LEFT OUTER JOIN', 'is_users ua', 'ua.id=tr.admin_id');
        if ($id!= $_SESSION['hd_id_user']) {
         $this->db->addWhere('tr.prive = 0');
         } 
         $this->db->addWhere('tr.ticket_id = :id'); 
        $this->db->addParamToBind('id', $data);
     
         $this->db->addOrderBy('date ASC ');


        if ( $this->db->select()) {
            $result = $this->db->getAllRows();
  

        
        }
        else {
            $msg= 'ERROR: '. $this->db->getErrMessage();
            $msgtype='danger';
        }
        $retour = new stdClass ;
  $retour->result  =$result; 
    $retour->contenu        =$msg ; 
 
    $retour->type       = $msgtype ;    
    return $retour;
}   
/*****************************/ 

}
?>
