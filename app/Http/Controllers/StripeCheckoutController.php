<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;

class StripeCheckoutController extends Controller
{

        public function checkout(Request $request)
    {
        $jobPostId = $request->jobPostId;
        $amount = $request->amount;

        // Hier kannst du den Zahlungsprozess initiieren und den Benutzer zur Checkout-Seite weiterleiten
        // Verwende $jobPostId und $amount, um die entsprechenden Daten für die Zahlung zu erhalten

        // Beispiel: Stripe-Zahlungsprozess initialisieren und zur Checkout-Seite weiterleiten
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'gbp',
            // Weitere erforderliche Parameter setzen
        ]);

        return redirect()->to($paymentIntent->charges->data[0]->payment_method_details->url);
    }


}
