<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use \App\Controller;

use \App\Models\OrangeMoneyModel;


class OrangeMoneyController extends Controller {

  	public function test(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");

      return $response->withJson(array("message", "WELCOME"));
    }

    // -------------------   OMRequest Table -------------------------

    public function setOMRequest(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
      $data     = $request->getParsedBody();
      $params   = json_decode($data['params']);

      $omModel  =  new OrangeMoneyModel($this->db);
      $resp     =  $omModel->getAllRequest();

      return $response->withJson(array("params"=> $resp));
    }

    public function getOMRequest(Request $request, Response $response, $params){
      header("Access-Control-Allow-Origin: *");
      $data     = $request->getParsedBody();
      $params   = json_decode($data['params']);

      $omModel  =  new OrangeMoneyModel($this->db);
      $resp     =  $omModel->getAllRequest();

      return $response->withJson(array("params"=> $resp));
    }

    public function updateOMRequest(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");
        $data     = $request->getParsedBody();
        $params   = json_decode($data['params']);

        $omModel  =  new OrangeMoneyModel($this->db);
        $resp     =  $omModel->getAllRequest();

        return $response->withJson(array("params"=> $resp));
    }

    public function deleteOMRequest(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");
        $data     = $request->getParsedBody();
        $params   = json_decode($data['params']);

        $omModel  =  new OrangeMoneyModel($this->db);
        $resp     =  $omModel->getAllRequest();

        return $response->withJson(array("params"=> $resp));
    }

    public function testEtatOMRequest(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
      $data     = $request->getParsedBody();
      $params   = json_decode($data['requestParam']);
      $rep = '-1';

      $request  = $params->requestParam ;
      $token    = $params->tokenParam ;

      $omModel  =  new OrangeMoneyModel($this->db);

      $phoneNumberOrder = trim(explode("*", $request)[0]) ;
      $resquestId       = trim(explode("*", $request)[1]) ;

      $statut     = $this->fullUseChecker($token, $request);

      if( strcmp( trim($statut), "in" ) ==0 ){
          $returnedState = $omModel->omRequestEtat($phoneNumberOrder,  $resquestId);
          $resp          =    $returnedState  ;
      }
      else{
          $resp =    '-1';
      }

      return $response->withJson(array("params"=> $resp));

    }

    // -------------------   Scheduler-OM Table -------------------------


    public function setNextOM(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");
        $data     = $request->getParsedBody();
        $params   = json_decode($data['params']);

        $omModel  =  new OrangeMoneyModel($this->db);
        $resp     =  $omModel->getAllRequest();

        return $response->withJson(array("params"=> $resp));
    }

    public function setSoldeOM(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
      $data     = $request->getParsedBody();
      $params   = json_decode($data['params']);

      $omModel  =  new OrangeMoneyModel($this->db);
      $resp     =  $omModel->getAllRequest();

      return $response->withJson(array("params"=> $resp));
    }

    public function setEtatOM(Request $request, Response $response, $params){
      header("Access-Control-Allow-Origin: *");
      $data     = $request->getParsedBody();
      $params   = json_decode($data['params']);

      $omModel  =  new OrangeMoneyModel($this->db);
      $resp     =  $omModel->getAllRequest();

      return $response->withJson(array("params"=> $resp));
    }

    public function insertSchedulerOM(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");
        $data     = $request->getParsedBody();
        $params   = json_decode($data['params']);

        $omModel  =  new OrangeMoneyModel($this->db);
        $resp     =  $omModel->getAllRequest();

        return $response->withJson(array("params"=> $resp));
    }


    public function getNextOM(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");
        $data     = $request->getParsedBody();
        $params   = json_decode($data['params']);



        $omModel  =  new OrangeMoneyModel($this->db);
        $resp     =  $omModel->getAllRequest();

        return $response->withJson(array("params"=> $resp));
    }

    public function getSoldeOM(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
      $data     = $request->getParsedBody();
      $params   = json_decode($data['params']);

      $omModel  =  new OrangeMoneyModel($this->db);
      $resp     =  $omModel->getAllRequest();

      return $response->withJson(array("params"=> $resp));
    }

    public function getEtatOM(Request $request, Response $response, $params){
      header("Access-Control-Allow-Origin: *");
      $data     = $request->getParsedBody();
      $params   = json_decode($data['params']);

      $omModel  =  new OrangeMoneyModel($this->db);
      $resp     =  $omModel->getAllRequest();

      return $response->withJson(array("params"=> $resp));
    }

    // -------------------   Transations -------------------------

    // new transation

    public function newTransationOM(Request $request, Response $response, $params){
        header("Access-Control-Allow-Origin: *");
        $data   = $request->getParsedBody();
        $params = json_decode($data['requestParam']);

        $request = $params->requestParam ;
        $token   = $params->tokenParam ;
        $code    = 0;

        $omModel =  new OrangeMoneyModel($this->db);

        $statut  = $this->fullUseChecker($token, null);

        if ( strcmp( trim($statut),"out" )==0   ){
              $code   = -12;
        }else{
                  $statut  = $this->fullUseChecker($token, $request);
                  if (strcmp( trim($statut),"in" )==0 ){
                        $lastPhone = $omModel->getPhoneByLastRequest();
                        //

                        $nextPhoneId  = $lastPhone["nextid"];
                         //
                        $phone        = $omModel->getOMRequestById($nextPhoneId);
                        // phone infos
                        $numerordre   = $phone["Numerordre"];
                        //number order to phone
                        $newNextPhone = $phone["NextOM"];
                        //id users
                        $iduser = 1;
                        // insertion new transation
                        $omModel->insertNewTransaction($numerordre , $nextPhoneId, $newNextPhone);

                        $idReq  = $omModel->insertOMRequest($numerordre,$requete, $iduser, $etat);

                        $omModel->insertToken($token);
                        //return numbre order to phone and request id
                        $code   = $numerordre . "*". $idReq ;

                  }
        }


        return $response->withJson(array("requestParam"=> array("requete"=> $request,"token"=> $token) , "Code"=> $code));
    }

    // authorization request a trabsation for this user

    public function fullUseChecker($token , $request){
        $operation = '';
        $montant   = '';
        $statut    = '';

        if ( strcmp( explode( "/", $request)[0], "1")==0 ){
           $operation = "depot" ;
           $montant = explode( "/", $request)[1] ;
        }

        if ( strcmp( explode( "/", $request )[0], "2")==0 ){
           $operation = "retrait" ;
           $montant = explode( "/", trim($request,"R") )[2] ;
        }

        if ( strcmp( explode( "/", $request )[0], "3")==0 ){
           $operation = "transfert avec code" ;
           $montant = explode( "/", trim($request,"R") )[7];
        }

        if ( strcmp( explode( "/", $request )[0], "5")==0 ){
           $operation = "credit" ;
           $montant = explode( "/", trim($request,"R") )[2];
        }


        $omModel =  new OrangeMoneyModel($this->db);
        $result  =  $omModel->authorizationUser($token);

        if ( strpos($operation, "retrait")!==false || strpos($operation, "code")!==false )
              $statut = "in" ;
        else if ( strcmp (gettype($result), 'boolean') !=0 ){
            if ($omModel->estHabilite($result, $montant, "orangemoney", $operation )==1)
                $statut = "in" ;
            else
                $statut = "out" ;
        }
        else
            $statut = "out" ;

        return $statut;
    }

    public function annulertransationom(Request $request, Response $response, $params){
      header("Access-Control-Allow-Origin: *");
      $data   = $request->getParsedBody();
      $params = json_decode($data['requestParam']);

      $request = $params->requestParam ;
      $token   = $params->tokenParam ;

      return $response->withJson(array("requestParam"=> array("requete"=> $request,"token"=> $token)));
    }




}
