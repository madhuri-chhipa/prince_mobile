<?php

use App\Http\Controllers\Admin\ManufacturesController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\ContactUsController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController as FrontendNewsController;
use App\Http\Controllers\Frontend\OfferController as FrontendOfferController;
use App\Http\Controllers\Frontend\PrivacyPolicyController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\ServiceController as FrontendServiceController;
use App\Http\Controllers\Frontend\TermsOfServiceController;
use App\Http\Controllers\Frontend\TestimonialController;

/* ------------------ Common Routes START ---------------------------- */
Auth::routes(['verify' => true ]);

Route::get('/', [HomeController::class ,'index'])->name('home');
Route::post('/products-details',[HomeController::class,'productInquiry'])->name('product-details-inquiry');
Route::get('/about',[AboutUsController::class,'index'])->name('about');
Route::get('/products/{cat_slug?}/{subcat_slug?}',[FrontendProductController::class,'index'])->name('products');
Route::get('/products-details/{product_slug?}',[FrontendProductController::class,'productDetails'])->name('product-details');
Route::post('/products-details',[FrontendProductController::class,'productInquiry'])->name('product-details-inquiry');
Route::get('/services',[FrontendServiceController::class,'index'])->name('services');
Route::get('/services/{service_slug?}',[FrontendServiceController::class,'serviceDetails'])->name('services');
Route::post('/services',[FrontendServiceController::class,'serviceInquiry'])->name('service-inquiry');
Route::get('/contact',[ContactUsController::class,'index'])->name('contact');
Route::post('/contact',[ContactUsController::class,'contactSubmit'])->name('contact.submit');
Route::get('/news',[FrontendNewsController::class,'index'])->name('news');
Route::get('/offer',[FrontendOfferController::class,'index'])->name('offers');
Route::get('/privacy-policy',[PrivacyPolicyController::class,'index'])->name('privacy-policy');
Route::get('/testimonial',[TestimonialController::class,'index'])->name('testimonials');
Route::get('/terms-of-service',[TermsOfServiceController::class,'index'])->name('terms-of-service');


/* ----------------- Common Routes END ------------------------------ */

/* --------------------- Admin Routes START ------------------------------ */
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){  
    Route::get('/permission_denied', 'DashboardController@permission_denied');  
    /*** Admin Auth Route(s)***/
    Route::namespace('Auth')->group(function(){
        //Login Routes
        Route::get('/','LoginController@showLoginForm')->name('login');
        // Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('login');
        Route::post('/logout','LoginController@logout')->name('logout');
       
        //Forgot Password Routes
        Route::get('/password/reset','ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email','ForgotPasswordController@sendResetLinkEmail')->name('password.email');
       
        //Reset Password Routes
        Route::get('/password/reset/{token}','ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset','ResetPasswordController@reset')->name('password.update'); 

    });

Route::middleware(['auth:admin', 'permission', 'authCheck'])->group(function () {
    //Put all of your admin routes here...
    Route::get('/dashboard','DashboardController@index')->name('dashboard')->middleware('isAllow:101,can_view');

    /// Profile & change password
    Route::get('/change-password', 'UsersController@changePassword');
    Route::post('/change-password', 'UsersController@updatePassword');

    Route::get('/profile', 'UsersController@profile');
    Route::post('/profile', 'UsersController@updateprofile');

    /// General Settings Routes
    Route::get('/general_settings','GeneralSettingsController@index')->name('general_settings');
    Route::post('/general_settings/update','GeneralSettingsController@update')->name('general_settings.update');
    
    /// Role Routes
    Route::resource('/role', 'RolesController');
    Route::post('/role/status','RolesController@change_status')->name('role.status');

    /// Role-Permissions Routes
    Route::resource('/role_permission', 'RolePermissionController');
    Route::post('/role_permission/status', 'RolePermissionController@update_role_permission')->name('role_permission.status');

    /// User-Permissions Routes
    Route::resource('/user_permission', 'UserPermissionController');
    Route::post('/user_permission/status', 'UserPermissionController@update_user_permission')->name('user_permission.status');

    /// Banner Routes
    Route::resource('/banner', 'BannerController');
    Route::post('/banner/status','BannerController@change_status')->name('banner.status');

     /// Offer Routes
     Route::resource('/offer', 'OfferController');
     Route::post('/offer/status','OfferController@change_status')->name('offer.status');

    /// Subadmin Routes
    Route::resource('/subadmin', 'SubadminController');
    Route::post('/subadmin/status','SubadminController@change_status')->name('subadmin.status');

    /// Cms Routes
    Route::resource('/cms', 'CmsController');
    Route::post('/cms/status','CmsController@change_status')->name('cms.status');

     ///Home Cms Routes
     Route::resource('/home_cms', 'HomeCmsController');
     Route::post('/home_cms/status','HomeCmsController@change_status')->name('home_cms.status');

      /// Category Routes
      Route::resource('/categories', 'CategoryController');
      Route::post('/categories/status', 'CategoryController@change_status')->name('categories.status');
    //   Route::post('/getparentcategory', 'CategoryController@getParentCategory');
    //   Route::post('/getchildcategory', 'CategoryController@getChildCategory');
    
    /// Product
    Route::resource('/product', 'ProductController');
    Route::post('/product/status', 'ProductController@change_status')->name('product.status');

    /// Product Routes

        /// Update product 
        Route::post('/products/updateproduct', 'ProductController@updateproduct')->name('products.updateproduct');

        Route::resource('/products', 'ProductController');
        Route::post('/products/status', 'ProductController@change_status')->name('products.status');

        Route::delete('/products/{pid}/images/{id}','ProductController@destroyImage')->name('proimage.delete');
        Route::get('/getproducts', 'ProductController@getProducts');

        Route::post('/products/getproductbycategory', 'ProductController@getproductbycategory');

    // Product Inquires Routes
    Route::resource('/booking_inquires', 'BookingInquiryController');
    Route::resource('/general_inquires', 'GeneralInquiryController');

    // service Route
    Route::resource('/services', 'ServiceController');
    Route::post('/services/status', 'ServiceController@change_status')->name('services.status');
    Route::post('/services/feature', 'ServiceController@change_feature')->name('services.feature');

    // service inquiry Routes
    Route::resource('/service_inquiries', 'ServiceInquiryController');

    // News Routes
    Route::resource('/news', 'NewsController');
    Route::post('/news/status', 'NewsController@change_status')->name('news.status');

    // manufactures Routes
    Route::resource('/manufactures', 'ManufacturesController');
    Route::post('/manufactures/status','ManufacturesController@change_status')->name('manufactures.status');

    /// Testimonial Routes
    Route::resource('/testimonials', 'TestimonialController');
    Route::post('/testimonials/status','TestimonialController@change_status')->name('testimonials.status');
    });

});
 