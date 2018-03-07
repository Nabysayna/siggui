<?php

namespace App\Models;



class OrangeMoneyModel {
	private $_db = null;

	public function __construct($db){
  		$this->_db = $db;
	}


    public function getAllRequest(){
          $resp = array();
          return array("response" => "db response");
    }

		public function insertOMRequest($numerordre,$requete, $iduser, $etat){
					$lastInsert = 1;

					return $lastInsert;
		}

    public function getOMRequestById($id){
			   $phone = array("id" => 1,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 1));

			   return $phone;
    }

		public function getOMRequest($idReq,$numerordre){
				$request = array("id" => 1,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1');

				return $request;
		}

		public function setOMRequestById($id,$request){
				$request = array("id" => 1,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1');

				return $request;
		}

    public function setEtatOMRequest ($idReq,$numerordre,$etat){
			   return ;
		}

		public function getNextRequest($phone,$requestId){
 				 $request = array("id" => 1,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1');

				 return $request;
		}

    public function getOMRequestByIdUser($idUser){
        $resp = array();
        return $resp;
    }

    public function getOMRequestByEtat($etat){
        $resp = array();
        return $resp;
    }


    public function getOMRequestByNumerordre($num){
        $resp = array();
        return $resp;
    }

		public function getEtatOMRequest(){
      	$resp = '-1';
        return $resp;
    }

		public function estHabilite($correspSession, $montant, $concedant, $libelleoperation){

        return 1;
    }

		public function authorizationUser(){
				$resp = array();
        return $resp;
    }

    public function getPhoneByLastRequest() {
        $phone = array("id" => 1,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => 1);

			  return $phone;
		}

		public function insertToken($token) {

				return $token;
		}

		public function insertNewTransaction($numerordre , $nextPhoneId, $newNextPhone){

		}

		public function omRequestEtat($phoneNumberOrder,  $resquestId){
          return '1';
		}
    //
    //
    // public function getCom($id){
    //     $q = $this->_db->prepare('SELECT concat(u.prenom, " ", u.nom) AS agentcom FROM users u WHERE u.id_user=:id');
    //     $q->execute(array(':id' => $id));
    //     $customize = $q->fetch();
    //     return $customize;
    // }
    //
    //
    // public function ajoutsuivipositionnement($point, $montant, $positionne_by, $recouvre_by){
    //     $q = $this->_db->prepare('INSERT INTO suivipositionnements SET dateeffectif=NOW(), point=:point, montant=:montant, positionne_by=:positionne_by, recouvre_by=:recouvre_by, etatpositionnement=1');
    //     $q->execute(array(':point' => $point, ':montant' => $montant, ':positionne_by' => $positionne_by, ':recouvre_by' => $recouvre_by));
    //     return $this->_db->lastInsertId();
    // }
    //
    //
    //
    //
    // public function valideversementdepot($id, $montantversement, $idversement_by){
    //     $q = $this->_db->prepare('UPDATE suivipositionnements SET etatversement=:etatversement, validverse_by=:validverse_by WHERE id=:id');
    //     $q->execute(array(':id' => intval($id), ':etatversement' => $montantversement, ':validverse_by' => $idversement_by));
    //     return $this->_db->lastInsertId();
    // }
}
