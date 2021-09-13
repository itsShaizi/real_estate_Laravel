<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\Notifications\ContactFormSubmissionClientNotification;
use App\Notifications\ContactFormSubmissionStaffNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class ContactFormNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ContactFormSubmitted  $event
     * @return void
     */
    public function handle(ContactFormSubmitted $event)
    {
        // Send message to the user
        Notification::route('mail', $event->formSubmission->email)->notify(new ContactFormSubmissionClientNotification($event->formSubmission));

        // Send message to staff
        $staff = $event->formSubmission->listing->contacts;
        Notification::send($staff , new ContactFormSubmissionStaffNotification($event->formSubmission));
    }
}
