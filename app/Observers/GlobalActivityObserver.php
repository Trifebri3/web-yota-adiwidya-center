<?php

namespace App\Observers;

use App\Notifications\ActivityNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class GlobalActivityObserver
{
    public function created($model)
    {
        $modelName = class_basename($model);
        Log::info("Observer Terpanggil: Mencoba mengirim notifikasi untuk $modelName");

        // 1. Tentukan Siapa Targetnya
        $targets = $this->getTargetUsers($model);

        if ($targets && $targets->count() > 0) {
            $details = [
                'subject' => "Notifikasi: $modelName Baru",
                'body'    => "Halo, ada $modelName baru: '" . ($model->title ?? $model->reference_number ?? 'Tanpa Judul') . "'. Segera cek di platform.",
                'actionURL' => url('/dashboard')
            ];

            // 2. Kirim Langsung ke Email
            Notification::send($targets, new ActivityNotification($details));

            Log::info("Email berhasil dikirim ke " . $targets->count() . " user.");
        } else {
            Log::warning("Tidak ada target email untuk $modelName.");
        }
    }

    /**
     * Logika penentuan target: Semua User atau Per Divisi
     */
    private function getTargetUsers($model)
    {
        $modelName = class_basename($model);

        // JIKA PENGUMUMAN -> KIRIM KE SEMUA USER DI PLATFORM
        // Cek model Announcement atau KabidPengumuman
        if (in_array($modelName, ['Announcement', 'KabidPengumuman'])) {
            return User::all();
        }

        // JIKA AKTIVITAS LAIN -> KIRIM KE SEMUA USER DALAM SATU DIVISI
        // Pastikan model memiliki kolom division_id
        if (isset($model->division_id)) {
            return User::where('division_id', $model->division_id)->get();
        }

        // Jika model tidak punya division_id (misal Delegation yang ke user_id),
        // Kita bisa ambil divisi dari user yang terkait
        if (isset($model->user_id)) {
            $user = User::find($model->user_id);
            if ($user && $user->division_id) {
                return User::where('division_id', $user->division_id)->get();
            }
        }

        return null;
    }
}
