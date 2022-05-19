<?php 

namespace Systha\EssencesSite\Traits;

use GuzzleHttp\Exception\RequestException;

trait HandlesCurlRequest
{
    /**
     * Entrypoint of service
     *
     * @param string $url
     * @param string $method
     * @param array $data
     * @return void
     */
    public function handle($url, $method,$data = [])
    {
        
            $data = json_encode($data);
     
        return $this->request($url,$method,$data);
    }
    /**
     * Handles cUrl Requests
     * @param string $url
     * @param string $method
     * @param array $data
     * @return json
     */
    private function request($url,$method, $data){
        $headers = [
            'User-Agent: Cms Fetch Service',
            'Content-Type: application/json',
            'Cache-Control: no-cache',
            'Origin: localhost:8080',
        ];
        $timeout = 60;
        $ssl_verify = false;

        $ch= curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
        curl_setopt($ch,CURLOPT_TIMEOUT,$timeout);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,$ssl_verify);
        curl_setopt($ch,CURLOPT_CUSTOMREQUEST,strtoupper($method));
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $result = curl_exec($ch);

        curl_close($ch);
        $json = json_decode($result, true);
        if(!$json){
            return $result;
        }
        return $json;
    }

    private function guzzleRequest($url, $method='GET', $data = [])
    {
        $key = $method;
        $method = ($method == 'JSON') ? 'POST' : $method;
        $client = new \GuzzleHttp\Client(["base_uri" => "http://localhost:8000"]);
        $properties = [
            'GET' => [
                'params' =>$data,
            ],
            'POST' =>[
                'form_params' =>$data,
            ],
            'JSON' => [
                'json' =>$data,
            ],
        ];

        $options = [
            'headers' =>[
                'Content-Type' => 'application/json; charset=utf-8',
            ],
        ];
        $options = array_merge($options, $properties[$key]);
        try{
            return $client->request($method, $url, $options);
        }catch(RequestException $e){
            return response(['message'=>$e->getMessage(), 'line' =>
            $e->getLine(), 'file'=> $e->getFile()],500);
        }
    }

}