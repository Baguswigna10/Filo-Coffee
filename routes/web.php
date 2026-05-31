<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\PSReservationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminReservationController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\MidtransController;
use Illuminate\Support\Facades\Route;

// ============================================================
// AUTH ROUTES
// ============================================================
Route::get('/login',    [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login',   [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register',[LoginController::class, 'register']);
Route::post('/logout',  [LoginController::class, 'logout'])->name('logout');

// ============================================================
// PUBLIC ROUTES
// ============================================================
Route::get('/',        [HomeController::class, 'index'])->name('home');
Route::get('/about',   [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact',[HomeController::class, 'sendContact'])->name('contact.send');

// Menu
Route::get('/menu',         [MenuController::class, 'index'])->name('menu');
Route::get('/menu/{menu}',  [MenuController::class, 'show'])->name('menu.show');

// Shop Beans
Route::get('/shop',         [ProductController::class, 'index'])->name('shop');
Route::get('/shop/{product}', [ProductController::class, 'show'])->name('shop.show');

// Membership
Route::get('/membership',   [MemberController::class, 'index'])->name('member');
Route::post('/membership/register', [MemberController::class, 'register'])->name('member.register');

// Services
Route::get('/services',     [ServiceController::class, 'index'])->name('services');

// News/Magazine
Route::get('/news',         [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}',  [NewsController::class, 'show'])->name('news.show');

// PlayStation Info (public view)
Route::get('/playstation', [PSReservationController::class, 'index'])->name('playstation.index');

// ============================================================
// MIDTRANS ROUTES
// ============================================================
// Webhook from Midtrans (no CSRF - exempted in bootstrap/app.php)
Route::post('/midtrans/notification', [MidtransController::class, 'notification'])
    ->name('midtrans.notification');

// Re-generate snap token for existing order (authenticated)
Route::post('/midtrans/pay/{order}', [MidtransController::class, 'pay'])
    ->middleware('auth')
    ->name('midtrans.pay');

// ============================================================
// AUTHENTICATED ROUTES
// ============================================================
Route::middleware(['auth'])->group(function () {

    // Cart
    Route::get('/cart',                  [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add',             [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/{cartId}',       [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cartId}',      [CartController::class, 'remove'])->name('cart.remove');

    // Checkout & Orders
    Route::get('/checkout',              [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout',             [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/orders',                [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}',        [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/proof', [OrderController::class, 'uploadPaymentProof'])->name('orders.proof');

    // Table Reservation
    Route::get('/reservation',           [ReservationController::class, 'index'])->name('reservation.index');
    Route::post('/reservation',          [ReservationController::class, 'store'])->name('reservation.store');
    Route::patch('/reservation/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');

    // PlayStation Booking
    Route::post('/playstation',          [PSReservationController::class, 'store'])->name('playstation.store');
    Route::patch('/playstation/{psReservation}/cancel', [PSReservationController::class, 'cancel'])->name('playstation.cancel');
});

// ============================================================
// ADMIN ROUTES
// ============================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Menu CRUD
    Route::resource('menus', AdminMenuController::class)->except(['show']);

    // Products CRUD
    Route::resource('products', AdminProductController::class)->except(['show']);

    // Orders
    Route::get('orders',                             [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}',                     [AdminOrderController::class, 'show'])->name('orders.show');
    Route::patch('orders/{order}/status',            [AdminOrderController::class, 'updateStatus'])->name('orders.status');

    // Table Reservations
    Route::get('reservations/tables',                [AdminReservationController::class, 'tableIndex'])->name('reservations.tables');
    Route::patch('reservations/tables/{tableReservation}/status', [AdminReservationController::class, 'tableUpdateStatus'])->name('reservations.tables.status');

    // PS Reservations
    Route::get('reservations/playstation',           [AdminReservationController::class, 'psIndex'])->name('reservations.ps');
    Route::patch('reservations/playstation/{psReservation}/status', [AdminReservationController::class, 'psUpdateStatus'])->name('reservations.ps.status');

    // POS (Kasir Mode)
    Route::get('pos',           [PosController::class, 'index'])->name('pos.index');
    Route::post('pos',          [PosController::class, 'store'])->name('pos.store');
    Route::get('pos/history',   [PosController::class, 'history'])->name('pos.history');
    Route::get('pos/history/{id}', [PosController::class, 'show'])->name('pos.show');

    // Page Management
    Route::get('pages',         [AdminPageController::class, 'index'])->name('pages.index');
    Route::patch('pages/{page}/toggle', [AdminPageController::class, 'toggle'])->name('pages.toggle');
});

