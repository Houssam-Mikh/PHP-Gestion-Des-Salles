<?php
require_once("Model.php");
require_once("Admins.php");

function listeReservations(){		
	afficher("vListeReservations.php", ["Reservations"=>getAllActiveReservations()]);	
}
function authentifier(){
	
	if (isset($_REQUEST["token"])) {
		$token = $_REQUEST["token"];	
		$user =getUserByToken($token);	 
		if(!$user) throw new Exception ("Token non valide!!..");		
		$_SESSION["user"]=$user;
		header("location:index.php");
	}
	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$email = $_POST["email"];			
		if(empty($email))    $erreur["email"] ="L'e-mail ne peut être vide !..."   ;
		elseif(substr(strtolower($email),-12,12)!="@usmba.ac.ma")    $erreur["email"] ="Utilisez votre mail académique!!..."   ;
		if (!isset($erreur)) {									
			generateUserToken($email);
			header ("location: index.php");	
		}
	}

		$data =["email" => $email  ?? "" ,
				"erreur"=> $erreur ?? ""
			   ];
		afficher ("vFormLogin.php",$data);
}


 function isValid($date, $format = 'Y-m-d'){
    $dt = DateTime::createFromFormat($format, $date);
    return $dt && $dt->format($format) === $date;
}
function gestionSalles(){
	$data=["salles"=>getAllSalles()];
	afficher("vGestionSalles.php",$data);

}
function suprimerSalles(){
	$id = $_GET['id'] ?? ""; 
	if(empty($id)) throw new Exception("id n'est pas valide "); 
	deleteSalle($id); 
	header("location:index.php?action=gestionSalles");
}
function addSalles(){
	if($_SERVER['REQUEST_METHOD']=="POST"){
		$salle=$_POST['salle']; 
		if(empty($salle)) $erreur="saisir salles"; 
		//test si salle déja existe 
		if(!isset($erreur)){
			addSallesDB($salle);
			header("location:index.php?action=gestionSalles"); 
		}
	}
	$data =["salles"=>$salle ?? "",
		"erreur"      => $erreur ?? "" 
   	];
afficher("vIndex.php", $data);

}

function index(){
	
	$Reservation = ["idSalle"=>"","date"=>"","creneau"=>""];
	if ($_SERVER["REQUEST_METHOD"]=="POST") {	
		$Reservation= $_POST;
	if(empty($_POST["date"]) or !isValid($_POST["date"]) or $_POST["date"] < Date("Y-m-d H:i:s"))  $erreur["date"] ="Date de réservation invalide !..."   ;
	elseif(empty($_POST["creneau"]))    $erreur["creneau"] ="Choisissez un creneau !..."   ;
	elseif(empty($_POST["idSalle"]))  $erreur["salle"] ="Choisissez une salle !..."   ;
							
	if (!isset($erreur)) {		
		$s = $_POST["idSalle"];
		$d = $_POST["date"];
		$c = $_POST["creneau"];			
		if(!(isPossible([$s,$d,$c])))  afficher("vSalleNonDisponible.php",["salle"=>$s,"date"=>$d,"creneau"=>$c]);
		else    {  
			
			$s= getSalleById($_POST["idSalle"]);	
	
		//cette salle est disponible dans ce creneaux 
		$Reservation["email"] = $_SESSION["user"];
		$Reservation["motif"] = "pas de motif";
		$Reservation["idSalle"] =$_POST["idSalle"];
		$Reservation["date"] = $_POST["date"];
		$Reservation["creneau"] = $_POST["creneau"];
		$_SESSION['reservation']=$Reservation;
      
		afficher("vSalleDisponible.php",["salle"=>$s,"date"=>$d,"creneau"=>$c]);
		
		}
	exit;
	}
}
$data =["reservation" => $Reservation,
		"erreur"      => $erreur ?? "" ,
		"salles"      => getAllSalles()
   	];
afficher("vIndex.php", $data);
}

function ajouterSalle(){
	afficher("vAddSalles.php"); 
}


function GenerateUserToken ($email) {
	
	date_default_timezone_set('Africa/Casablanca');
	$timeExpiration =  date("Y-m-d H:i:s", strtotime('+4 hours')) ;
	$token = sha1 ($email. $timeExpiration . rand(0,999999999)) ; 
	
	ajouterUserToken([$email,$token,$timeExpiration]); 
	
	
	
	$lien = "index.php?action=authentifier&token=$token";
	$to= $email;
	$subject = "Lien pour vous connecter" ;
	$message =" Veuillez cliquer sur le lien suivant pour vous connecter à l'application de réservations. Notez bien que ce lien va expirer le <b> : $timeExpiration </b>. <br> <a href ='$lien'>$lien</a>.<br /> Vous pouvez aussi copier/coller ce token: <b>$token</b> dans l'interface d'authentification de l'application";  
	
	require ("Views/vEmailTest.php"); exit;		
}

function reserver(){
	$Reservation=$_SESSION['reservation'];
	if(empty($Reservation)){
		throw new Exception($_GET["reservation"]["email"]);
	}
	$Reservation['etat']="Inactive";
	$idReservation=ajouterReservation($Reservation);
	generateTokenReservation($idReservation,$Reservation['email'],"activerReservation");
	$_SESSION['reservation']=null;
	

}
function generateTokenReservation($idReservation,$username,$action){
	date_default_timezone_set('Africa/Casablanca');
	$timeExpiration =  date("Y-m-d H:i:s", strtotime('+4 hours')) ;
	$token = sha1 ($idReservation . $username . $timeExpiration . rand(0,999999999)) ;
	ajouterToken([$idReservation,$token,$timeExpiration]);
	$lien = "index.php?action=$action&token=$token";
	$to= $username;
	$subject = "Lien pour activer ou supprimer votre réservation" ;
	$message =" Veuillez cliquer sur le lien suivant pour gérer votre réservation. Notez bien que ce lien va expirer le <b> : $timeExpiration </b>. <br> <a href ='$lien'>$lien</a>";  
	require ("Views/vEmailTest.php"); exit;
}

function activerReservation() {	
	$token=$_GET['token'] ?? "";
	$idReservation =getReservationByToken($token);	
	if(!$idReservation) throw new Exception ("Aucune réservation valide à activer!!..");		
	activateReservation ($idReservation); 
	header("location:index.php?action=listeReservations");
}
function isAdmin($user){
	$isAdmin=false; 
	foreach($GLOBALS['Admins'] as $A){
		if($A == $user){
			$isAdmin = true; 
		}
	}
	return $isAdmin;
}
//fonction de supression 
function demandeSuppression(){
	//verifier si l'utilisateur est admine ou non !! 
	//l'adresse email d'un admin est toujour exemple.admin@usmba.ac.ma
	$user=$_SESSION['user'];
	$idReservation = $_GET['id'] ?? ""; 
	if(empty($idReservation)) throw new Exception("reservation a supprimer est introuvable");
	$emailDB=getReservationById($idReservation);
	// si l'utilisateur admin il peut tous simplement suprimmer la reservation 
	if(isAdmin($user)){
		generateTokenReservation($idReservation,$user,"supprimerReservation");
	}
	else{
		//must check if the  reservation belong to user
		if($emailDB != $user){
			throw new Exception("action n'est pas autorise vous n'etes pas admin");
		}
		else{
			generateTokenReservation($idReservation,$user,"supprimerReservation");
		}
	
	}
}
function supprimerReservation(){
	$token=$_GET['token'] ?? "";
	if(empty($token)) throw new Exception("token de supression n'est pas valide "); 
	$idReservation =getReservationByToken($token);
	if(empty($idReservation)) throw new Exception("token n'est pas liés a aucun reservation"); 
	deleteReservation ($idReservation);
	header("location:index.php?action=listeReservations");
}
	
function deconnexion() {
	session_destroy();
	header("location: index.php");
}