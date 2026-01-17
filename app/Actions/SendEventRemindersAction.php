<?php 
namespace App\Actions;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Support\Facades\Log;

class SendEventRemindersAction
{
    public function execute(Event $event): void
    {
        $event->attendees->each(
            fn ($attendee) =>
                $attendee->user->notify(
                    new EventReminderNotification($event->id)
                )
        );

        $event->update(['reminder_sent_at' => now()]);

        Log::info('Event reminder sent', [
            'event_id' => $event->id,
            'attendees' => $event->attendees->count(),
        ]);
    }
}
