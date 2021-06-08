<?php

namespace Munafio\OurSMS;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class OurSMS {

    /**
     * Request's endpoint.
     * @var string
     */
    private $endpoint;

    /**
     * Guzzle Http Client.
     * @var Client
     */
    private $client;

    /**
     * Requests' headers.
     * @var array
     */
    private $headers;

    /**
     * Request's body.
     * @var object
     */
    private $body;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('oursms.base_uri'),
        ]);

        $this->headers = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];

        // Initial body data.
        $this->body = [
            "userId" => (int) config('oursms.user_id'),
            "key" => config('oursms.secret_key')
        ];
    }

    /**
     * Send One Single Message ( OSM ).
     *
     * @param string $phoneNumber
     * @param string $message
     * @return void
     */
    public function sendOSM($phoneNumber, $message){
        $this->endpoint = '/Add/SendOneSms';
        $this->body['phoneNumber'] = $phoneNumber;
        $this->body['message'] = $message;
        $this->send();
    }

    /**
     * Send One Time Password ( OTP ).
     *
     * @param string $phoneNumber
     * @param string $message
     * @return void
     */
    public function sendOTP($phoneNumber, $message){
        $this->endpoint = '/Add/SendOtpSms';
        $this->body['phoneNumber'] = $phoneNumber;
        $this->body['otp'] = $message;
        $this->send();
    }

    /**
     * Send SMS.
     *
     * @return object|null
     */
    public function send(){
        try{
            $response = $this->client->post($this->endpoint, [
                'json'    => $this->body,
                'headers' => $this->headers
            ]);
            return $response->getBody();
        } catch (GuzzleException $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 401);
        }
    }

    /**
     * Get Status for SMS.
     *
     * @param string $messageId
     * @return object|null
     */
    public function getStatus($messageId){
        try {
            $response = $this->client->get("/Get/GetStatus/{$messageId}");
            return $response->getBody();
        } catch (GuzzleException $exception) {
            return response()->json([
                'message' => $exception->getMessage()
            ], 401);
        }
    }
}
