<?php

namespace App\Http\Controllers;

use App\Library\UddoktaPay;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class UddoktapayController extends Controller
{

    /**
     * Show the payment view
     *
     * @return void
     */
    public function show()
    {
        return view('uddoktapay.payment-form');
    }

    /**
     * Initializes the payment
     *
     * @param Request $request
     * @return void
     */
    public function pay(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => ['required', 'string'],
            'email'     => ['required', 'email'],
            'amount'    => ['required', 'integer'],
        ]);

        $order = Order::create([
            'full_name' => $validatedData['full_name'],
            'email'     => $validatedData['email'],
            'amount'    => $validatedData['amount'],
        ]);

        $requestData = [
            'full_name'    => $validatedData['full_name'],
            'email'        => $validatedData['email'],
            'amount'       => $validatedData['amount'],
            'metadata'     => [
                'order_id'   => $order->id,
                'metadata_1' => 'foo',
                'metadata_2' => 'bar',
            ],
            'redirect_url'  => route('uddoktapay.success'),
            'return_type'   => 'GET',
            'cancel_url'    => route('uddoktapay.cancel'),
            'webhook_url'   => route('uddoktapay.webhook'),
        ];

        try {
            $paymentUrl = UddoktaPay::init_payment($requestData);
            return redirect($paymentUrl);
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    /**
     * Reponse from sever
     *
     * @param Request $request
     * @return void
     */
    public function webhook(Request $request)
    {

        $headerAPI = isset($_SERVER['HTTP_RT_UDDOKTAPAY_API_KEY']) ? $_SERVER['HTTP_RT_UDDOKTAPAY_API_KEY'] : NULL;

        if (empty($headerAPI)) {
            return response("Api key not found", 403);
        }

        if ($headerAPI != env("UDDOKTAPAY_API_KEY")) {
            return response("Unauthorized Action", 403);
        }

        $bodyContent = trim($request->getContent());
        $bodyData = json_decode($bodyContent);
        $data = UddoktaPay::verify_payment($bodyData->invoice_id);
        if (isset($data['status']) && $data['status'] == 'COMPLETED') {
            // Do action with $data
        }
    }

    /**
     * Success URL
     *
     * @return void
     */
    public function success(Request $request)
    {
        if (empty($request->invoice_id)) {
            die('Invalid Request');
        }
        $data = UddoktaPay::verify_payment($request->invoice_id);
        if (isset($data['status']) && $data['status'] == 'COMPLETED') {
            // do action with $data
            dd($data);
        } else {
            // pending payment
            dd($data);
        }
    }

    /**
     * Cancel URL
     *
     * @return void
     */
    public function cancel( Request $request)
    {
        return 'Payment is cancelled';
    }
}
