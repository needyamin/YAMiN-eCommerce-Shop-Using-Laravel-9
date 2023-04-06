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
            'api_token' => 'xxx',
            'sid' => 'xxx',
            'csms_id' => 'xxx'
          ]);
              $status = $sender->send();
              dd($status);  
    
       }
}
