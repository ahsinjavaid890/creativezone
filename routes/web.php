<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\PageController; 
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\TestmonialController;
use App\Http\Controllers\Admin\EmailtemplateController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CmsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => true]);
Route::POST('/attemptlogin', [SiteController::class, 'attemptlogin']);
Route::POST('/artistlogin', [SiteController::class, 'artistlogin']);
Route::POST('/userlogin', [SiteController::class, 'userlogin']);
    Route::get('/login',[SiteController::class, 'login'])->name('login');
Route::name('user.')->prefix('user')->group(function(){
    Route::get('dashboard',[HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('myorders',[HomeController::class, 'myorders'])->name('myorders');
    Route::get('vieworder/{id}', [HomeController::class, 'vieworder']);
    Route::get('/checkout', [SiteController::class, 'checkout'])->name('checkout');
    Route::get('deleteinqurie/{id}', [SiteController::class, 'deleteinqurie']);
    Route::get('deletesellinqurie/{id}', [SiteController::class, 'deletesellinqurie']);
    Route::POST('/profileupdate', [SiteController::class, 'profileupdate']);
    Route::POST('/addadress', [SiteController::class, 'addadress']);
    Route::POST('/changeprofilepassword', [SiteController::class, 'changeprofilepassword']);
});
Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('all-events', [SiteController::class, 'allevents']);
Route::get('events/{id}', [SiteController::class, 'eventsdetails']);


Route::get('/', [SiteController::class, 'index']);
Route::get('videos', [SiteController::class, 'videos']);
Route::get('/blogs', [SiteController::class, 'blogs']);
Route::get('tech-suport', [SiteController::class, 'techsuport']);
Route::get('techsupport', [SiteController::class, 'techsupport']);
Route::POST('techsupportsubmit', [SiteController::class, 'techsupportsubmit']);
Route::POST('techsupportsubmittwo', [SiteController::class, 'techsupportsubmittwo']);
Route::get('faq', [SiteController::class, 'faq']);
Route::get('acp', [SiteController::class, 'acp']);
Route::get('terms-of-use', [SiteController::class, 'termsofuse']);
Route::get('privacy-policies', [SiteController::class, 'privacypolicies']);
Route::get('/terms-and-condition', [SiteController::class, 'termsandcondition']);
Route::POST('/ratingreview', [SiteController::class, 'ratingreview'])->name('ratingreview');
Route::get('/aboutus', [SiteController::class, 'aboutus']);
Route::get('/contact', [SiteController::class, 'contactus']);
Route::POST('/contacts', [SiteController::class, 'contacts']);


Route::get('/all/newsletters',[SiteController::class , 'viewLetters'])->name('view_news');
Route::get('/delete/letters/{id}',[SiteController::class , 'deleteLetters'])->name('deletenews');
Route::get('/blog/{id}', [SiteController::class, 'blogdetail']);
Route::get('/category/{id}', [SiteController::class, 'blogbycategory']);

Route::get('/userdashboard', [SiteController::class, 'userdashboard']);

 

// Register Routes
Route::POST('/checkemail', [RegisterController::class, 'checkemail'])->name('checkemail');
Route::get('/checkcompanyname/{id}', [RegisterController::class, 'checkcompanyname']);
Route::get('/checkdotnumber/{id}', [RegisterController::class, 'checkdotnumber']);
Route::POST('/carrierregister', [RegisterController::class, 'carrierregister']);
Route::POST('/register', [RegisterController::class, 'register']);

Route::get('/registeralert', [RegisterController::class, 'registeralert'])->name('registeralert');


Route::POST('/artistsignup', [RegisterController::class, 'artistsignup']);

Route::get('/artistprocess', [RegisterController::class, 'artistprocess'])->name('artistprocess');

Route::POST('/completesignup', [RegisterController::class, 'completesignup']);




// Hiring Maps
Route::name('admin.')->prefix('admin')->group(function(){
    Route::get('/login',[LoginController::class, 'login'])->name('login');
    Route::post('/login-process',[LoginController::class, 'login_process'])->name('login_process');
    Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
});

Route::name('admin.')->prefix('admin')->namespace('App\Http\Controllers\Admin')->middleware('admin')->group(function(){
    Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
    Route::get('/profile','AdminController@profile')->name('profile');
    Route::post('/updateuserprofile','AdminController@updateuserprofile');
    Route::post('/updateusersecurity','AdminController@updateusersecurity');
    Route::get('/changewebsite/{id}','AdminController@changewebsite');
    Route::post('/importstates','AdminController@importstates');
    Route::get('/markasread/{id}', 'AdminController@markasread')->name('markasread');
    

    Route::name('blogs.')->prefix('blogs')->group(function(){
        Route::get('/blogcategories','BlogController@blogcategories');
        Route::post('/addnewblogcategory','BlogController@addnewblogcategory');
        Route::post('/updatblogcategory','BlogController@updatblogcategory');
        Route::get('/deleteblogcategory/{id}','BlogController@deleteblogcategory');
        Route::get('/allblogs','BlogController@allblogs');
        Route::post('/addnewblog','BlogController@createblog');
        Route::post('/updateblog','BlogController@updateblog');
        Route::get('/deleteblog/{id}','BlogController@deleteblog');
    });
    Route::name('photo.')->prefix('photo')->group(function(){
        Route::get('photocategories','PhotoController@photocategories');
        Route::post('/addnewphotocategory','PhotoController@addnewphotocategory');
        Route::post('/updatphotocategory','PhotoController@updatphotocategory');
        Route::get('/deletephotocategory/{id}','PhotoController@deletephotocategory');
        Route::get('/allphotos','PhotoController@allphotos');
        Route::post('/addnewphoto','PhotoController@addnewphoto');
        Route::post('/updatphoto','PhotoController@updatphoto');
        Route::get('/deletephoto/{id}','PhotoController@deletephoto');
    });
     Route::name('testimonials.')->prefix('testimonials')->group(function(){
        Route::get('alltestimonials','TestmonialController@alltestimonials');
        Route::post('addnewtestimonials','TestmonialController@addnewtestimonials');
        Route::post('updattestimonial','TestmonialController@updattestimonial');
        Route::get('deletetestimonial/{id}','TestmonialController@deletetestimonial');
        Route::get('changetestimonialstatus/{id}','TestmonialController@changetestimonialstatus');

    });
    Route::name('email.')->prefix('email')->group(function(){
        Route::get('emailtamplates','EmailtemplateController@emailtamplates');
        Route::get('addemailtamplate','EmailtemplateController@addemailtamplate');
        Route::post('createemailtamplate','EmailtemplateController@createemailtamplate');
        Route::get('editemailtamplate/{id}','EmailtemplateController@editemailtamplate');
        Route::post('updateemailtamplate','EmailtemplateController@updateemailtamplate');
        Route::get('deleteemailtamplate/{id}','EmailtemplateController@deleteemailtamplate');
        Route::get('changeemailtampstatus/{id}','EmailtemplateController@changeemailtampstatus');
        Route::get('getprovider','EmailtemplateController@getprovider');

    });
    

    Route::name('filter.')->prefix('filter')->group(function(){
        Route::get('quicksearch','FilterController@quicksearch');
        
    });
    Route::name('contact.')->prefix('contact')->group(function(){
        Route::get('/messages','AdminController@messages');
        Route::get('/viewmessage/{id}','AdminController@viewmessage'); 
        Route::get('/deletemessage/{id}','AdminController@deletemessage');   
    });

    Route::name('website.')->prefix('website')->group(function(){
        Route::name('settings.')->prefix('settings')->group(function(){
            Route::get('/','SettingsController@appearance');
            Route::get('/general','SettingsController@generalsettings');
            Route::post('/settingsupdate','SettingsController@settingsupdate');
            Route::post('/updatelogos','SettingsController@updatelogos');
            Route::post('/updatelinks','SettingsController@updatelinks');

        });
        
    });
    Route::name('categories.')->prefix('categories')->group(function(){
        Route::get('/allcategories','AdminController@allcategories');
        Route::post('/addnewcategory','AdminController@addnewcategory');
        Route::post('/updatecategory','AdminController@updatecategory');
        Route::get('/deletecategory/{id}','AdminController@deletecategory'); 
        Route::get('/allsubcategories','AdminController@allsubcategories');
        Route::post('/addnewsubcategory','AdminController@addnewsubcategory');
        Route::post('/updatesubcategory','AdminController@updatesubcategory');
        Route::get('/deletesubcategory/{id}','AdminController@deletesubcategory');   
        Route::get('/alltags','AdminController@alltags');
        Route::post('/addnewtag','AdminController@addnewtag');
        Route::post('/updatetag','AdminController@updatetag');
        Route::get('/deletetag/{id}','AdminController@deletetag'); 
    });
    Route::name('artist.')->prefix('artist')->group(function(){
        Route::get('/pendingartist','AdminController@pendingartist');
        Route::get('/approvedartist','AdminController@approvedartist');
        Route::get('/rejectartist','AdminController@rejectartist');
        Route::get('/editartist/{id}','AdminController@editartist');
        Route::get('/changeartiststatus/{id}','AdminController@changeartiststatus');
        Route::get('/deleteartist/{id}','AdminController@deleteartist'); 
    });
    Route::name('events.')->prefix('events')->group(function(){
        Route::get('/allevents','AdminController@allevents');
        Route::get('/createnewevent','AdminController@createnewevent');
        Route::post('/addevent','AdminController@addevent');
    });
    Route::name('jobs.')->prefix('jobs')->group(function(){
        Route::get('/newjob','AdminController@newjob');
        Route::get('/addnewjob','AdminController@addnewjob');
        Route::get('/ongoingjob','AdminController@ongoingjob');
        Route::get('/completejobs','AdminController@completejobs'); 
    });
    Route::name('users.')->prefix('users')->group(function(){
        Route::get('/allusers','UserController@allusers');
        Route::get('/deleteuser/{id}','UserController@deleteuser');
        Route::get('/edituser/{id}','UserController@edituser');
        Route::post('/addnewuser','UserController@addnewuser');
        Route::post('/updateuser','UserController@updateuser');
        Route::get('addnewrole','UserController@addnewrole');
        Route::get('alluserroles','UserController@alluserroles');
        Route::post('createrule','UserController@createrule');
        Route::get('editrole/{id}','UserController@editrole');
        Route::post('updaterule','UserController@updaterule');
        Route::get('/deleteuserrol/{id}','UserController@deleteuserrol');
        Route::get('company','UserController@company');
        Route::post('addcompany','UserController@addcompany');
        Route::get('editcompany/{id}','UserController@editcompany');
        Route::post('updatecompany','UserController@updatecompany');
        Route::get('/deletecompany/{id}','UserController@deletecompany');
    });
    Route::name('faq.')->prefix('faq')->group(function(){
        Route::get('/faqcategories','CmsController@faqcategories');
        Route::post('/addnewfaqcategory','CmsController@addnewfaqcategory');
        Route::post('/updatfaqcategory','CmsController@updatfaqcategory');
        Route::get('/deletefaqcategory/{id}','CmsController@deletefaqcategory');
        Route::get('/allfaq','CmsController@allfaq');
        Route::post('/addnewfaq','CmsController@addnewfaq');
        Route::post('/updatfaq','CmsController@updatfaq');
        Route::get('/deletefaq/{id}','CmsController@deletefaq');
        Route::get('/saveorder','CmsController@saveorder');
    });
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
