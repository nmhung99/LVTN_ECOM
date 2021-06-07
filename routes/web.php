<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('pages.index');
})->name('index');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::post('/user/post/register', 'Auth\RegisterController@postRegister');
Route::get('/register/success', 'Auth\RegisterController@successRegister');
Route::post('/user/post/login', 'Auth\LoginController@postLogin');
// Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password/update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');
Route::get('/user/resend/mailverify', 'Auth\VerificationController@resendmail')->name('mailvery.resend');
Route::post('/resend/email/verify', 'Auth\VerificationController@resend');

//admin=======
Route::get('admin/home', 'AdminController@index')->name('admin.home');;
Route::get('/admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/post-login', 'Admin\LoginController@postLogin');
        // Password Reset Routes...
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/change/password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update'); 
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');

////Admin Section
//CAtegories
Route::get('/admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('/admin/store/categories', 'Admin\Category\CategoryController@storecategory')->name('store.category');
Route::post('/admin/delete/categories', 'Admin\Category\CategoryController@deleteCategory');
Route::get('/admin/categories/edit/{id?}', 'Admin\Category\CategoryController@updateCategory');
Route::post('/admin/categories/update/{id?}', 'Admin\Category\CategoryController@postupdateCategory');

//Brands
Route::get('/admin/brands', 'Admin\Category\BrandController@brand')->name('brands');
Route::post('/admin/brands/uplogo', 'Admin\Category\BrandController@upLoadLogo');
Route::post('/admin/store/brands', 'Admin\Category\BrandController@storebrand')->name('store.brand');
Route::post('/admin/delete/brands', 'Admin\Category\BrandController@deleteBrand');
Route::get('/admin/brands/edit/{id?}', 'Admin\Category\BrandController@updateBrand');
Route::post('/admin/brands/update/{id?}', 'Admin\Category\BrandController@postupdateBrand');

//Group Product
Route::get('/admin/group/product', 'Admin\GroupProductController@groupProduct')->name('group.product');
Route::post('/admin/store/group', 'Admin\GroupProductController@storeGroup')->name('store.group');
Route::post('/admin/delete/group', 'Admin\GroupProductController@deletegroupProduct');
Route::get('/admin/groupproduct/edit/{id?}', 'Admin\GroupProductController@updategroupProduct');
Route::post('/admin/groupproduct/update/{id?}', 'Admin\GroupProductController@postupdategroupProduct');

//Sub Category
Route::get('/admin/sup/category', 'Admin\Category\SubCategoryController@subCategory')->name('sub.categories');
Route::post('/admin/store/subcategory', 'Admin\Category\SubCategoryController@storesubCategory')->name('store.category');
Route::post('/admin/delete/subcategory', 'Admin\Category\SubCategoryController@deletesubCategory');
Route::get('/admin/subcategory/edit/{id?}', 'Admin\Category\SubCategoryController@updatesubCategory');
Route::post('/admin/subcategory/update/{id?}', 'Admin\Category\SubCategoryController@postupdatesubCategory');

//Get sub category by select Category
Route::get('/get/subcategory/{category_id}', 'Admin\ProductController@getCategory');
//Get brand by select Category
Route::get('/get/brand/{category_id}', 'Admin\ProductController@getBrand');
//Get group product by select Brand
Route::get('/get/groupproduct/{brand_id}', 'Admin\ProductController@getGroup');

//Coupon
Route::get('/admin/sup/coupon', 'Admin\Category\CouponController@Coupon')->name('admin.coupon');
Route::post('/admin/store/coupon', 'Admin\Category\CouponController@storeCoupon')->name('store.coupon');
Route::post('/admin/delete/coupon', 'Admin\Category\CouponController@deleteCoupon');
Route::get('/admin/coupon/edit/{id?}', 'Admin\Category\CouponController@updateCoupon');
Route::post('/admin/coupon/update/{id?}', 'Admin\Category\CouponController@postupdateCoupon');

//Newsletter
Route::get('/admin/newsletter', 'Admin\Category\CouponController@Newsletter')->name('admin.newsletter')->middleware('authrole:other');
Route::post('/admin/delete/newsletter', 'Admin\Category\CouponController@deletenewsletter')->middleware('authrole:other');

//Product
Route::get('/admin/product', 'Admin\ProductController@index')->name('admin.product');
Route::get('/admin/product/add', 'Admin\ProductController@create')->name('add.product');
Route::post('/admin/product/upimg', 'Admin\ProductController@upImage');
Route::post('/admin/store/product', 'Admin\ProductController@storeProduct');
Route::post('/admin/delete/product', 'Admin\ProductController@deleteProduct');
Route::get('/admin/view/product/{id?}', 'Admin\ProductController@viewProduct');
Route::get('/admin/product/edit/{id?}', 'Admin\ProductController@updateProduct');
Route::post('/admin/product/update/{id?}', 'Admin\ProductController@postupdateProduct');
// Route::post('/unlink/img', 'Admin\ProductController@unlinkImage');

//Active and Inactive Product
Route::post('/admin/active/product', 'Admin\ProductController@active');
Route::post('/admin/inactive/product', 'Admin\ProductController@inactive');

//Blog Admin
Route::get('/admin/blog/category', 'Admin\PostController@blogCat')->name('admin.blog.category');
Route::post('/admin/store/blogcategory', 'Admin\PostController@storeBlogCat');
Route::post('/admin/delete/blogcategory', 'Admin\PostController@deleteBlogCategory');
Route::get('/admin/blogcategory/edit/{id?}', 'Admin\PostController@updateBlogCat');
Route::post('/admin/blogcategory/update/{id?}', 'Admin\PostController@postupdateBlogCat');
//POst
Route::get('/admin/blog/post', 'Admin\PostController@indexPost')->name('admin.blogpost');
Route::get('/admin/blog/addpost', 'Admin\PostController@addPost')->name('add.blogpost');
Route::post('/admin/store/blogpost', 'Admin\PostController@storeBlogPost');
Route::post('/admin/delete/blogpost', 'Admin\PostController@deleteBlogPost');
Route::post('/admin/blogpost/upimg', 'Admin\PostController@upImage');
Route::get('/admin/blogpost/edit/{id?}', 'Admin\PostController@updatePost');
Route::post('/admin/blogpost/update/{id?}', 'Admin\PostController@postupdatePost');


/////Front-end route
Route::post('/store/newsletter', 'FrontController@storeNewsletter')->name('store.newsletter');

//Add Wishlist
Route::get('/add/wishlist/{id?}', 'WishlistController@addWishlist');
//Add Cart
Route::get('/add/to/cart/{id?}', 'CartController@addCart');
Route::get('/cartcheck', 'CartController@checkCart');
Route::get('/product/details/{id}/{product_name}', 'ProductController@productView');
Route::post('/product/add/cart/{id}', 'ProductController@addCart');
Route::get('/product/cart', 'CartController@showCart')->name('show.cart');
Route::get('/remove/cart/{rowId}', 'CartController@removeCart');
Route::post('/cart/update/item', 'CartController@updateCart');
Route::get('/product/cart/view/{id}', 'CartController@quickViewProduct');
Route::post('/cart/insert/item', 'CartController@insertCart');

Route::get('/user/checkout', 'CartController@checkout')->name('user.checkout');
Route::get('/user/wishlist', 'CartController@wishlist')->name('user.wishlist');

Route::post('/user/wishlist/delete', 'WishlistController@deleteWishlist');
Route::post('/user/apply/coupon', 'CartController@coupon');
Route::get('/user/remove/coupon', 'CartController@couponRemove')->name('remove.coupon');


///Blog post route
Route::get('blog/post', 'BlogController@blog')->name('blog.post');
Route::get('blog/details/{id}', 'BlogController@blogDetails');

//Payment Step
// Route::get('payment/page', 'CartController@paymentPage')->name('payment.step');
Route::post('/user/payment/process', 'PaymentController@paymentProcess');
Route::get('/process/payment', 'PaymentController@paymentProcessView');

Route::post('/user/stripe/charge', 'PaymentController@stripeCharge')->name('stripe.charge');
// Route::get('/process/payment', function () {
//     return view('pages.payment.stripe');
// })->name('index');

//Product Pages
Route::get('/products/brands/{id}/{order?}', 'ProductController@productPage');
Route::get('/products/subs/{id}/{order?}', 'ProductController@productPageSub');
Route::get('/products/cat/{id}/{order?}', 'ProductController@productPageCat');

Route::get('/products/brands/{id}/{minprice?}/{maxprice?}/{order?}', 'ProductController@productPage');
Route::get('/products/subs/{id}/{minprice?}/{maxprice?}/{order?}', 'ProductController@productPageSub');
Route::get('/products/cat/{id}/{minprice?}/{maxprice?}/{order?}', 'ProductController@productPageCat');


//ADmin Order Route
Route::get('/admin/pading/order', 'Admin\OrderController@newOrder')->name('admin.neworder');
Route::get('/admin/view/order/{id}', 'Admin\OrderController@viewOrder');

Route::get('/admin/payment/accept/{id}', 'Admin\OrderController@acceptPayment');
Route::get('/admin/payment/cancel/{id}', 'Admin\OrderController@cancelPayment');

Route::get('/admin/accept/payment', 'Admin\OrderController@PaymentAccept')->name('admin.accept.payment');
Route::get('/admin/cancel/payment', 'Admin\OrderController@OrderCancel')->name('admin.cancel.payment');
Route::get('/admin/process/payment', 'Admin\OrderController@ProcessPayment')->name('admin.process.payment');
Route::get('/admin/success/payment', 'Admin\OrderController@SuccessPayment')->name('admin.success.payment');

Route::get('/admin/delivery/process/{id}', 'Admin\OrderController@deliveryProcess');
Route::get('/admin/delivery/done/{id}', 'Admin\OrderController@deliveryDone');


//SEP Setting route
Route::get('/admin/seo', 'Admin\OrderController@seo')->name('admin.seo')->middleware('authrole:other');
Route::post('/admin/seo/update', 'Admin\OrderController@seoUpdate')->middleware('authrole:other');

//Admin reporrt order route
Route::get('/admin/today/order', 'Admin\ReportController@todayOrder')->name('today.order');
Route::get('/admin/today/delivery', 'Admin\ReportController@todayDelivery')->name('today.delivery');
Route::get('/admin/report/month', 'Admin\ReportController@thisMonth')->name('this.month');
Route::get('/admin/report/search', 'Admin\ReportController@Search')->name('search.report');

Route::post('/admin/report/search/year', 'Admin\ReportController@SearchYear');
Route::post('/admin/report/search/month', 'Admin\ReportController@SearchMonth');
Route::post('/admin/report/search/date', 'Admin\ReportController@SearchDate');

//Tracking route
Route::post('/order/tracking', 'FrontController@orderTracking');
Route::get('/order/tracking/view/{code}', 'FrontController@orderTrackingView');


//Admin role route
Route::get('/admin/all/user', 'Admin\UserRoleController@UserRole')->name('admin.all.user');
Route::get('/admin/create/admin', 'Admin\UserRoleController@UserCreate')->name('create.admin');
Route::post('/admin/store/admin', 'Admin\UserRoleController@UserStore');
Route::post('/admin/delete/admin', 'Admin\UserRoleController@deleteAdmin');
Route::get('/admin/role/edit/{id}', 'Admin\UserRoleController@editAdmin');
Route::post('/admin/update/admin', 'Admin\UserRoleController@updateAdmin');

//admin site setting route
Route::get('/admin/site/setting', 'Admin\SettingController@siteSetting')->name('admin.site.setting');
Route::post('/admin/update/sitesetting', 'Admin\SettingController@updateSiteSetting');

//Return order route
Route::get('/success/list/', 'PaymentController@successList')->name('success.orderlist');
Route::get('/request/return/order/{id}', 'PaymentController@requestReturn');

Route::get('/admin/returnrequest', 'Admin\ReturnController@ReturnRequest')->name('admin.return.request');
Route::get('/admin/approve/return/{id}', 'Admin\ReturnController@approveReturn');
Route::get('/admin/all/return', 'Admin\ReturnController@allReturn')->name('admin.all.return');

//Rating rouyte
Route::post('/user/rating/product', 'RatingController@postRate');

//Admin stock route
Route::get('/admin/product/stock', 'Admin\UserRoleController@productStock')->name('admin.product.stock');

//Live search route
Route::get('/product/search', 'LiveSearch@searchLive');

//Contact page route
Route::get('/contact/page', 'ContactController@contact')->name('contact.page');
Route::post('/send/contact', 'ContactController@contactSend');


Route::get('/admin/all/message', 'ContactController@allMessage')->name('all.message')->middleware('authadmin');;
Route::get('/admin/view/contact/{id}', 'ContactController@viewMessage')->middleware('authadmin');

//Search route
Route::get('/search/product', 'FrontController@searchProduct')->name('product.search');

//Admin Slider route
Route::get('/admin/all/slider', 'Admin\SliderController@indexSlider')->name('admin.slider');
Route::get('/admin/extra/slider', 'Admin\SliderController@addExtraSlider')->name('admin.slider.extra');
Route::get('/admin/add/slider', 'Admin\SliderController@addSlider')->name('add.insert.slider');

Route::post('/admin/slider/upimg', 'Admin\SliderController@upImage');
Route::post('/admin/store/slider', 'Admin\SliderController@storeSlider');
Route::post('/admin/delete/slider', 'Admin\SliderController@deletaSlider');
Route::get('/admin/slider/edit/{id?}', 'Admin\SliderController@updateSlider');
Route::post('/admin/slider/update/{id?}', 'Admin\SliderController@postupdateSlider');


Route::post('/admin/store/extra/slider', 'Admin\SliderController@storeExtraSlider');
Route::get('/admin/slider/extra/edit/{id?}', 'Admin\SliderController@updateextraSlider');
Route::post('/admin/slider/extra/update/{id?}', 'Admin\SliderController@postupdateextraSlider');
//Active and Inactive Slider
Route::post('/admin/active/slider', 'Admin\SliderController@active');
Route::post('/admin/inactive/slider', 'Admin\SliderController@inactive');

