<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MarqueeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TouristPlaceController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\PackageDetailController;
use App\Http\Controllers\PackageGalleryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MetaPageController;

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return "Cache Cleared Successfully";
});
// ═══════════════════════════════════════════════════════════════
// FRONTEND ROUTES
// ═══════════════════════════════════════════════════════════════

Route::get('/', [HomeController::class, 'index']);
Route::view('/about', 'frontend.pages.about');
Route::get('/travel-package/{slug?}', [HomeController::class, 'Packages'])->name('travel-package');
Route::get('/travel-package-detail/{package_url}', [HomeController::class, 'packageDetail'])
    ->name('travel.package.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');


Route::get('/blog-list', [HomeController::class, 'blogList'])->name('blog-list');
Route::get('/blog-details/{id}', [HomeController::class, 'blogDetail'])->name('blog-details');

// ── Package Booking (Frontend) ──────────────────────────────────
Route::post('/package-booking/store', [PackageBookingController::class, 'store'])
    ->name('booking.store');

Route::get('/thank-you/{booking}', [PackageBookingController::class, 'thankYou'])
    ->name('booking.thankyou');

Route::post('/booking/razorpay/callback', [PackageBookingController::class, 'razorpayCallback'])
    ->name('razorpay.callback');

Route::get('/api/package/{packageId}/booked-dates', [PackageBookingController::class, 'bookedDates'])
    ->name('api.package.booked-dates');


Route::post('/contact/store', [ContactController::class, 'store'])
    ->name('contact.store');
Route::get('/admin/contact', [ContactController::class, 'index'])
    ->name('admin.contact.index');
Route::get('/thank-you-2', [ContactController::class, 'thankyou2'])
    ->name('thankyou2');

Route::get('/admin/contact', [ContactController::class, 'index'])
    ->name('admin.contact.index');


    
// ═══════════════════════════════════════════════════════════════
// ADMIN ROUTES
// ═══════════════════════════════════════════════════════════════

Route::prefix('admin')->group(function () {

    Route::get('/login',  [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/package-booking', [PackageBookingController::class, 'index'])->name('admin.package.booking.index');
    });

    // ── Auth required ───────────────────────────────────────────
    Route::middleware('auth')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // MARQUEE
        Route::prefix('marquee')->group(function () {
            Route::get('/',           [MarqueeController::class, 'marquee'])->name('admin.marquee');
            Route::get('/create',     [MarqueeController::class, 'create'])->name('admin.marquee.create');
            Route::post('/store',     [MarqueeController::class, 'storeMarquee'])->name('admin.marquee.store');
            Route::get('/edit/{id}',  [MarqueeController::class, 'edit'])->name('admin.marquee.edit');
            Route::post('/update/{id}', [MarqueeController::class, 'update'])->name('admin.marquee.update');
            Route::delete('/delete/{id}', [MarqueeController::class, 'destroy'])->name('admin.marquee.delete');
        });
        
        Route::prefix('meta')->group(function () {
            Route::get('/', [MetaPageController::class, 'index'])->name('admin.meta.index');
            Route::get('/create', [MetaPageController::class, 'create'])->name('admin.meta.create');
            Route::post('/store', [MetaPageController::class, 'store'])->name('admin.meta.store');
            Route::get('/show/{id}', [MetaPageController::class, 'show'])->name('admin.meta.show');
            Route::get('/edit/{id}', [MetaPageController::class, 'edit'])->name('admin.meta.edit');
            Route::post('/update/{id}', [MetaPageController::class, 'update'])->name('admin.meta.update');
            Route::delete('/delete/{id}', [MetaPageController::class, 'destroy'])->name('admin.meta.delete');
        });
        
        // SLIDER
        Route::prefix('slider')->group(function () {
            Route::get('/',           [SliderController::class, 'index'])->name('admin.slider.index');
            Route::get('/create',     [SliderController::class, 'create'])->name('admin.slider.create');
            Route::post('/store',     [SliderController::class, 'store'])->name('admin.slider.store');
            Route::get('/edit/{id}',  [SliderController::class, 'edit'])->name('admin.slider.edit');
            Route::post('/update/{id}', [SliderController::class, 'update'])->name('admin.slider.update');
            Route::delete('/delete/{id}', [SliderController::class, 'destroy'])->name('admin.slider.destroy');
        });

        // OFFER
        Route::prefix('offer')->group(function () {
            Route::get('/',           [OfferController::class, 'index'])->name('admin.offer.index');
            Route::get('/create',     [OfferController::class, 'create'])->name('admin.offer.create');
            Route::post('/store',     [OfferController::class, 'store'])->name('admin.offer.store');
            Route::get('/edit/{id}',  [OfferController::class, 'edit'])->name('admin.offer.edit');
            Route::post('/update/{id}', [OfferController::class, 'update'])->name('admin.offer.update');
            Route::get('/delete/{id}', [OfferController::class, 'destroy'])->name('admin.offer.delete');
        });

        // COUNTRY
        Route::prefix('country')->group(function () {
            Route::get('/',           [CountryController::class, 'index'])->name('admin.country.index');
            Route::get('/create',     [CountryController::class, 'create'])->name('admin.country.create');
            Route::post('/store',     [CountryController::class, 'store'])->name('admin.country.store');
            Route::get('/edit/{id}',  [CountryController::class, 'edit'])->name('admin.country.edit');
            Route::post('/update/{id}', [CountryController::class, 'update'])->name('admin.country.update');
            Route::delete('/delete/{id}', [CountryController::class, 'destroy'])->name('admin.country.destroy');
        });

        // STATE
        Route::prefix('state')->group(function () {
            Route::get('/',           [StateController::class, 'index'])->name('admin.state.index');
            Route::get('/create',     [StateController::class, 'create'])->name('admin.state.create');
            Route::post('/store',     [StateController::class, 'store'])->name('admin.state.store');
            Route::get('/edit/{id}',  [StateController::class, 'edit'])->name('admin.state.edit');
            Route::post('/update/{id}', [StateController::class, 'update'])->name('admin.state.update');
            Route::delete('/delete/{id}', [StateController::class, 'destroy'])->name('admin.state.destroy');
        });

        // CITY
        Route::prefix('city')->group(function () {
            Route::get('/',           [CityController::class, 'index'])->name('admin.city.index');
            Route::get('/create',     [CityController::class, 'create'])->name('admin.city.create');
            Route::post('/store',     [CityController::class, 'store'])->name('admin.city.store');
            Route::get('/edit/{id}',  [CityController::class, 'edit'])->name('admin.city.edit');
            Route::post('/update/{id}', [CityController::class, 'update'])->name('admin.city.update');
            Route::delete('/delete/{id}', [CityController::class, 'destroy'])->name('admin.city.destroy');
        });

        // PACKAGE
        Route::prefix('package')->group(function () {
            Route::get('/',           [PackageController::class, 'index'])->name('admin.package.index');
            Route::get('/create',     [PackageController::class, 'create'])->name('admin.package.create');
            Route::post('/store',     [PackageController::class, 'store'])->name('admin.package.store');
            Route::get('/edit/{id}',  [PackageController::class, 'edit'])->name('admin.package.edit');
            Route::post('/update/{id}', [PackageController::class, 'update'])->name('admin.package.update');
            Route::delete('/delete/{id}', [PackageController::class, 'destroy'])->name('admin.package.destroy');

            Route::get('/get-states/{countryId}', [PackageController::class, 'getStates'])->name('admin.package.getStates');
            Route::get('/get-cities/{stateId}',   [PackageController::class, 'getCities'])->name('admin.package.getCities');

            // PACKAGE DETAIL
            Route::get('/detail/create/{id}',   [PackageDetailController::class, 'create'])->name('admin.package.detail.create');
            Route::post('/detail/store',         [PackageDetailController::class, 'store'])->name('admin.package.detail.store');
            Route::get('/detail/show/{id}',      [PackageDetailController::class, 'show'])->name('admin.package.detail.show');
            Route::get('/detail/edit/{id}',      [PackageDetailController::class, 'edit'])->name('admin.package.detail.edit');
            Route::put('/detail/update/{id}',   [PackageDetailController::class, 'update'])->name('admin.package.detail.update');
            Route::delete('/detail/delete/{id}', [PackageDetailController::class, 'destroy'])->name('admin.package.detail.delete');
        });

        // PACKAGE GALLERY
        Route::prefix('package-gallery')->group(function () {
            Route::get('/create/{id}',   [PackageGalleryController::class, 'create'])->name('admin.package.gallery.create');
            Route::post('/store',        [PackageGalleryController::class, 'store'])->name('admin.package.gallery.store');
            Route::get('/edit/{id}',     [PackageGalleryController::class, 'edit'])->name('admin.package.gallery.edit');
            Route::post('/update/{id}',  [PackageGalleryController::class, 'update'])->name('admin.package.gallery.update');
            Route::delete('/delete/{id}', [PackageGalleryController::class, 'destroy'])->name('admin.package.gallery.delete');
        });

        // BLOG
        Route::prefix('blog')->group(function () {
            Route::get('/',           [BlogController::class, 'index'])->name('admin.blog.index');
            Route::get('/create',     [BlogController::class, 'create'])->name('admin.blog.create');
            Route::post('/store',     [BlogController::class, 'store'])->name('admin.blog.store');
            Route::get('/edit/{id}',  [BlogController::class, 'edit'])->name('admin.blog.edit');
            Route::post('/update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
             Route::get('/show/{id}',     [BlogController::class, 'show'])->name('admin.blog.show');
            Route::delete('/delete/{id}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');
        });

        // TOURIST
        Route::prefix('tourist')->group(function () {
            Route::get('/',           [TouristPlaceController::class, 'index'])->name('admin.tourist.index');
            Route::get('/create',     [TouristPlaceController::class, 'create'])->name('admin.tourist.create');
            Route::post('/store',     [TouristPlaceController::class, 'store'])->name('admin.tourist.store');
            Route::get('/edit/{id}',  [TouristPlaceController::class, 'edit'])->name('admin.tourist.edit');
            Route::post('/update/{id}', [TouristPlaceController::class, 'update'])->name('admin.tourist.update');
            Route::delete('/delete/{id}', [TouristPlaceController::class, 'destroy'])->name('admin.tourist.destroy');
        });

        // DESTINATION
        Route::prefix('destination')->group(function () {
            Route::get('/',           [DestinationController::class, 'index'])->name('admin.destination.index');
            Route::get('/create',     [DestinationController::class, 'create'])->name('admin.destination.create');
            Route::post('/store',     [DestinationController::class, 'store'])->name('admin.destination.store');
            Route::get('/edit/{id}',  [DestinationController::class, 'edit'])->name('admin.destination.edit');
            Route::post('/update/{id}', [DestinationController::class, 'update'])->name('admin.destination.update');
            Route::get('/delete/{id}', [DestinationController::class, 'delete'])->name('admin.destination.delete');
        });
        Route::get('admin/transactions', [PackageBookingController::class, 'transactions'])
            ->name('admin.transactions.index');

        // PACKAGE BOOKING (Admin)

        Route::prefix('package-booking')->name('admin.package.booking.')->group(function () {

            Route::get('/',        [PackageBookingController::class, 'index'])
                ->name('index');                      // → admin.package.booking.index

            Route::get('/create',  [PackageBookingController::class, 'create'])
                ->name('create');                     // → admin.package.booking.create

            Route::post('/store',  [PackageBookingController::class, 'adminStore'])
                ->name('adminStore');                 // → admin.package.booking.adminStore

            Route::get('/{id}',    [PackageBookingController::class, 'show'])
                ->name('show');                       // → admin.package.booking.show

            Route::post('/{id}/update-status', [PackageBookingController::class, 'updateStatus'])
                ->name('updateStatus');               // → admin.package.booking.updateStatus

            Route::delete('/{id}', [PackageBookingController::class, 'destroy'])
                ->name('delete');                     // → admin.package.booking.delete
        });
    }); 

});
