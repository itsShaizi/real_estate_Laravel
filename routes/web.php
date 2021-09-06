<?php

use App\Models\User;
use App\Models\Country;
use App\Models\Listing;

use Illuminate\Http\Request;
use App\Http\Livewire\ShowUsers;
use App\Http\Livewire\ShowListings;
use App\Http\Livewire\ShowCompanies;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AuctionController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\PermissionController;
use App\Http\Livewire\ShowFeeds;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TempBlogCoverPhotoUploaderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|--------------------------------------
|   FRONTEND NON AUTHORIZED
|--------------------------------------
*/

Route::domain(config('app.blog_domain'))->group(function () {
    Route::get('/', [BlogController::class, 'domainBlogIndex'])->name('sd-blogs');
    Route::get('/{slug}', [BlogController::class, 'blogShow'])->where('slug', '[A-Za-z0-9\-]+')->name('sd-blog');
});


Route::get('/', function () {
    return view('homepage');
});

Route::get('/search', function () {
    return view('frontend.search', ['listings' => Listing::all()]);
})->name('search');

Route::get('/components', function () {
    return view('frontend.components');
})->name('components');
Route::get('/contact', function () {
    return view('frontend.contact', ['user' => User::first()]);
})->name('contact');
Route::post('/contact', function () {
    return view('frontend.contact', ['user' => User::first()]);
})->name('contact');

Route::get('/listing/{listing:slug}', [ListingController::class, 'show'])->where('listing', '[A-Za-z0-9\-]+')->name('listing');

Route::get('/sell', function () {
    return view('frontend.sell.index');
})->name('sell');
Route::get('/sell/commercial', function () {
    return view('frontend.sell.commercial');
})->name('sell-commercial');
Route::get('/sell/residential-land', function () {
    return view('frontend.sell.residential-land');
})->name('sell-residential-land');
Route::get('/sell/seller-bidding-policy', function () {
    return view('frontend.sell.seller-bidding-policy');
})->name('seller-policy');

Route::get('/agents-brokers', function () {
    return view('frontend.agents-brokers.index');
})->name('agents-brokers');
Route::get('/agents-brokers/represent-a-buyer', function () {
    return view('frontend.agents-brokers.represent-a-buyer');
})->name('represent-a-buyer');

Route::get('/buy', function () {
    return view('frontend.buy.index');
})->name('buy');
Route::get('/buy/benefits-of-buying', function () {
    return view('frontend.buy.benefits-of-buying');
})->name('benefits-of-buying');

Route::get('/corporate', function () {
    return view('frontend.corporate.index');
})->name('corporate');
Route::get('/corporate/about-us', function () {
    return view('frontend.corporate.about-us');
})->name('about-us');
Route::get('/corporate/contact-us', function () {
    return view('frontend.corporate.contact-us');
})->name('contact-us');
Route::get('/corporate/team', function () {
    return view('frontend.corporate.team');
})->name('team');
Route::get('/corporate/licensing', function () {
    return view('frontend.corporate.licensing');
})->name('licensing');

Route::get('/learn-more/terms-of-use', function () {
    return view('frontend.learn-more.terms-of-use');
})->name('terms-of-use');
Route::get('/learn-more/due-diligence', function () {
    return view('frontend.learn-more.due-diligence');
})->name('due-diligence');
Route::get('/learn-more/privacy-policy', function () {
    return view('frontend.learn-more.privacy-policy');
})->name('privacy-policy');
Route::get('/learn-more/auction-process', function () {
    return view('frontend.learn-more.auction-process');
})->name('auction-process');
Route::get('/learn-more/traditional-process', function () {
    return view('frontend.learn-more.traditional-process'); })->name('traditional-process');

Route::get('/terms-of-use', function () {
    return view('frontend.terms-of-use'); })->name('terms-of-use');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy'); })->name('privacy-policy');

Route::get('/blog/{slug}', [BlogController::class, 'show'])->where('slug', '[A-Za-z0-9\-]+')->name('blog');

Route::post('localization', LocalizationController::class)->name('localization');

/*
|--------------------------------------
|   FRONTEND AUTHORIZED
|--------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('offer', [OfferController::class, 'store']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



/*
|--------------------------------------
|   BACKEND AUTHORIZED
|--------------------------------------
*/

Route::middleware('is_admin')->prefix('agent-room')->group( function() {

    Route::get('/', \App\Http\Controllers\AgentRoomController::class)->name('agent-room');

    Route::get('/home', [BackendController::class, 'home'])->name('bk-home');

    //Listings
    Route::get('/listings', ShowListings::class)->name('bk-listings');

    Route::get('/listing/create', [ListingController::class, 'create'])->name('bk-listing-create');

    Route::post('/listing', [ListingController::class, 'store'])->name('bk-listing-store');

    Route::post('/listing/{listing_id}', function (Request $request) {
        dd($request->all());
    });

    Route::get('/listing/{listing_id}/edit', [ListingController::class, 'edit'])->name('bk-listing-edit');

    Route::put('/listing/{listing}/update', [ListingController::class, 'update'])->name('bk-listing-update');

    Route::post('/listings/', [ListingController::class, 'search'])->name('bk-listing-search');

    Route::post('/listing/{listing_id}/upload-media', [ListingController::class, 'uploadMedia'])->name('bk-listing-upload-media');


    //Auctions
    Route::get('/auctions', [AuctionController::class, 'index'])->name('bk-auctions');

    Route::get('/auction/create', [AuctionController::class, 'create'])->name('bk-auction-create');

    Route::post('/auction/store', [AuctionController::class, 'store'])->name('bk-auction-store');

    Route::get('/auction/{auction}/edit', [AuctionController::class, 'edit'])->name('bk-auction-edit');

    Route::post('/auction/{auction}/update', [AuctionController::class, 'update'])->name('bk-auction-update');

    Route::get('/auction/{auction}/listings', [AuctionController::class, 'listings']);

    Route::post('/auction/{auction}/listing/{listing}/add', [AuctionController::class, 'add_listing']);

    Route::post('/auction/{auction}/listing/{listing}/remove', [AuctionController::class, 'remove_listing']);

    //Companies
    Route::get('/companies', ShowCompanies::class)->name('bk-companies');

    Route::resource('company', CompanyController::class)->except(['index'])->names([
        'create' => 'bk-company-create',
        'store' => 'bk-company-store',
        'show' => 'bk-company-show',
        'edit' => 'bk-company-edit',
        'update' => 'bk-company-update',
        'destroy' => 'bk-company-delete',
    ]);

    //Users
    Route::get('/users', ShowUsers::class)->name('bk-users');

    Route::get('/user/create', [UserController::class, 'create'])->name('bk-user-create');

    Route::post('/user/store', [UserController::class, 'store'])->name('bk-user-store');

    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('bk-user-edit');

    Route::put('/user/{user}/update', [UserController::class, 'update'])->name('bk-user-update');

    Route::delete('/user/{user}/delete', [UserController::class, 'destroy'])->name('bk-user-delete');

    Route::get('/user/{user}/listings', [UserController::class, 'users']);

    Route::post('/user/{user}/listing/{listing}/add', [UserController::class, 'add_user']);

    Route::post('/user/{user}/listing/{listing}/remove', [UserController::class, 'remove_user']);

    Route::post('/users/', [UserController::class, 'search'])->name('bk-user-search');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('bk-permissions');

    Route::get('/permission/create', [PermissionController::class, 'create'])->name('bk-permission-create');

    Route::post('/permission/store', [PermissionController::class, 'store'])->name('bk-permission-store');

    Route::get('/permission/{permission}/edit', [PermissionController::class, 'edit'])->name('bk-permission-edit');

    Route::post('/permission/{permission}/update', [PermissionController::class, 'update'])->name('bk-permission-update');

    Route::delete('/permission/{permission}/delete', [PermissionController::class, 'destroy'])->name('bk-permission-delete');

    Route::get('/roles', [RoleController::class, 'index'])->name('bk-roles');

    Route::get('/role/create', [RoleController::class, 'create'])->name('bk-role-create');

    Route::post('/role/store', [RoleController::class, 'store'])->name('bk-role-store');

    Route::get('/role/{role}/edit', [RoleController::class, 'edit'])->name('bk-role-edit');

    Route::post('/role/{role}/update', [RoleController::class, 'update'])->name('bk-role-update');

    Route::delete('/role/{role}/delete', [RoleController::class, 'destroy'])->name('bk-role-delete');
    //Feeds
    Route::get('/feeds', ShowFeeds::class )->name('bk-feeds');

    Route::post('/feeds', [FeedController::class, 'filter'])->name('bk-feeds-filter');

    //Blogs
    Route::get('/blogs', [BlogController::class, 'index'])->name('bk-blogs');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('bk-blog-create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('bk-blog-store');
    Route::get('/blog/{slug}/edit', [BlogController::class, 'edit'])->name('bk-blog-edit');
    Route::put('/blog/{blog}/update', [BlogController::class, 'update'])->name('bk-blog-update');
    Route::delete('/blog/{blog}/delete', [BlogController::class, 'destroy'])->name('bk-blog-delete');

    //tags
    Route::get('/tag/search', [TagController::class, 'search'])->name('bk-tag-search');

    //Offers

    Route::get('/offers', [OfferController::class, 'index'])->name('bk-offers');

    //Calendar

    Route::get('/calendar', [CalendarController::class, 'index'])->name('bk-calendar');
});



/*
|--------------------------------------
|   API INTERNAL BACKEND AUTHORIZED
|--------------------------------------
*/

Route::middleware('is_admin')->prefix('api')->group(function () {

    Route::get('/listings', function () {
        return Listing::all();
    });

    Route::get('/countries', function () {
        return Country::all();
    });

    Route::get('/states/{country_id}', function ($country_id) {
        $states = Country::find($country_id);
        return $states->states;
    });

    Route::get('/listings/search/{query}', function ($query) {
        return Listing::search($query)->get();
    });

    Route::post(
        '/temp-avatar-uploader',
        \App\Http\Controllers\TempUserAvatarUploaderController::class
    );
    Route::post(
        '/temp-logo-uploader',
        \App\Http\Controllers\TempCompanyLogoUploaderController::class
    );

    Route::post('/temp-blog-cover-photo-uploader',TempBlogCoverPhotoUploaderController::class);

    Route::get('calendar/events', [CalendarController::class, 'events']);
});




/*
|--------------------------------------
|   API INTERNAL FRONTEND AUTHORIZED
|--------------------------------------
*/

Route::middleware('auth')->prefix('api')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

require __DIR__ . '/auth.php';
