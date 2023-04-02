<?php

namespace App\Http\Controllers;
use Xenon\LaravelBDSms\Provider\Ssl;
use Xenon\LaravelBDSms\Sender;

class smswirless extends Controller
{

      public function needyamin(){

              $sender = Sender::getInstance();
              $sender->setProvider(Ssl::class); 
              $sender->setMobile('01878578504');
              $sender->setMessage('helloooooooo boss!');
              $sender->setConfig(
          [
            'api_token' => 'le17cmrx-uq2fvtgr-feynedje-iftthprk-aq7eqznl',
            'sid' => 'BISHUDDHOTA',
            'csms_id' => 'm01730472434i1665025420147'
          ]);
              $status = $sender->send();
              dd($status);  
    
       }
}
