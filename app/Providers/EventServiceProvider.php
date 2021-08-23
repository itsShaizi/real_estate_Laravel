<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
//events
use App\Events\AuctionEndedTriggered;
use App\Events\LOIDownloadTriggered;
use App\Events\SendClientDashboardTriggered;
use App\Events\AuctionStartsTriggered;
use App\Events\NewOfferSubmitted;
use App\Events\ShowingRequestSubmitted;
use App\Events\ContactFormSubmitted;
use App\Events\RequestForInformationSubmitted;
use App\Events\UserRegisteredForAuction;
use App\Events\ContactSellCommercialSubmitted;
use App\Events\SellerRequestForInformationSubmitted;
//listeners
use App\Listeners\AuctionEndedNotification;
use App\Listeners\LOIDownloadNotification;
use App\Listeners\SendClientDashboardNotification;
use App\Listeners\AuctionStartsNotification;
use App\Listeners\NewOfferNotification;
use App\Listeners\ShowingRequestNotification;
use App\Listeners\ContactFormNotification;
use App\Listeners\RequestForInformationNotification;
use App\Listeners\UserRegisteredForAuctionNotification;
use App\Listeners\ContactSellCommercialNotification;
use App\Listeners\SellerRequestForInformationNotification;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        AuctionEndedTriggered::class => [
            AuctionEndedNotification::class,
        ],
        LOIDownloadTriggered::class => [ 
            LOIDownloadNotification::class,
        ],
        SendClientDashboardTriggered::class => [ 
            SendClientDashboardNotification::class,
        ],
        AuctionStartsTriggered::class => [ 
            AuctionStartsNotification::class,
        ],
        NewOfferSubmitted::class => [ 
            NewOfferNotification::class,
        ],
        ShowingRequestSubmitted::class => [ 
            ShowingRequestNotification::class,
        ],
        ContactFormSubmitted::class => [ 
            ContactFormNotification::class,
        ],
        RequestForInformationSubmitted::class => [ 
            RequestForInformationNotification::class,
        ],
        UserRegisteredForAuction::class => [ 
            UserRegisteredForAuctionNotification::class,
        ],
        ContactSellCommercialSubmitted::class => [ 
            ContactSellCommercialNotification::class,
        ],
        SellerRequestForInformationSubmitted::class => [ 
            SellerRequestForInformationNotification::class,
        ],
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
