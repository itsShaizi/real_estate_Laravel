<?php

namespace App\Notifications;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactFormSubmissionStaffNotification extends Notification
{
    use Queueable;

    public $form;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(FormSubmission $form)
    {
        $this->form = $form;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Contact Form Submission '. $this->form->listing->address)
            ->line($this->form->first_name. ' ' . $this->form->last_name . ' submitted a "Contact Us" Form.')
            ->line('Message: "'. $this->form->message ?? 'No Message' . '".')
            ->action('Form Submissions', route('bk-form-submissions'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
