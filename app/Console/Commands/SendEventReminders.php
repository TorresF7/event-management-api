<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Illuminate\Support\Str;
use App\Notifications\EventReminderNotification;
use App\Actions\SendEventRemindersAction;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar notificaciones de recordatorio para eventos';

    /**
     * Execute the console command.
     */
    public function handle(SendEventRemindersAction $action)
    {
        Event::with('attendees.user')
        ->whereNull('reminder_sent_at')
        ->whereBetween('start_time', [now(), now()->addDay()])
        ->chunk(50, function ($events) use ($action) {
            $events->each(fn ($event) => $action->execute($event));
        });

        $this->info('Notificaciones enviadas correctamente.');
    }
}
