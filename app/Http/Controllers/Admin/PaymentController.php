<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function show()
    {
        return view('payment.payment-form');
    }

    public function pay(Request $request)
    {

        $validatedData = $request->validate([
            'full_name' => ['required', 'string'],
            'email'     => ['required', 'email'],
            'amount'    => ['required', 'integer'],
        ]);

        $order = Payment::create([
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
            'redirect_url' => route('uddoktapay.success'),
            'cancel_url'   => route('uddoktapay.cancel'),
            'webhook_url'  => 'http://coxs.test',
        ];

        $paymentUrl = init_payment($requestData);
        return redirect($paymentUrl);
    }

    public function webhook(Request $request)
    {
        $headerApi = isset($_SERVER['RT_UDDOKTAPAY_API_KEY']) ? $_SERVER['RT_UDDOKTAPAY_API_KEY'] : null;

        if ($headerApi == null) {
            return response("Api key not found", 403);
        }

        if ($headerApi != env("UDDOKTAPAY_API_KEY")) {
            return response("Unauthorized Action", 403);
        }

        $validatedData = $request->validate([
            'full_name'      => 'required',
            'email'          => 'required',
            'amount'         => 'required',
            'invoice_id'     => 'required',
            'metadata'       => 'required',
            'payment_method' => 'required',
            'sender_number'  => 'required',
            'transaction_id' => 'required',
            'status'         => 'required',
        ]);


        dd($validatedData);
        // Payment::findOrFail($validatedData['metadata']['order_id'])->update([
        //     'status'         => $validatedData['status'],
        //     'payment_method' => $validatedData['payment_method'],
        //     'sender_number'  => $validatedData['sender_number'],
        //     'transaction_id' => $validatedData['transaction_id'],
        //     'invoice_id'     => $validatedData['invoice_id'],
        // ]);

        return response('Database Updated');
    }

    public function success()
    {
        return 'Payment is successful, Thanks for using Uddokta Pay- Regards <a href="http://coxs.test/">Coxs Online</a>';
    }

    public function cancel()
    {
        return 'Payment is cancelled Thanks for using Uddokta Pay- Regards <a href="http://coxs.test/">Coxs Online</a>';
    }
}
