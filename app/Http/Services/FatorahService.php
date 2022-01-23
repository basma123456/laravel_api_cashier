<?php
namespace App\Http\Services;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request; 

class FatorahService
{
    private $request_client;
    private $base_url;
    private $headers;

    public function __construct(Client $request_client){

        $this->request_client = $request_client;  //injecting an instance of a certain (Client) class in another class (FatorahService)

        $this->base_url = env('fatorah_url');
        $this->headers = [

            'Content-Type' => 'application/json',
            'authorization' => 'Bearer ' . env('fatorah_token')
        ];



    }

  /************************************************ */

  private function buildRequest($url , $method , $data=[]){
    $request = new Request($method, $this->base_url . $url , $this->headers);
  
    if(!$data){
    return false;
    }
    
    $response = $this->request_client->send($request , [
        'json'=>$data
    ]);   
    
    if($response->getStatusCode() != 200){
        return false;
    }

    $response = json_decode($response->getBody() , true);
    return $response;
  }//private function buildRequest

  /****************************************************** */

  public function sendPayment($data){

    //$requestData = $this->parsePaymentdata();
    $response = $this->buildRequest("/v2/SendPayment" , "POST" , $data);

  /*  if($response){
        $this->saveTransactionPayment($patient_id , $response['Data']['invoiceId']);
    }*/
    return $response;
  }// public function sendPayment

    /********************************************************** */

  public function transactionCallBack($data){

    return $data;
  }
  
    /********************************************************** */
  public function getPaymentStatus($data){
    return $this->buildRequest("/v2/GetPaymentStatus" , "POST" , $data);

  }

}
