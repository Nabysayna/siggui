<?php

$app->get('/', App\Controllers\HomeController::class .':accueil');


$app->group('/orangeMoney', function () {

	 // OMRequest Table

	 $this->get('/test', App\Controllers\OrangeMoneyController::class .':test');
	 $this->post('/setomrequest', App\Controllers\OrangeMoneyController::class .':setOMRequest');
	 $this->post('/getomrequest', App\Controllers\OrangeMoneyController::class .':getOMRequest');
	 $this->post('/updateomrequest', App\Controllers\OrangeMoneyController::class .':updateOMRequest');
	 $this->post('/deleteomrequest', App\Controllers\OrangeMoneyController::class .':deleteOMRequest');

	 // Scheduler-OM Table

	 $this->post('/setnextom', App\Controllers\OrangeMoneyController::class .':setNextOM');
	 $this->post('/setsoldeom', App\Controllers\OrangeMoneyController::class .':setSoldeOM');
	 $this->post('/setetatom', App\Controllers\OrangeMoneyController::class .':setEtatOM');
	 $this->post('/getnextom', App\Controllers\OrangeMoneyController::class .':getNextOM');
	 $this->post('/getsoldeom', App\Controllers\OrangeMoneyController::class .':getSoldeOM');
	 $this->post('/getetatom', App\Controllers\OrangeMoneyController::class .':getEtatOM');
	 $this->post('/insertschedulerom', App\Controllers\OrangeMoneyController::class .':insertSchedulerOM');

  // Transaction
   $this->post('/newtransationom', App\Controllers\OrangeMoneyController::class .':newTransationOM');
	 $this->post('/annulertransationom', App\Controllers\OrangeMoneyController::class .':annulerTransationOM');
	 $this->get('/nextransationomr/{pn}/{ok}', App\Controllers\OrangeMoneyController::class .':nextTransationOMR');

});
