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


    public function testEtatOMRequest(Request $request, Response $response, $args){
          header("Access-Control-Allow-Origin: *");

          $data     = $request->getParsedBody();
          $params   = json_decode($data['requestParam']);
          $rep       = '-1';

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

    // new transation

    public function newTransationOM(Request $request, Response $response, $params){
          header("Access-Control-Allow-Origin: *");

          $data   = $request->getParsedBody();
          $params = json_decode($data['requestParam']);

          $request = $params->requestParam ;
          $token   = $params->tokenParam ;
          $code    = 0;// code to return


          $omModel =  new OrangeMoneyModel($this->db);

          //request autorization for the user transation
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

                          //return numbre order to phone and request id
                  $code   = $numerordre . "*". $idReq ;

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


        // $phonefolder = explode("*", $request)[0];
        // $filename = explode("*", $request)[1];
        $phoneNumberOrder = explode("*", $request)[0];
        $requuestId       = explode("*", $request)[1];
        // Instance OrangeMoneyModel
        $omModel =  new OrangeMoneyModel($this->db);

        $safeIdR = $omModel->getNextRequest($phoneNumberOrder,$requuestId);
        $safeIdR =   $safeIdR['id'];
        // $etat    =  $omMode->omRequestEtat(phone,$requestId);

        if($safeIdR){
              $safezone = $omModel->getNextRequest($phone,$safeIdR);
              if($safezone){
                  $omModel-> setOMRequestById($requestId,"0");
                   $etat = "c";
              }

        }
        else{
            $etat = "k";
        }

        return $response->withJson(array("requestParam"=> array("requete"=> $request,"token"=> $token, "etat" => $etat)));
    }


    public function nextTransationOMR(Request $request, Response $response, $args){
          header("Access-Control-Allow-Origin: *");


          $phoneNumberOrder = intval($args["pn"]);
          // phone order number
          $etat             = $args["ok"] ;
          // last transation statut
          $code    = 0;// code to return
          $omModel =  new OrangeMoneyModel($this->db);

          if(isset($phoneNumberOrder)){
                // set statut for last request  (WHERE id = $idReq AND Numerodre = $numerordre)
                $omModel->setEtatOMRequest($idReq,$numerordre,$etat);

                if(strcmp($etat,"1")==0 ){
                      $request =   $omModel->getOMRequest($idReq,$numerordre);
                      // $token   =   $omModel->getToken($idReq,$numerordre);
                      /*
                       ride up  request code
                       */
                }

                // next request than phone must run (WHERE id > $idReq )
                $nextRequest = $omModel->getNextRequest($idReq,$numerordre);

                if(!isset($nextRequest)){
                   $code = "ok";
                }
                else{
                  $code =  $nextRequest;
                }
           }else{
                 $code =  "0";
           }

          return $response->withJson(array("Code"=> $code));
    }

    public function setPhoneStateOM (Request $request, Response $response, $args){
          header("Access-Control-Allow-Origin: *");
          $data   = $request->getParsedBody();
          $params = json_decode($data['requestParam']);

          $code = "0"; // the return

          $numerordre = $params->numerordre; // number order from phone in phone's list
          $phoneState = $params->etat;  // stat from phone off
          $request    = $params->request; // request than phone runned before off

          $omModel =  new OrangeMoneyModel($this->db);
          // set state from the  phone where number order is $numerordre
          $omModel->setPhoneStateToOff($numerordre,$phoneState, $request);
          //test if last transactoin is succesful
          $r = $omModef->getOMRequestByEtat($numerordre,"1");

          if(!empty($r)){
               $code = "ok";
          }else{
               $code = array("requete"=> $r);
          }

          // get the requests from the phone off
          $phoneOffRequest = $omModel->getPhoneOffRequest($numerordre);
          // get phone to be running
          $runningPhones   = $omModel->getPhoneWhoRun();
          // number of running phones
          $phoneSize   =  sizeOf($runningPhones);
          // number of requests from the phone off
          $requestSize =  sizeOf($phoneOffRequest);

          for($i = 0, $phoneIndex = 0; $i < $requestSize ; $i++){
               for($j = $i; $j < ($i + ($requestSize/$phoneSize)) ; $j++){
                      $phone =   $phoneIndex[$j]; // target phone
                      $req   =    $phoneOffRequest[$j]; // target request
                      /*
                       *$numerordre => number order from phone off
                       * $phone->Numerordre  => number order from  target phone
                       * $req->id  => request id
                      */
                      $phoneOffRequest = $omModel->setOMRequestToOtherPhone($numerordre,$phone->Numerordre,$req->id);
                      $code = "ok";

               }
               $phoneIndex++;
               $i = $j;
           }

          return $response->withJson(array("Code"=> $code));

    }

    public function confirmerTransationOM(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");
        $data   = $request->getParsedBody();
        $params = json_decode($data['requestParam']);

        $code = "0"; // the return

        $numerordre = $params->numerordre; // number order from phone in phone's list
        $requestState = $params->etat;  // stat from phone off
        $request    = $params->request; // request than phone runned before off

        $omModel =  new OrangeMoneyModel($this->db);

        if(strcmp(trim($requestState), "success") == 0){
            $omModel->setEtatOMRequest($idReq,$numerordre,"2");
              $code = "ok";
        }else{
            $phoneOne= $omModel->getPhoneOne();
            /*
             *$numerordre => number order from phone off
             * $phone->Numerordre  => number order from  target phone
             * $req->id  => request id
            */
            $omModel->setOMRequestToOtherPhone($numerordre,$phoneOne->Numerordre,$request->id);
            $code = "ok";
        }

        return $response->withJson(array("Code"=> $code));
    }

}
