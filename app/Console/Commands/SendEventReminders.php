<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Illuminate\Support\Str;
use App\Notifications\EventReminderNotification;

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
    public function handle()
    {
        $events=Event::with('attendees.user')->whereBetween('start_time',[now(),now()->addDay()])->get();

        $eventcount=$events->count();
        $eventLabel= Str::plural('evento',$eventcount);

        $this->info("Enviando recordatorios para {$eventcount} {$eventLabel}");

        $events->each(fn ($event)=> $event->attendees->each(
            fn($attendee) => $attendee->user->notify(
                    new EventReminderNotification(
                        $event
                    )
                )
            )
        );

        $this->info('Notificaciones enviadas correctamente.');
    }
}
