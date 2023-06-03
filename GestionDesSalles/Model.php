<?php 

function getCn(){	
	static $cn;
	if(!$cn) $cn= new PDO("mysql:host=localhost;dbname=collePHP", "root", "");
	return $cn;
}
function deleteSalle($id){
	getCn()->exec("delete from salles where id= $id");
}

function getAllSalles(){
	return getCn()->query("select* from Salles")->fetchAll();
}
function getSalleById($id){
	$rq= getCn()->prepare("select intituler from salles where id = ?");
	$rq->execute([$id]); 
	return $rq->fetchColumn();

}
function addSallesDB($salle){
	$exist=getCn()->query("select intituler from salles where intituler = '$salle'")->fetchColumn();
	if(!empty($exist))
		throw new Exception("salles déja existe "); 
	getCn()->exec("insert into salles (intituler) values ('$salle')");

}

function isPossible($reservation) {
	
	$Rq= getCn()->prepare("select count(*) from reservations where idSalle = ? and date = ? and creneau = ? and etat = 'Active'");
	$Rq->execute($reservation);
	return !($Rq->fetchColumn());	
}

function getReservationById($id){
	$emailDB = getCn()->query("SELECT email FROM reservations WHERE id = '$id'")->fetchColumn();
	return $emailDB;

}

function deleteReservation($id){
	$rq = getCn()->prepare("delete from reservations where id = ?"); 
	$rq->execute([$id]);
}
function ajouterUserToken(array $t) {
	
	$Rq= getCn()->prepare("insert into userTokens (user,token, expire) values(?,?,?)");
	$Rq->execute($t);	
}


function getAllActiveReservations(){
	return getCn()->query("select* from Reservations where etat ='Active' and date >= '" . Date("Y-m-d H:i:s") . "'" )->fetchAll();
}
function getDetailReservation($id){
	$Rq= getCn()->prepare("select * from Reservations where id = ? ");
	$Rq->execute([$id]);
	return $Rq->fetch();
}
function AjouterReservation($R){
	/*$Reservation=[$R["email"],$R["motif"],$R["idSalle"],$R["date"],$R["creneau"],"Active"];
	$Rq= getCn()->prepare("insert into reservations (email,motif,idSalle,date,creneau,etat) values(?,?,?,?,?,?)");
	$Rq->execute($Reservation);
	return getCn()->lastInsertID() ;
	*/
	
	$Rq= getCn()->prepare("insert into reservations (email,motif,idSalle,date,creneau,etat) values(?,?,?,?,?,?)");
	$Rq->execute([$R['email'],$R['motif'],$R['idSalle'],$R['date'],$R['creneau'],$R['etat']]);	
	return getCn()->lastInsertID() ;
}
function getUserByToken($token){
	
	$Rq= getCn()->prepare("select user from userTokens where token = ? and Expire >= '" . Date("Y-m-d H:i:s")."'");
	$Rq->execute([$token]);
	return $Rq->fetchColumn();
}
function ajouterToken(array $t) {	
	$Rq= getCn()->prepare("insert into tokens (idReservation,token, expire) values(?,?,?)");
	$Rq->execute($t);	
}
function getReservationByToken($token){
	$Rq= getCn()->prepare("select idReservation from Tokens where token = ? and Expire >= '" . Date("Y-m-d H:i:s")."'");
	$Rq->execute([$token]);
	return $Rq->fetchColumn();
}
function activateReservation($id){
	$Rq= getCn()->prepare("update Reservations set etat = 'Active' where id = ? ");
	$Rq->execute([$id]);
}
