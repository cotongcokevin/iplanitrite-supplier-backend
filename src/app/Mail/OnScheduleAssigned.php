<?php

namespace App\Mail;

use App\Models\Schedule\ScheduleModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OnScheduleAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private ScheduleModel $scheduleModel,
        private $appointeeName
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'On Schedule Assigned',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.schedule.on-schedule-assigned',
        );
    }
}
