<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Payment $payment)
    {
        return view('parent.pay', compact('payment'));
    }

    public function confirm(Request $request, Payment $payment)
    {
        $request->validate([
            'payment_method' => 'required',
            'payment_proof' => 'nullable|image|max:2048',
        ]);
        $payment->status = 'paid';
        $payment->payment_date = now();
        $payment->payment_method = $request->payment_method;
        if ($request->payment_method !== 'cash' && $request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment-proofs', 'public');
            $payment->payment_proof = $path;
        }
        $payment->save();
        return redirect()->route('parent.dashboard')->with('success', 'Pembayaran berhasil dikonfirmasi.');
    }
}
