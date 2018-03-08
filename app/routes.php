<?php

$app->get('/', App\Controllers\HomeController::class .':accueil');


$app->group('/orangeMoney', function () {

	 // OMRequest Table
	 $this->get('/test', App\Controllers\OrangeMoneyController::class .':test');
	 // Scheduler-OM Table

	 
	 $this->post('/insertschedulerom', App\Controllers\OrangeMoneyController::class .':insertSchedulerOM');

  // Transaction
   $this->post('/newtransationom', App\Controllers\OrangeMoneyController::class .':newTransationOM');
	 $this->post('/annulertransationom', App\Controllers\OrangeMoneyController::class .':annulerTransationOM');
	 $this->get('/nextransationomr/{pn}/{ok}', App\Controllers\OrangeMoneyController::class .':nextTransationOMR');
	 $this->post('/setphonestateom' ,App\Controllers\OrangeMoneyController::class .':setPhoneStateom');
	 $this->post('/confirmertransationom',App\Controllers\OrangeMoneyController::class .':confirmerTransationOM');

});
