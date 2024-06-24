<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'phone_number' => 'required|string',
        ]);

        // Cek apakah metode pembayaran sudah ada untuk user yang sedang login
        $existingPayment = Payment::where('payment_method', $request->payment_method)
                                  ->where('user_id', auth()->id())
                                  ->first();
        if ($existingPayment) {
            return response()->json(['message' => 'You already added this payment method.'], 400);
        }

        // Tambahkan metode pembayaran baru
        $payment = new Payment();
        $payment->payment_method = $request->payment_method;
        $payment->phone_number = $request->phone_number;
        $payment->user_id = auth()->id(); // Set user ID
        $payment->save();

        return response()->json(['message' => 'Payment method added successfully.']);
    }

    public function getPayments()
    {
        $payments = Payment::where('user_id', auth()->id())->get();
        return view('checkout', compact('payments'));
    }

    public function delete(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        $result = Payment::where('payment_method', $paymentMethod)->delete();

        if ($result) {
            return response()->json(['message' => 'Payment method deleted successfully']);
        } else {
            return response()->json(['message' => 'Failed to delete payment method'], 400);
        }
    }
}
