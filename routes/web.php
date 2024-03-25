<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\AccountManageController;
use App\Http\Controllers\Backend\CarCategoryController;
use App\Http\Controllers\Backend\CarDetailController;
use App\Http\Controllers\Backend\NewsCategoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\BookingCarController;
use App\Http\Controllers\frontend\HomePageController;

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

Route::get('/',  [HomePageController::class, 'HomePageView'])->name('home.page');
Route::post('/home/getprice',  [HomePageController::class, 'GetPrice']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('update.password');


    // Manager User
    Route::get('/list/user', [AccountManageController::class, 'ListUser'])->name('manage.users.list');
    Route::get('/delete/user/{id}', [AccountManageController::class, 'DeleteUser'])->name('delete.account.user');
    Route::get('/edit/user/{id}', [AccountManageController::class, 'EditUser'])->name('edit.account.user');
    Route::post('/user/store', [AccountManageController::class, 'StoreUser'])->name('admin.user.store');

    

    // Category Car 

    Route::controller(CarCategoryController::class)->group(function(){
        Route::get('/category/list/car',  'CarCategoryList')->name('car.category.list');
        Route::get('/category/add/car',  'CarCategoryAdd')->name('car.category.add');
        Route::post('/category/store/car',  'CarCategoryStore')->name('car.category.store');
        Route::get('/category/edit/car/{id}',  'CarCategoryEdit')->name('car.category.edit');
        Route::post('/category/update/car',  'CarCategoryUpdate')->name('car.category.update');
        Route::get('/category/delete/car/{id}',  'CarCategoryDelete')->name('car.category.delete');
    });
    

    // Car Detail  
    Route::controller(CarDetailController::class)->group(function(){
        Route::get('/car/detail/list',  'CarDetailList')->name('car.detail.list');
        Route::get('/car/detail/add',  'CarDetailAdd')->name('car.detail.add');
        Route::post('/car/detail/store',  'CarDetailStore')->name('car.detail.store');
        Route::get('/car/detail/edit/{id}',  'CarDetailEdit')->name('car.detail.edit');
        Route::post('/car/detail/update',  'CarDetailUpdate')->name('car.detail.update');
        Route::get('/car/detail/delete/{id}',  'CarDetailDelete')->name('car.detail.delete');
        
    });

    // News Category

    Route::controller(NewsCategoryController::class)->group(function(){
        Route::get('/news/category/list',  'NewsCategoryList')->name('news.category.list');
        Route::get('/news/category/add',  'NewsCategoryAdd')->name('news.category.add');
        Route::post('/news/category/store',  'NewsCategoryStore')->name('news.category.store');
        Route::get('/news/category/edit/{id}',  'NewsCategoryEdit')->name('news.category.edit');
        Route::post('/news/category/update',  'NewsCategoryUpdate')->name('news.category.update');
        Route::get('/news/category/delete/{id}',  'NewsCategoryDelete')->name('news.category.delete');

    });

    // News

    Route::controller(NewsController::class)->group(function(){
        Route::get('/news/list',  'NewsList')->name('news.list');
        Route::get('/news/add',  'NewsAdd')->name('news.add');
        Route::post('/news/store',  'NewsStore')->name('news.store');
        Route::get('/news/detail/{id}',  'NewsDetail')->name('new.detail');
        Route::get('/news/edit/{id}',  'NewsEdit')->name('new.edit');
        Route::get('/news/delete/{id}',  'NewsDelete')->name('new.delete');
        
    });
    
    // BookingCar

    Route::controller(BookingCarController::class)->group(function(){
        Route::get('/booking/car/list',  'BookingCarList')->name('booking.car.list');

        
    });
});

Route::middleware(['auth', 'role:author'])->group(function () {
    Route::get('/author/dashboard', [AuthorController::class, 'AuthorDashboard'])->name('author.dashboard');
    Route::get('/author/logout', [AuthorController::class, 'AuthorDestroy'])->name('author.logout');
    Route::get('/author/profile', [AuthorController::class, 'AuthorProfile'])->name('author.profile');
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/admin/register', [AdminController::class, 'AdminRegister'])->name('admin.register');