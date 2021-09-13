<?php

namespace App\Notifications;

use App\Models\Listing;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AuctionEndedStaffNotification extends Notification
{
    use Queueable;

    public $listing;
    public $winningOffer;
    public $offersCount;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Listing $listing, Offer $winningOffer, $offersCount)
    {
        $this->listing = $listing;
        $this->winningOffer = $winningOffer;
        $this->offersCount = $offersCount;
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
            ->subject('Auction Ended '. $this->listing->address)
            ->line($this->winningOffer->user->first_name . ' ' . $this->winningOffer->user->last_name . ' has won the Auction.')
            ->line('Property: '. $this->listing->address)
            ->line('Offer Amount: '. $this->winningOffer->offer_amount)
            ->line('Quantity of offers: '. $this->offersCount)
            ->action('Go To Offers', route('bk-offers'))
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
