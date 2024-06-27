<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function index()
    {
        $payments = Payment::where('user_id', auth()->id())->get();

        return view('payments/checkout', compact('payments'));
        
    }

    public function show()
    {
        $payments = Payment::where('user_id', auth()->id())->get();
        
        return view('payments/show', compact('payments'));
    }

    public function create()
    {
        return view('payments/create');
    }

    public function confirm()
    {
        return view('payments/confirmation');
        return redirect()->back()->with('success', 'Payment success, court is now booked');
    }

    
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
            return redirect()->back()->with('error', 'You already added this payment method.');
        }

        // Tambahkan metode pembayaran baru
        $payment = new Payment();
        $payment->payment_method = $request->payment_method;
        $payment->phone_number = $request->phone_number;
        $payment->user_id = auth()->id(); // Set user ID
        $payment->save();

        return redirect()->back()->with('success', 'Payment added successfully!');

    }

    
    public function destroy(string $id)
    {
        $payments = Payment::find($id);
        $payments->delete();
        
        return redirect()->back()->with('success', 'Payment deleted successfully!');
    }}
