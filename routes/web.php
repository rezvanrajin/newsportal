<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PhotoController;
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

// frontend
Route::get('/',[App\Http\Controllers\HomeController::class, 'index'])->name('Home');
Route::post('/SwitchLanguage',[App\Http\Controllers\HomeController::class, 'SwitchLanguage'])->name('SwitchLanguage');
Route::get('/about',[App\Http\Controllers\HomeController::class, 'About'])->name('About');
Route::get('/subcategory-by-category/{id}',[App\Http\Controllers\HomeController::class, 'subcategorybyCategory'])->name('subcategorybyCategory');
Route::get('/Faq',[App\Http\Controllers\HomeController::class, 'Faq'])->name('Faq');
Route::get('/Terms',[App\Http\Controllers\HomeController::class, 'Terms'])->name('Terms');
Route::get('/Privacy',[App\Http\Controllers\HomeController::class, 'Privacy'])->name('Privacy');
Route::get('/Disclaimer',[App\Http\Controllers\HomeController::class, 'Disclaimer'])->name('Disclaimer');
Route::get('/Contact',[App\Http\Controllers\HomeController::class, 'Contact'])->name('Contact');
Route::post('/contact_usForm',[App\Http\Controllers\HomeController::class, 'contact_usForm'])->name('contact_usForm');
Route::get('/news-details/{id}',[App\Http\Controllers\FrontendpostController::class, 'NewsDetails'])->name('NewsDetails');
Route::get('/category/{id}',[App\Http\Controllers\FrontendsubcategoryController::class, 'index'])->name('category');
Route::get('/photo',[App\Http\Controllers\FrontendphotoController::class, 'index'])->name('FrontendPhoto');
Route::get('/video',[App\Http\Controllers\FrontendvideoController::class, 'index'])->name('FrontendVideo');
Route::post('/subscriber/send_email',[App\Http\Controllers\HomeController::class, 'subscriber_email'])->name('subscriber_email');
Route::get('/subscriber/verify/{token}/{email}',[App\Http\Controllers\HomeController::class, 'subscriber_verify'])->name('subscriber_verify');
Route::get('/LiveChannel',[App\Http\Controllers\FrontendController::class, 'FrontendLiveChannel'])->name('FrontendLiveChannel');
Route::post('/poll_submit',[App\Http\Controllers\FrontendController::class, 'poll_submit'])->name('poll_submit');
Route::get('/poll_previews',[App\Http\Controllers\FrontendController::class, 'poll_previews'])->name('poll_previews');
Route::post('/ArchiveShow',[App\Http\Controllers\FrontendController::class, 'ArchiveShow'])->name('ArchiveShow');
Route::get('/ArchiveDetails/{year}/{month}',[App\Http\Controllers\FrontendController::class, 'ArchiveDetails'])->name('ArchiveDetails');
Route::get('/TagShow/{tag_name}',[App\Http\Controllers\FrontendController::class, 'TagShow'])->name('TagShow');
Route::post('/search/result',[App\Http\Controllers\HomeController::class, 'search'])->name('search');



//Admin
Route::get('/admin/home',[App\Http\Controllers\AdminController::class, 'index'])->name('Admin')->middleware('admin:admin');
Route::get('/admin/login',[App\Http\Controllers\AdminController::class, 'AdminLogin'])->name('AdminLogin');
Route::post('/admin/login-post',[App\Http\Controllers\AdminController::class, 'AdminLoginPost'])->name('AdminLoginPost');
Route::get('/admin/logout',[App\Http\Controllers\AdminController::class, 'AdminLogout'])->name('AdminLogout');
Route::get('/admin/forget-password',[App\Http\Controllers\AdminController::class, 'ForgetPassword'])->name('AdminForgetPassword');
Route::post('/admin/forget-password-post',[App\Http\Controllers\AdminController::class, 'ForgetPasswordPost'])->name('ForgetPasswordPost');
Route::get('/admin/reset-password/{token}/{email}',[App\Http\Controllers\AdminController::class, 'ForgetResetPassword'])->name('ForgetResetPassword');
Route::post('/admin/reset-password-post',[App\Http\Controllers\AdminController::class, 'ResetPasswordPost'])->name('ResetPasswordPost');




//Ads

Route::get('/admin/home-ads',[App\Http\Controllers\AdsController::class, 'HomeAds'])->name('HomeAds')->middleware('admin:admin');
Route::post('/admin/home-ads-update',[App\Http\Controllers\AdsController::class, 'HomeAdsUpdate'])->name('HomeAdsUpdate');
Route::get('/admin/top-ads',[App\Http\Controllers\AdsController::class, 'TopAds'])->name('TopAds')->middleware('admin:admin');
Route::post('/admin/top-ads-update',[App\Http\Controllers\AdsController::class, 'TopAdsUpdate'])->name('TopAdsUpdate');
Route::get('/admin/sidebar-ads',[App\Http\Controllers\AdsController::class, 'SidebarAds'])->name('SidebarAds')->middleware('admin:admin');
Route::get('/admin/sidebar-ads-create',[App\Http\Controllers\AdsController::class, 'SidebarAdsCreate'])->name('SidebarAdsCreate')->middleware('admin:admin');
Route::post('/admin/sidebar-ads-store',[App\Http\Controllers\AdsController::class, 'SidebarAdsStore'])->name('SidebarAdsStore');
Route::get('/admin/sidebar-ads-edit/{id}',[App\Http\Controllers\AdsController::class, 'SidebarAdsEdit'])->name('SidebarAdsEdit')->middleware('admin:admin');
Route::post('/admin/sidebar-ads-update/{id}',[App\Http\Controllers\AdsController::class, 'SidebarAdsUpdate'])->name('SidebarAdsUpdate');
Route::get('/admin/sidebar-ads-delete/{id}',[App\Http\Controllers\AdsController::class, 'SidebarAdsDelete'])->name('SidebarAdsDelete')->middleware('admin:admin');



// Category

Route::get('/admin/category',[App\Http\Controllers\CategoryController::class, 'categoryCreate'])->name('categoryCreate')->middleware('admin:admin');
Route::get('/admin/categoryView',[App\Http\Controllers\CategoryController::class, 'categoryView'])->name('categoryView')->middleware('admin:admin');
Route::post('/admin/categoryStore',[App\Http\Controllers\CategoryController::class, 'categoryStore'])->name('categoryStore');
Route::get('/admin/categoryEdit/{id}',[App\Http\Controllers\CategoryController::class, 'categoryEdit'])->name('categoryEdit')->middleware('admin:admin');
Route::post('/admin/categoryUpdate/{id}',[App\Http\Controllers\CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
Route::get('/admin/categoryDelete/{id}',[App\Http\Controllers\CategoryController::class, 'categoryDelete'])->name('categoryDelete')->middleware('admin:admin');

// Subcategory
Route::get('/admin/sub-category',[App\Http\Controllers\SubcategoryController::class, 'Subcategory'])->name('Subcategory')->middleware('admin:admin');
Route::get('/admin/sub-category-create',[App\Http\Controllers\SubcategoryController::class, 'SubcategoryCreate'])->name('SubcategoryCreate')->middleware('admin:admin');
Route::post('/admin/sub-categoryStore',[App\Http\Controllers\SubcategoryController::class, 'SubcategoryStore'])->name('SubcategoryStore');
Route::get('/admin/sub-categoryEdit/{id}',[App\Http\Controllers\SubcategoryController::class, 'SubcategoryEdit'])->name('SubcategoryEdit')->middleware('admin:admin');
Route::post('/admin/sub-categoryUpdate/{id}',[App\Http\Controllers\SubcategoryController::class, 'SubcategoryUpdate'])->name('SubcategoryUpdate');
Route::get('/admin/sub-categoryDelete/{id}',[App\Http\Controllers\SubcategoryController::class, 'SubcategoryDelete'])->name('SubcategoryDelete')->middleware('admin:admin');

// Post
Route::get('/admin/post',[App\Http\Controllers\PostController::class, 'post'])->name('post')->middleware('admin:admin');
Route::get('/admin/post-create',[App\Http\Controllers\PostController::class, 'postCreate'])->name('postCreate')->middleware('admin:admin');
Route::post('/admin/postStore',[App\Http\Controllers\PostController::class, 'postStore'])->name('postStore');
Route::get('/admin/postEdit/{id}',[App\Http\Controllers\PostController::class, 'postEdit'])->name('postEdit')->middleware('admin:admin');
Route::post('/admin/postUpdate/{id}',[App\Http\Controllers\PostController::class, 'postUpdate'])->name('postUpdate');
Route::get('/admin/PostDelete/{id}',[App\Http\Controllers\PostController::class, 'postDelete'])->name('postDelete')->middleware('admin:admin');
Route::get('/admin/post/tag/delete/{id}/{id1}',[App\Http\Controllers\PostController::class, 'PostTagDelete'])->name('PostTagDelete')->middleware('admin:admin');

// Setting

Route::get('/admin/setting',[App\Http\Controllers\SettingController::class, 'setting'])->name('setting')->middleware('admin:admin');
Route::post('/admin/setting/update',[App\Http\Controllers\SettingController::class, 'settingUpdate'])->name('settingUpdate');

// Photo

Route::get('/admin/photo',[App\Http\Controllers\PhotoController::class, 'photoCreate'])->name('photoCreate')->middleware('admin:admin');
Route::get('/admin/photoView',[App\Http\Controllers\PhotoController::class, 'photoView'])->name('photoView')->middleware('admin:admin');
Route::post('/admin/photoStore',[App\Http\Controllers\PhotoController::class, 'photoStore'])->name('photoStore');
Route::get('/admin/photoEdit/{id}',[App\Http\Controllers\PhotoController::class, 'photoEdit'])->name('photoEdit')->middleware('admin:admin');
Route::post('/admin/photoUpdate/{id}',[App\Http\Controllers\PhotoController::class, 'photoUpdate'])->name('photoUpdate');
Route::get('/admin/photoDelete/{id}',[App\Http\Controllers\PhotoController::class, 'photoDelete'])->name('photoDelete')->middleware('admin:admin');

// video
Route::get('/admin/video',[App\Http\Controllers\VideoController::class, 'videoCreate'])->name('videoCreate')->middleware('admin:admin');
Route::get('/admin/videoView',[App\Http\Controllers\VideoController::class, 'videoView'])->name('videoView')->middleware('admin:admin');
Route::post('/admin/videoStore',[App\Http\Controllers\VideoController::class, 'videoStore'])->name('videoStore');
Route::get('/admin/videoEdit/{id}',[App\Http\Controllers\VideoController::class, 'videoEdit'])->name('videoEdit')->middleware('admin:admin');
Route::post('/admin/videoUpdate/{id}',[App\Http\Controllers\VideoController::class, 'videoUpdate'])->name('videoUpdate');
Route::get('/admin/videoDelete/{id}',[App\Http\Controllers\VideoController::class, 'videoDelete'])->name('videoDelete')->middleware('admin:admin');

// pages

Route::get('/admin/page/about',[App\Http\Controllers\PageController::class, 'about'])->name('admin_about_page')->middleware('admin:admin');
Route::post('/admin/page/update',[App\Http\Controllers\PageController::class, 'AbouteUpdate'])->name('admin_about_page_update');

Route::get('/admin/page/faq',[App\Http\Controllers\PageController::class, 'faq'])->name('admin_faq_page')->middleware('admin:admin');
Route::post('/admin/page/updateFaq',[App\Http\Controllers\PageController::class, 'FaqUpdate'])->name('admin_faq_page_update');

Route::get('/admin/page/terms',[App\Http\Controllers\PageController::class, 'terms'])->name('admin_terms_page')->middleware('admin:admin');
Route::post('/admin/page/updateTerms',[App\Http\Controllers\PageController::class, 'TermsUpdate'])->name('admin_terms_page_update');

Route::get('/admin/page/privacy',[App\Http\Controllers\PageController::class, 'privacy'])->name('admin_privacy_page')->middleware('admin:admin');
Route::post('/admin/page/updatePrivacy',[App\Http\Controllers\PageController::class, 'PrivacyUpdate'])->name('admin_privacy_page_update');

Route::get('/admin/page/disclaimer',[App\Http\Controllers\PageController::class, 'disclaimer'])->name('admin_disclaimer_page')->middleware('admin:admin');
Route::post('/admin/page/updateDisclaimer',[App\Http\Controllers\PageController::class, 'DisclaimerUpdate'])->name('admin_disclaimer_page_update');

Route::get('/admin/page/login',[App\Http\Controllers\PageController::class, 'login'])->name('admin_login_page')->middleware('admin:admin');
Route::post('/admin/page/updateLogin',[App\Http\Controllers\PageController::class, 'LoginUpdate'])->name('admin_login_page_update');

Route::get('/admin/page/contact',[App\Http\Controllers\PageController::class, 'contat'])->name('admin_contact_page')->middleware('admin:admin');
Route::post('/admin/page/updateContact',[App\Http\Controllers\PageController::class, 'ContatUpdate'])->name('admin_contact_page_update');

// faq

Route::get('/admin/FaqShow',[App\Http\Controllers\SettingController::class, 'FaqShow'])->name('FaqShow')->middleware('admin:admin');
Route::get('/admin/faq/creat',[App\Http\Controllers\SettingController::class, 'faqCreate'])->name('faqCreate')->middleware('admin:admin');
Route::post('/admin/faqStore',[App\Http\Controllers\SettingController::class, 'faqStore'])->name('faqStore');
Route::get('/admin/faqEdit/{id}',[App\Http\Controllers\SettingController::class, 'faqEdit'])->name('faqEdit')->middleware('admin:admin');
Route::post('/admin/faqUpdate/{id}',[App\Http\Controllers\SettingController::class, 'faqUpdate'])->name('faqUpdate');
Route::get('/admin/faqDelete/{id}',[App\Http\Controllers\SettingController::class, 'faqDelete'])->name('faqDelete')->middleware('admin:admin');
Route::get('/admin/subsriber/allSubsriberShow',[App\Http\Controllers\SettingController::class, 'allSubsriberShow'])->name('allSubsriberShow')->middleware('admin:admin');
Route::get('/admin/subsriber/SubscriberSendMail',[App\Http\Controllers\SettingController::class, 'Subscriber_send_mail'])->name('Subscriber_send_mail')->middleware('admin:admin');
Route::post('/admin/subsriber/SubscriberSendMailSubmit',[App\Http\Controllers\SettingController::class, 'Subscriber_send_mail_submit'])->name('Subscriber_send_mail_submit')->middleware('admin:admin');

// LiveVideo

Route::get('/admin/LiveVideo',[App\Http\Controllers\IndexController::class, 'LiveVideoCreate'])->name('LiveVideoCreate')->middleware('admin:admin');
Route::get('/admin/LiveVideoView',[App\Http\Controllers\IndexController::class, 'LiveVideoView'])->name('LiveVideoView')->middleware('admin:admin');
Route::post('/admin/LiveVideoStore',[App\Http\Controllers\IndexController::class, 'LiveVideoStore'])->name('LiveVideoStore');
Route::get('/admin/LiveVideoEdit/{id}',[App\Http\Controllers\IndexController::class, 'LiveVideoEdit'])->name('LiveVideoEdit')->middleware('admin:admin');
Route::post('/admin/LiveVideoUpdate/{id}',[App\Http\Controllers\IndexController::class, 'LiveVideoUpdate'])->name('LiveVideoUpdate');
Route::get('/admin/LiveVideoDelete/{id}',[App\Http\Controllers\IndexController::class, 'LiveVideoDelete'])->name('LiveVideoDelete')->middleware('admin:admin');


Route::get('/admin/OnlinePool',[App\Http\Controllers\IndexController::class, 'OnlinePoolCreate'])->name('OnlinePoolCreate')->middleware('admin:admin');
Route::get('/admin/OnlinePoolView',[App\Http\Controllers\IndexController::class, 'OnlinePoolView'])->name('OnlinePoolView')->middleware('admin:admin');
Route::post('/admin/OnlinePoolStore',[App\Http\Controllers\IndexController::class, 'OnlinePoolStore'])->name('OnlinePoolStore');
Route::get('/admin/OnlinePoolEdit/{id}',[App\Http\Controllers\IndexController::class, 'OnlinePoolEdit'])->name('OnlinePoolEdit')->middleware('admin:admin');
Route::post('/admin/OnlinePoolUpdate/{id}',[App\Http\Controllers\IndexController::class, 'OnlinePoolUpdate'])->name('OnlinePoolUpdate');
Route::get('/admin/OnlinePoolDelete/{id}',[App\Http\Controllers\IndexController::class, 'OnlinePoolDelete'])->name('OnlinePoolDelete')->middleware('admin:admin');

Route::get('/admin/SocialIconShow',[App\Http\Controllers\SettingController::class, 'SocialIconShow'])->name('SocialIconShow')->middleware('admin:admin');
Route::get('/admin/SocialIcon/creat',[App\Http\Controllers\SettingController::class, 'SocialIconCreate'])->name('SocialIconCreate')->middleware('admin:admin');
Route::post('/admin/SocialIconStore',[App\Http\Controllers\SettingController::class, 'SocialIconStore'])->name('SocialIconStore');
Route::get('/admin/SocialIconEdit/{id}',[App\Http\Controllers\SettingController::class, 'SocialIconEdit'])->name('SocialIconEdit')->middleware('admin:admin');
Route::post('/admin/SocialIconUpdate/{id}',[App\Http\Controllers\SettingController::class, 'SocialIconUpdate'])->name('SocialIconUpdate');
Route::get('/admin/SocialIconDelete/{id}',[App\Http\Controllers\SettingController::class, 'SocialIconDelete'])->name('SocialIconDelete')->middleware('admin:admin');

// author
Route::get('/admin/author/AuthorShow',[App\Http\Controllers\AdminauthorController::class, 'AuthorShow'])->name('AuthorShow')->middleware('admin:admin');
Route::get('/admin/author/AuthorCreate',[App\Http\Controllers\AdminauthorController::class, 'AuthorCreate'])->name('AuthorCreate')->middleware('admin:admin');
Route::post('/admin/author/AuthorStore',[App\Http\Controllers\AdminauthorController::class, 'AuthorStore'])->name('AuthorStore');
Route::get('/admin/author/AuthorEdit/{id}',[App\Http\Controllers\AdminauthorController::class, 'AuthorEdit'])->name('AuthorEdit')->middleware('admin:admin');
Route::post('/admin/author/AuthorUpdate/{id}',[App\Http\Controllers\AdminauthorController::class, 'AuthorUpdate'])->name('AuthorUpdate');
Route::get('/admin/author/AuthorDelete/{id}',[App\Http\Controllers\AdminauthorController::class, 'AuthorDelete'])->name('AuthorDelete')->middleware('admin:admin');

// locailization
Route::get('/admin/LanguageShow',[App\Http\Controllers\SettingController::class, 'LanguageShow'])->name('LanguageShow')->middleware('admin:admin');
Route::get('/admin/Language/create',[App\Http\Controllers\SettingController::class, 'LanguageCreate'])->name('LanguageCreate')->middleware('admin:admin');
Route::post('/admin/LanguageStore',[App\Http\Controllers\SettingController::class, 'LanguageStore'])->name('LanguageStore');
Route::get('/admin/LanguageEdit/{id}',[App\Http\Controllers\SettingController::class, 'LanguageEdit'])->name('LanguageEdit')->middleware('admin:admin');
Route::post('/admin/LanguageUpdate/{id}',[App\Http\Controllers\SettingController::class, 'LanguageUpdate'])->name('LanguageUpdate');
Route::get('/admin/LanguageDelete/{id}',[App\Http\Controllers\SettingController::class, 'LanguageDelete'])->name('LanguageDelete')->middleware('admin:admin');
Route::get('/admin/LanguageUpdateDetails/{id}',[App\Http\Controllers\SettingController::class, 'LanguageUpdateDetails'])->name('LanguageUpdateDetails')->middleware('admin:admin');
Route::post('/admin/LanguageUpdateDetailsPost/{id}',[App\Http\Controllers\SettingController::class, 'LanguageUpdateDetailsPost'])->name('LanguageUpdateDetailsPost');



// Author Panel


Route::get('/Login',[App\Http\Controllers\AuthorloginController::class, 'Login'])->name('Login');
Route::post('/login-post',[App\Http\Controllers\AuthorloginController::class, 'LoginPost'])->name('LoginPost');
Route::get('/logout',[App\Http\Controllers\AuthorloginController::class, 'Logout'])->name('Logout');
Route::get('/author/home',[App\Http\Controllers\AuthorloginController::class, 'AuthorHome'])->name('Author_home')->middleware('author:author');
Route::get('/author/profile',[App\Http\Controllers\AuthorloginController::class, 'AuthorProfile'])->name('AuthorProfile')->middleware('author:author');
Route::post('/author/profileUpdate',[App\Http\Controllers\AuthorloginController::class, 'AuthorProfilleUpdate'])->name('AuthorProfilleUpdate');
Route::get('/author/forget-password',[App\Http\Controllers\AuthorloginController::class, 'AuthorForgetPassword'])->name('AuthorForgetPassword');
Route::post('/author/forget-password-post',[App\Http\Controllers\AuthorloginController::class, 'AuthorForgetPasswordPost'])->name('AuthorForgetPasswordPost');
Route::get('/reset-password/{token}/{email}',[App\Http\Controllers\AuthorloginController::class, 'AuthorForgetResetPassword'])->name('AuthorForgetResetPassword');
Route::post('/author/reset-password-post',[App\Http\Controllers\AuthorloginController::class, 'AuthorResetPasswordPost'])->name('AuthorResetPasswordPost');




// Author Post
Route::get('/author/post/show',[App\Http\Controllers\AuthorController::class, 'Authorpost'])->name('Authorpost')->middleware('author:author');
Route::get('/author/post-create',[App\Http\Controllers\AuthorController::class, 'AuthorpostCreate'])->name('AuthorpostCreate')->middleware('author:author');
Route::post('/author/postStore',[App\Http\Controllers\AuthorController::class, 'AuthorpostStore'])->name('AuthorpostStore');
Route::get('/author/postEdit/{id}',[App\Http\Controllers\AuthorController::class, 'AuthorpostEdit'])->name('AuthorpostEdit')->middleware('author:author');
Route::post('/author/postUpdate/{id}',[App\Http\Controllers\AuthorController::class, 'AuthorpostUpdate'])->name('AuthorpostUpdate');
Route::get('/author/PostDelete/{id}',[App\Http\Controllers\AuthorController::class, 'AuthorpostDelete'])->name('AuthorpostDelete')->middleware('author:author');
Route::get('/author/post/tag/delete/{id}/{id1}',[App\Http\Controllers\AuthorController::class, 'AuthorPostTagDelete'])->name('AuthorPostTagDelete')->middleware('author:author');



