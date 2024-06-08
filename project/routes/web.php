<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GeneralSettingController;
use App\Http\Controllers\Admin\GenesisController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageRoleController;
use App\Http\Controllers\Admin\ManageStaffController;
use App\Http\Controllers\Admin\ManageTestimonialController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// ************************** ADMIN SECTION START ***************************//

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/forgot-password', [LoginController::class, 'forgotPasswordForm'])->name('forgot.password');
    Route::post('/forgot-password', [LoginController::class, 'forgotPasswordSubmit']);
    Route::get('forgot-password/verify-code', [LoginController::class, 'verifyCode'])->name('verify.code');
    Route::post('forgot-password/verify-code', [LoginController::class, 'verifyCodeSubmit']);


    Route::middleware('auth:admin')->group(function () {
  
    // Admin Dashboard Controller @s
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
        
        Route::get('reset-password', [LoginController::class, 'resetPassword'])->name('reset.password');
        Route::post('reset-password', [LoginController::class, 'resetPasswordSubmit']);
        

        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        
        Route::get('/password', [AdminController::class, 'passwordreset'])->name('password');
        Route::post('/password/update', [AdminController::class, 'changepass'])->name('password.update');

        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AdminController::class, 'profileupdate'])->name('profile.update');

        // cookie  section
        Route::get('/manage-cookie', [AdminController::class, 'cookie'])->name('cookie');
        Route::post('/manage-cookie', [AdminController::class, 'updateCookie'])->name('update.cookie');

        // Language section 

        Route::get('/manage-language', [AdminController::class, 'language'])->name('language');
        Route::post('/language/update', [AdminController::class, 'languageUpdate'])->name('language.update');


       

        Route::put('page/update/{page}', [PageController::class, 'update'])->name('page.update');
        Route::post('page/remove', [PageController::class, 'destroy'])->name('page.remove');
        Route::post('page/store', [PageController::class, 'store'])->name('page.store');

        // Blog Category Controller 
        Route::get('blog-category', [BlogCategoryController::class, 'index'])->name('bcategory.index');
        Route::post('blog-category/store', [BlogCategoryController::class, 'store'])->name('bcategory.store');
        Route::put('blog-category/update/{id}', [BlogCategoryController::class, 'update'])->name('bcategory.update');
        Route::delete('blog-category/destroy', [BlogCategoryController::class, 'destroy'])->name('bcategory.destroy');
        // Blog category Controller ends 

        // Blog Controller @s 
        Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
        Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
        Route::get('blog/edit/{blog}', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('blog/update/{blog}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('blog-delete/{blog}', [BlogController::class, 'destroy'])->name('blog.destroy');
       
        // Blog Controller ends

        // Blog Category Controller 
        Route::get('bible', [GenesisController::class, 'index'])->name('genesis.index');
        Route::post('bible/store', [GenesisController::class, 'store'])->name('genesis.store');
        Route::put('bible/update/{id}', [GenesisController::class, 'update'])->name('genesis.update');
        Route::delete('bible/destroy', [GenesisController::class, 'destroy'])->name('genesis.destroy');
        // Blog category Controller ends 

        // Video Controller @s
        Route::get('video', [VideoController::class, 'index'])->name('video.index');
        Route::get('video/create', [VideoController::class, 'create'])->name('video.create');
        Route::post('video/store', [VideoController::class, 'store'])->name('video.store');
        Route::get('video/edit/{video}', [VideoController::class, 'edit'])->name('video.edit');
        Route::put('video/update/{video}', [VideoController::class, 'update'])->name('video.update');
        Route::delete('video-delete/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
        // Video Controller ends
        
        Route::get('helio', [VideoController::class, 'helioindex'])->name('helio.index');
        Route::get('helio/create', [VideoController::class, 'heliocreate'])->name('helio.create');
        Route::post('helio/store', [VideoController::class, 'heliostore'])->name('helio.store');
        Route::get('helio/edit/{helio}', [VideoController::class, 'helioedit'])->name('helio.edit');
        Route::put('helio/update/{helio}', [VideoController::class, 'helioupdate'])->name('helio.update');
        Route::delete('helio-delete/{helio}', [VideoController::class, 'heliodestroy'])->name('helio.destroy');
        
        // Team Controller @s 
        Route::get('/manage-team', [TeamController::class, 'index'])->name('team.index');
        Route::get('/create-team', [TeamController::class, 'create'])->name('team.create');
        Route::post('/store-team', [TeamController::class, 'store'])->name('team.store');
        Route::get('/edit-team/{id}', [TeamController::class, 'edit'])->name('team.edit');
        Route::put('/update-team/{id}', [TeamController::class, 'update'])->name('team.update');
        Route::delete('/delete-team', [TeamController::class, 'destroy'])->name('team.destroy');
        
        // Team Controller ends

        // Faq Controller @s
        Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
        Route::post('/faq/store', [FaqController::class, 'store'])->name('faq.store');
        Route::put('/faq/update/{id}', [FaqController::class, 'update'])->name('faq.update');
        Route::delete('/faq/destroy', [FaqController::class, 'destory'])->name('faq.destroy');

        // Faq Controller ends

        // Brand Controller @s
        Route::get('brand', [BrandController::class, 'index'])->name('brand.index');
        Route::post('brand/store', [BrandController::class, 'store'])->name('brand.store');
        Route::put('brand/update/{brand}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('brand-delete', [BrandController::class, 'destroy'])->name('brand.destroy');
        // Brand Controller ends

        // About Controller @s
        Route::get('about', [AboutController::class, 'index'])->name('about.index');
        Route::put('about/update', [AboutController::class, 'update'])->name('about.update');
        

        
        // Testimonial Controller @s
        Route::get('/manage-testimonial', [ManageTestimonialController::class, 'index'])->name('testimonial.index');
        Route::post('/add-testimonial', [ManageTestimonialController::class, 'store'])->name('testimonial.store');
        Route::put('/update-testimonial/{id}', [ManageTestimonialController::class, 'update'])->name('testimonial.update');
        Route::delete('/delete-testimonial', [ManageTestimonialController::class, 'destroy'])->name('testimonial.destroy');
        // Testimonial Controller ends

        // Social Controller @s
        Route::get('social/link', [SocialController::class, 'index'])->name('social.manage');
        Route::post('add/social/link', [SocialController::class, 'store'])->name('social.store');
        Route::put('update/social/link/{id}', [SocialController::class, 'update'])->name('social.update');
        Route::delete('destroy/social/link', [SocialController::class, 'destroy'])->name('social.destroy');
        // Social Controller ends

        

        // General Setting Controller @s
        Route::get('/general-settings/status/update/{value}', [GeneralSettingController::class, 'StatusUpdate'])->name('gs.status');
        Route::post('/general-settings/update', [GeneralSettingController::class, 'update'])->name('gs.update');



        // Role Manage Controll @s 
        Route::get('/role', [ManageRoleController::class, 'index'])->name('role.index');
        Route::get('/role/create', [ManageRoleController::class, 'create'])->name('role.create');
        Route::post('/role/store', [ManageRoleController::class, 'store'])->name('role.store');
        Route::get('/role/edit/{id}', [ManageRoleController::class, 'edit'])->name('role.edit');
        Route::put('/role/update/{id}', [ManageRoleController::class, 'update'])->name('role.update');
        Route::delete('/role/delete', [ManageRoleController::class, 'destroy'])->name('role.destroy');

        // Role Manage Controll @e 

        // Contact Controller @s 
        Route::get('/contact/page/setting', [ContactController::class, 'index'])->name('contact.setting.index');
        Route::get('/contact/message', [ContactController::class, 'contactMessage'])->name('contact.message');
        Route::get('/getintouch/message', [ContactController::class, 'getintouch'])->name('contact.getintouch.message');
        Route::delete('/contact/message/delete', [ContactController::class, 'contactMessageDelete'])->name('contact.message.delete');
        Route::put('/contact/page/setting/update', [ContactController::class, 'update'])->name('contact.setting.update');
        

        
        Route::delete('/subscriber/delete', [AdminController::class, 'subscribersDelete'])->name('subscriber.destroy');
        Route::post('add/staff', [ManageStaffController::class, 'addStaff'])->name('staff.add');
        Route::post('update/staff/{id}', [ManageStaffController::class, 'updateStaff'])->name('staff.update');
        Route::delete('destroy/staff', [ManageStaffController::class, 'destroy'])->name('staff.destroy');




   

    

   
    

    
        
        

        

            // Service Category 
            
           
      

   
            //pages
            Route::get('page', [PageController::class, 'index'])->name('page.index');
            Route::get('page/create', [PageController::class, 'create'])->name('page.create');
           
            Route::get('page/edit/{page}', [PageController::class, 'edit'])->name('page.edit');
            
       

       
            //manage blogs
            
            

            
            
       
       
            

        
            
       
      
            // manage team
            
           

    

     

            // FAQ
            
           

       
        
            // Brand section
            
           
            // About section
            
            
            // Contact section
            Route::get('contact/section', [GeneralSettingController::class, 'contact_section'])->name('contact.section');
            // manage testimonail
            
            


            Route::get('hero/page', [GeneralSettingController::class, 'hero_page'])->name('hero.page');



            //==================================== GENERAL SETTING SECTION ==============================================//

            Route::get('/general-settings', [GeneralSettingController::class, 'siteSettings'])->name('gs.site.settings');
            Route::get('/plugin-settings', [GeneralSettingController::class, 'pluginSettings'])->name('gs.plugin.settings');
            Route::get('/maintainance-settings', [GeneralSettingController::class, 'maintainance'])->name('gs.maintainance.settings');
           
            Route::get('/general-settings/logo-favicon', [GeneralSettingController::class, 'logo'])->name('gs.logo');
            Route::get('/general-settings/breadcumb', [GeneralSettingController::class, 'breadcumb'])->name('gs.breadcumb');
            Route::get('/general-settings/maintenance', [GeneralSettingController::class, 'maintenance'])->name('gs.maintenance');
            
            //cookie
            
           
            
           
            // theme
            Route::get('/theme-settings', [GeneralSettingController::class, 'themeSettings'])->name('gs.theme.settings');
            //==================================== GENERAL SETTING SECTION ==============================================//


            // ==================================== ADMIN CONTACT SECTION ====================================//
            
            
      

        
            //role manage
            
           
      

            //manage staff
            Route::get('manage/staff', [ManageStaffController::class, 'index'])->name('staff.manage');
            Route::get('manage/subscribers', [AdminController::class, 'subscribers'])->name('subscriber');
           

      


  
        Route::get('/clear-cache', function () {
            Artisan::call('optimize:clear');
            return back()->with('success', 'Cache cleared successfully');
        })->name('clear.cache');

    });

});



Route::middleware(['maintenance'])->group(function () {
// =========================================== FRONTEND ROUTES ===========================================//

Route::get('/', [FrontendController::class, 'index'])->name('homepage');
// Donate 
Route::get('/donate', [FrontendController::class, 'donate'])->name('donate');
Route::post('/donate', [FrontendController::class, 'donateSubmit'])->name('donate.submit');
// stripe payment 
Route::post('/stripe/charge', [FrontendController::class, 'stripeCharge'])->name('stripe.charge');
Route::get('/checkout/payment/success', [FrontendController::class,'success'])->name('checkout.success');
Route::get('/checkout/payment/cancel', [FrontendController::class,'cancel'])->name('checkout.cancel');
// Blog post 
Route::get('/articles', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetails'])->name('blog.details');
// Videos post 
Route::get('/videos', [FrontendController::class, 'video'])->name('video');
Route::get('/video/{slug}', [FrontendController::class, 'videoDetails'])->name('video.details');
//Partner route
Route::get('/partners', [FrontendController::class, 'partner'])->name('partners');
// About us
Route::get('/about', [FrontendController::class, 'about'])->name('about');
// Contact us
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
// vision 
Route::get('/page/{slug}', [FrontendController::class, 'page'])->name('page');
// Bible Route
Route::get('/bible/{id}', [FrontendController::class, 'bible'])->name('bible');

Route::get('/heliopolis/', [FrontendController::class, 'heliopolis'])->name('heliopolis');


});

