<?php

class SmsNetbd
{
    public $international = true, $lang, $config = [], $error,$url;
    private $instance, $title, $body, $numbers = [];

    public function __construct($external_config = [])
    {
        $this->lang = Modules::Lang("SMS", __CLASS__);

        if (!class_exists("SmsNetbd_API")) include __DIR__ . DS . "api.php";

        $config             = include __DIR__ . DS . "config.php";

        $this->config       = $config;

        if (!empty($external_config) && is_array($external_config)) {
            $this->config  = array_merge($config, $external_config);
        }

        $this->title        = $config["origin"];

        $this->instance     = new SmsNetbd_API();

        $this->instance->set_credentials($config["api-token"]);

        // $this->instance->Submit("title", "hero", "8801775051601");
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getBalance()
    {
        return $this->instance->Balance();
    }

    public function send($message = null, $number = null)
    {
        if (!$message || !$number) {

            return json_encode([
                'status' => 'error',
                'message' => 'Message and recipient number are required.',
            ]);
        }

        if (!self::validatePhoneNumber($number)) {
            return json_encode([
                'status' => 'error',
                'message' => 'Invalid phone number format.',
            ]);
        }

        $curl = curl_init();

        $postData = http_build_query([
            'api_key' => $this->instance->api_token,
            'msg' => $message,
            'to' => $number,
        ]);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api.dev.alpha.net.bd' . '/sendsms',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData, // Correctly set POST fields
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Curl error: ' . curl_error($curl); // For debugging if something goes wrong
        }

        curl_close($curl);

        return $response;

    }

    public function validatePhoneNumber($num)
    {
        if (!$num) {
            return false;
          }
      
          $num    = ltrim(trim($num), "+88");
          $number = '88' . ltrim($num, "88");
      
          $ext = [
            "88017",
            "88013",
            "88016",
            "88015",
            "88018",
            "88019",
            "88014",
          ];
          if (
            is_numeric($number) && strlen($number) === 13
            && in_array(substr($number, 0, 5), $ext)
          ) {
            return $number;
          }
      
          return false;

    }

    public function getUrl(){
        return $this->instance->url();
    }

    public function test(){
        return "this is test function";
    }
}


