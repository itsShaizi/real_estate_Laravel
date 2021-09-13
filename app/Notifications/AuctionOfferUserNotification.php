<?php

namespace App\Notifications;

use App\Models\Offer;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuctionOfferUserNotification extends Notification
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
            ->subject('Auction Offer '. $this->offer->listing->address)
            ->line('Congratulations ' . $this->user->first_name . ', you have successfully placed an Auction Offer of ' . number_format($this->offer->offer_amount) . ' USD for the property:')
            ->line($this->offer->listing->address)
            ->action('View Property', route('listing', $this->offer->listing))
            ->line('An agent will contact you as soon as the auction ends.')
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
            //
        ];
    }
}
