<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use Midtrans\Config;
use Midtrans\Snap;
use Exception;

class DonationController extends Controller
{
    public function checkout(Request $request, Campaign $campaign)
    {
        // 1. VALIDASI DATA (Mencegah error 10023 karena input kosong)
        $request->validate([
            'donor_name'  => 'required|string|max:255',
            'donor_email' => 'required|email',
            'amount'      => 'required|numeric|min:10000',
        ]);

        try {
            // 2. KONFIGURASI MIDTRANS
            Config::$serverKey    = config('services.midtrans.server_key');
            Config::$isProduction = config('services.midtrans.is_production');
            Config::$isSanitized  = true;
            Config::$is3ds        = true;

            // FIX: SSL Issue Localhost
            Config::$curlOptions = [
                CURLOPT_SSL_VERIFYPEER => false,
            ];

            // 3. SIMPAN KE DATABASE
            $donation = Donation::create([
                'campaign_id' => $campaign->id,
                'external_id' => 'DON-' . time() . '-' . rand(100, 999),
                'donor_name'  => $request->donor_name,
                'donor_email' => $request->donor_email,
                'amount'      => (int) $request->amount,
                'status'      => 'pending',
            ]);

            // 4. PREPARASI PARAMETER (Pastikan tidak ada yang null)
            $params = [
                'transaction_details' => [
                    'order_id'     => (string) $donation->external_id,
                    'gross_amount' => (int) $donation->amount,
                ],
                'customer_details' => [
                    'first_name' => (string) $donation->donor_name,
                    'email'      => (string) $donation->donor_email,
                ],
                'item_details' => [
                    [
                        'id'       => (string) $campaign->id,
                        'price'    => (int) $donation->amount,
                        'quantity' => 1,
                        'name'     => substr('Donasi: ' . $campaign->title, 0, 50),
                    ]
                ],
            ];

            // 5. GET SNAP TOKEN
            $snapToken = Snap::getSnapToken($params);

            // 6. UPDATE DATABASE
            $donation->update(['snap_token' => $snapToken]);

            return response()->json([
                'success'    => true,
                'snap_token' => $snapToken
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
