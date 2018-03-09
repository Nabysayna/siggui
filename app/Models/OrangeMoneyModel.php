<?php

namespace App\Models;



class OrangeMoneyModel {
	private $_db = null;

	public function __construct($db){
  		$this->_db = $db;
	}


    public function getAllRequest(){
					$q  =  $this->_db->query("SELECT get_next_om() as nextone");
					$resp = $q->fetch();
          return $resp['nextone'];
    }

		public function insertOMRequest($numerordre,$requete, $iduser, $date){

					$q  =  $this->_db->prepare("SELECT om_record_request(?,?,?,?) as nextone");

					$q->execute(array($numerordre,$requete,$iduser,$date));

					$resp = $q->fetch();

					return $resp['nextone'];
		}

    public function getOMPhoneById($id){
			   $phone = array("id" => 1,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 1));

			   return $phone;
    }

		public function getOMRequest($idReq,$numerordre){
				$request = array("id" => 1,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1');

				return $request;
		}

		public function getPhoneOne (){
			$phone = array("id" => 1,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 2));

			return $phone;
		}

    public function setEtatOMRequest ($idReq,$numerordre,$etat){
			   return 1;
		}

		public function getNextRequest($phone,$requestId){
 				 $request = array("id" => 1,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1');

				 return $request;
		}

		public function setPhoneStateToOff($numerordre,$phoneState, $request){
				return 1;
		}

    public function getPhoneWhoRun(){
				$phones = array(
						array("id" => 1,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 2)),
						array("id" => 2,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 3)),
						array("id" => 3,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 4)),
						array("id" => 4,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 5)),
						array("id" => 5,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 6)),
						array("id" => 6,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 7)),
						array("id" => 7,"Numerordre" => 2,"nextid" => 2,"lastid" => 2,  "NextOM" => array("id" => 1)),
				);

				return $phones;
		}

		public function getPhoneOffRequest($numerordre){
				$request = array(
						array("id" => 1,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1'),
						array("id" => 2,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1'),
						array("id" => 3,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1'),
						array("id" => 4,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1'),
						array("id" => 6,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1'),
						array("id" => 7,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1'),
						array("id" => 8,"Numerordre" => 2,"request" => "1*1","	iduser" => 1,  "daterequest" => "2018-03-05 03:25:00","Etat" => '1'),
					);

				return $request;
		}

		public function setOMRequestToOtherPhone($numerordre,$phone,$req){
			 return 1;
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

		public function insertNewTransaction($numerordre , $nextPhoneId, $newNextPhone){

		}

		public function omRequestEtat($phoneNumberOrder,  $resquestId){
          return '1';
		}

		public function autorizationTran($token,$montant){
				$q  =  $this->_db->prepare("SELECT check_autorisation(?,?) as nextone");

				$q->execute(array($token,$montant));

				$resp = $q->fetch();

				return $resp['nextone'];
		}

}
