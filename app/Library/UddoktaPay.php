<?php

namespace App\Library;

use Exception;

class UddoktaPay
{

    /**
     * Send payment request
     *
     * @param array $requestData
     * @return void
     */

    public static function init_payment($requestData)
    {
        $host = parse_url(env("UDDOKTAPAY_API_URL"),  PHP_URL_HOST);
        $apiUrl = "https://{$host}/api/checkout-v2";
        
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $apiUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($requestData),
            CURLOPT_HTTPHEADER => [
                "RT-UDDOKTAPAY-API-KEY: " . env("UDDOKTAPAY_API_KEY"),
                "accept: application/json",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new Exception("cURL Error #:" . $err);
        } else {
            $result = json_decode($response, true);
            if (isset($result['status']) && isset($result['payment_url'])) {
                return $result['payment_url'];
            } else {
                throw new Exception($result['message']);
            }
        }
        throw new Exception("Please recheck env configurations");
    }

    /**
     * Verify payment
     *
     * @param string $invoice_id
     * @return void
     */

    public static function verify_payment($invoice_id)
    {
        $host = parse_url(env("UDDOKTAPAY_API_URL"),  PHP_URL_HOST);
        $verifyUrl = "https://{$host}/api/verify-payment";

        $invoice_data = [
            'invoice_id'    => $invoice_id
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $verifyUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($invoice_data),
            CURLOPT_HTTPHEADER => [
                "RT-UDDOKTAPAY-API-KEY: " . env("UDDOKTAPAY_API_KEY"),
                "accept: application/json",
                "content-type: application/json"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new Exception("cURL Error #:" . $err);
        } else {
            return json_decode($response, true);
        }
        throw new Exception("Please recheck env configurations");
    }
}
