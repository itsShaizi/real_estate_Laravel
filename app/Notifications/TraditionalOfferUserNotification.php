<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\User;
use App\Models\Offer;

class TraditionalOfferUserNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $offer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Offer $offer)
    {
        $this->user = $user;
        $this->offer = $offer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
            ->subject('Traditional Offer '. $this->offer->listing->address)
            ->line('Congratulations ' . $this->user->first_name . ', a Traditional offer was received from you for the amount of ' . $this->offer->offer_amount . 'USD.')
            ->line($this->offer->listing->address)
            ->action('View Property', route('listing', $this->offer->listing))
            ->line('An agent will contact you soon.')
            ->line('Thank you for using RealtyHive!');
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
            'user' => $this->user,
            'offer' => $this->offer
        ];
    }
}
