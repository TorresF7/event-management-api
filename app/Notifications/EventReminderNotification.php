<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public int $eventId)
    {
        //
    }

    public $tries = 3;

    public function backoff(): array
    {
        return [60, 300, 600];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
       $event = Event::findOrFail($this->eventId);
        return (new MailMessage)
            ->subject(__('emails.event_reminder.subject'))
            ->markdown('mail.event-reminder', [
                'event' => $event,
                'user' => $notifiable,
            ]);

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
       return [
            'event_id' => $this->event->id,
            'event_name' => $this->event->name,
            'event_start_time' => $this->event->start_time
        ];
    }
}
