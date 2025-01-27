<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    public function halamanSubscribe(Request $request)
    {
        $user = $request->session()->get('user');
        return view('pages.subscribe', ['user' => $user]);
    }






    public function generateSnapToken(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $transactionDetails = [
            'order_id' => 'SUB-' . time(),
            'gross_amount' => $request->amount,
        ];

        $customerDetails = [
            'first_name' => $request->email,
            'email' => $request->email,
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        try {
            $snapToken = Snap::getSnapToken($params);

            return response()->json([
                'snapToken' => $snapToken,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function postPaymentSuccess(Request $request)
    {
        $data = [
            'id_user' => $request->id_user,
            'email' => $request->email,
            'amount' => $request->amount,
            'status' => 'Paid',
        ];

        Subscribe::create($data);

        try {
            $user = User::find($request->id_user);
            if ($user) {
                $user->update(['premium' => 'Premium']);
                session()->put('user_premium', 'Premium');
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
