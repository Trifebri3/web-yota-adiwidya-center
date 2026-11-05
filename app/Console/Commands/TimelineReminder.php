<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TimelineStage;

class TimelineReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:timeline-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
public function handle()
{
    // Cari termin yang berakhir hari ini
    $deadlineToday = TimelineStage::where('end_date', today())
                        ->where('is_completed', false)
                        ->get();

    foreach($deadlineToday as $stage) {
        // Kirim Notifikasi ke Admin/Kabid terkait
        // Logika: Notification::send($users, new StageReminderNotification($stage));
    }
}
}
