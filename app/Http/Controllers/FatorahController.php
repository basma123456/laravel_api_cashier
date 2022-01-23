<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\FatorahService;
use Illuminate\Support\Facades\Response;

class FatorahController extends Controller
{


    private $fatorahService;

    public function __construct(FatorahService $fatorahService){

        $this->fatorahService = $fatorahService;
    }


    public function payOrder(Request $request){
        $user = User::find(Auth::id())->name;
        if(isset($user)){
            $data = [
                "CustomerName" => $user,
                "NotificationOption" => 'Lnk', //'SMS', 'EML', or 'ALL'
                "InvoiceValue" => $request->payment_value,
                "CustomerEmail" => 'basma.gamaleldin100@gmail.com',
                "CallBackUrl" => 'http://127.0.0.1:8000/api/callback', //'http://localhost:8000/callback',  make error when we put it in the .env
                "ErrorUrl" => 'https://www.google.com/', //'http://localhost:8000/error',  make error when we put it in the .env
                "language" => 'en',
                "DisplayCurrencyIso" => 'KWD'

            ];
                $response =  $this->fatorahService->sendPayment($data);
      
                return redirect($response['Data']['InvoiceURL']);
        }//if(isset($user)){


    }

    /*********************************** */

    public function paymentCallBack(Request $request){

      // return $this->fatorahService->transactionCallBack($request);
      $keyId = $request->paymentId;
      $KeyType = 'paymentId';
      
      $postFields = [
        'Key'     => $keyId,
        'KeyType' => $KeyType
    ];
        // return $this->fatorahService->getPaymentStatus($postFields);

        $my_status = $this->fatorahService->getPaymentStatus($postFields);

        return view('success_page' , ['my_status' => $my_status]);
    }



    // public function paymentCallBack(Request $request){

    //     // return $this->fatorahService->transactionCallBack($request);
    //     $key = $request->paymentId;
    //     $KeyType = 'paymentId';
        
    //     $postFields = [
    //       'Key'     => $keyId,
    //       'KeyType' => $KeyType
    //   ];
    //       return $this->fatorahService->getPaymentStatus($postFields);
  
  
    //   }
  
  
    /******************************************* */


}
