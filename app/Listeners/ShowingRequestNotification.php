<?php

namespace App\Listeners;

use App\Events\ShowingRequestSubmitted;
use App\Notifications\ShowingRequestSubmissionClientNotification;
use App\Notifications\ShowingRequestSubmissionStaffNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class ShowingRequestNotification
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
     * @param  ShowingRequestSubmitted  $event
     * @return void
     */
    public function handle(ShowingRequestSubmitted $event)
    {
        // Send message to the user
        Notification::route('mail', $event->formSubmission->email)->notify(new ShowingRequestSubmissionClientNotification($event->formSubmission));

        // Send message to staff
        $staff = $event->formSubmission->listing->contacts;
        Notification::send($staff , new ShowingRequestSubmissionStaffNotification($event->formSubmission));
    }
}
