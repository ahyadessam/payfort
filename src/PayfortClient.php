<?php

namespace Payfort;

class PayFortClient {

  private $_url;
  private $_access_code;
  private $_identifier;
  private $_sha_type;
  private $_sha_request;
  private $_sha_response;

  public function __construct(){
    if(config('payfort.test_mode'))
      $this->_url = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
    else
      $this->_url = 'https://checkout.payfort.com/FortAPI/paymentPage';

    $this->_access_code   = config('payfort.access_code');
    $this->_identifier    = config('payfort.merchant_identifier');
    $this->_sha_type      = config('payfort.sha_type');
    $this->_sha_request   = config('payfort.sha_request');
    $this->_sha_response  = config('payfort.sha_response');
  }

  public function RedirectionPay($parameters_array){
    if(isset($parameters_array['amount']) && isset($parameters_array['currency']))
      $parameters_array['amount'] = $this->getPrice($parameters_array['currency'], $parameters_array['amount']);

    $parameters_array['command'] = 'AUTHORIZATION';
    $parameters_array['access_code'] = $this->_access_code;
    $parameters_array['merchant_identifier'] = $this->_identifier;
    $parameters_array['language'] = App()->getLocale();
    $parameters_array['signature'] = $this->signature($parameters_array);
    $action = $this->_url;

    echo view('payfort.request', compact(['action', 'parameters_array']));

  }

  public function SADAD($parameters_array){
    $parameters_array['payment_option'] = 'SADAD';
    $this->RedirectionPay($parameters_array);
  }

  public function getPrice($currency, $price){
    $curr_arr = ['BHD', 'IQD', 'JOD', 'KWD', 'LYD', 'OMR', 'TND'];

    if(in_array($currency, $curr_arr))
      return intval($price * pow(10, 3));
    else
      return intval($price * pow(10, 2));
  }

  public function signature($parameters, $action='request'){
    $text = '';
    ksort($parameters);
    foreach($parameters As $key=>$val){
      if($key == 'signature')
        continue;
      $text .= $key.'='.$val;
    }

    $pass = ($action == 'request')? $this->_sha_request : $this->_sha_response;

    $signature = hash($this->_sha_type, $pass.$text.$pass);
    return $signature;
  }

  public function statusMsg($status){
    return __('payfort.'.$status);
  }

}
