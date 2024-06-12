<?php

use App\Events\MessageStatus;
use App\Http\Controllers\Admin\PemesananController;
use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('home');

// Route::get('/', 'HomeController@index') {
//     MessageStatus::dispatch();

//     return view('home');
// });
Route::get('details/{id}', 'DetailController@detail')->name('detail-kost');
Route::post('details/{id}/confirmation', 'BookingController@confirmation')->name('confirmation');
Route::post('details/{id}/book', 'BookingController@booking')->name('booking');
Route::post('callback', 'BookingController@callback')->name('midtrans-callback');
Route::get('success', 'BookingController@success')->name('success');
Route::get('gagal', 'BookingController@gagal')->name('gagal');
Route::get('invoice', 'BookingController@show')->name('upload');
Route::post('upload/{id}', 'BookingController@upload')->name('upload-pembayaran');

Route::prefix('user')
    ->middleware(['auth', 'role:user', 'verified'])
    ->group(function () {
        Route::get('change-pass', 'ChangePassController@change')->name('change-pass');
        Route::post('change-pass', 'ChangePassController@update')->name('change-pass-user-update');

        Route::get('user-transaksi', 'UserBookingController@index')->name('user-transaksi');
        Route::get('lanjut-sewa', 'UserBookingController@lanjut')->name('lanjut-sewa');
        Route::post('user-transaksi', 'UserBookingController@save')->name('save-lanjut-sewa');
        Route::get('user-transaksi/invoice_pdf/{id}', 'UserBookingController@invoice')->name('user-invoice');
        Route::post('user-transaksi/{id}', 'UserBookingController@upload')->name('user-transaksi-upload');
        Route::get('user-transaksi/{id}', 'UserBookingController@cancel')->name('user-transaksi-cancel');
        Route::get('user-transaksi/detail/{id}', 'UserBookingController@detail')->name('user-transaksi-detail');

        Route::get('perpanjang/buat/{id}', 'PerpanjangController@lanjut')->name('perpanjang-sewa');
        Route::post('perpanjang/{id}', 'PerpanjangController@store')->name('save-perpanjang-sewa');

        Route::get('review', 'UserReviewController@review')->name('review-user');
        Route::post('review/{id}', 'UserReviewController@update')->name('review-user-update');

        Route::get('view-profil', 'ProfilUserController@index')->name('profil-user');
        Route::post('view-profil', 'ProfilUserController@avatar')->name('change-avatar');
        Route::get('change-profil-user', 'ProfilUserController@user')->name('change-profil-user');
        Route::post('change-profil-user/{id}', 'ProfilUserController@update')->name('change-profil-user-redirect');
    });

Route::prefix('admin')
    ->middleware(['auth', 'role:admin', 'verified'])
    ->group(function () {
        Route::get('/', 'Admin\DashboardController@index')->name('admin-dashboard');

        Route::resource('fasilitas', 'Admin\FasilitasController');

        Route::get('booking', 'Admin\PemesananController@index')->name('transaksi');
        Route::get('booking/sukses', 'Admin\PemesananController@sukses')->name('sukses');
        Route::get('booking/menunggu', 'Admin\PemesananController@menunggu')->name('menunggu');
        Route::get('booking/batal', 'Admin\PemesananController@cancel')->name('dibatalkan');
        Route::post('booking/{id}', 'Admin\PemesananController@status')->name('status');
        Route::put('booking/{id}', 'Admin\PemesananController@batal')->name('batal');
        Route::get('booking/{id}/edit', 'Admin\PemesananController@edit');
        Route::put('booking/{id}/edit', 'Admin\PemesananController@update');
        Route::get('booking/detail/{id}', 'Admin\PemesananController@detail')->name('detail-booking');

        Route::get('booking/create', 'Admin\PemesananController@create')->name('transaksi.create');
        Route::get('/pesan-kamar/{tipe_kamar}', 'Admin\PemesananController@formPesanKamar')->name('pesan-kamar');
        Route::post('/confirmation/{tipe_kamar_id}', 'Admin\PemesananController@confirmation')->name('confirmation-kamar');
        Route::post('/confirmation/{tipe_kamar_id}', 'Admin\PemesananController@confirmation')->name('confirmation-kamar');
        Route::post('/admin/booking', [PemesananController::class, 'booking'])->name('bookingadmin');
        Route::get('/pemesanansukses', [PemesananController::class, 'sukses'])->name('pemesanansukses');

        Route::get('tagihan', 'Admin\TagihanController@index')->name('tagihan');
        Route::get('tagihan/buat/{id}', 'Admin\TagihanController@lanjut')->name('buat-tagihan');
        Route::post('tagihan/{id}', 'Admin\TagihanController@store')->name('store-tagihan');

        Route::get('pemasukan', 'Admin\PemasukanController@index')->name('pemasukan');
        Route::post('pemasukan', 'Admin\PemasukanController@search')->name('search');
        Route::get('pemasukan/pemasukan-pdf', 'Admin\PemasukanController@pdf')->name('pemasukan-pdf');
        Route::get('pemasukan/excelExport', 'Admin\PemasukanController@exportExcel')->name('pemasukan-excel');

        Route::resource('pengeluaran', 'Admin\PengeluaranController');
        Route::get('pdf', 'Admin\PengeluaranController@ex_pdf')->name('pengeluaran-pdf');
        Route::get('excel', 'Admin\PengeluaranController@excel')->name('pengeluaran-excel');

        Route::get('user', 'Admin\UserController@index')->name('user');
        Route::get('user/aktif', 'Admin\UserController@aktif')->name('user-aktif');
        Route::get('user/nonAktif', 'Admin\UserController@nonAktif')->name('user-non-aktif');
        Route::post('user/nonAktif/{id}', 'Admin\UserController@activate')->name('aktifkan-user');
        Route::put('user/aktif/{id}', 'Admin\UserController@nonActivate')->name('nonaktifkan-user');
        Route::get('user/create', 'Admin\UserController@create')->name('buat-user');
        Route::post('user', 'Admin\UserController@store')->name('save-user');
        Route::delete('user/{id}', 'Admin\UserController@destroy')->name('delete-user');
        Route::get('user/detail/{id}', 'Admin\UserController@show')->name('detail-user');
        Route::get('user/changeStatus', 'Admin\UserController@changeStatus')->name('change-status');
        Route::get('user/detail/newPassword/{id}', 'Admin\UserController@newPassword')->name('new-password');
        Route::post('user/detail/newPassword/{id}', 'Admin\UserController@newPasswordd')->name('save-new-password');

        Route::resource('reviews', 'Admin\ReviewsController');

        Route::get('change-pass', 'Admin\ChangePasswordController@edit')->name('change-pass-edit');
        Route::post('change-pass', 'Admin\ChangePasswordController@update')->name('change-pass-update');
        Route::get('change-profil', 'Admin\ChangeProfilController@profil')->name('change-profil');
        Route::post('change-profil/{id}', 'Admin\ChangeProfilController@update')->name('change-profil-redirect');

        Route::resource('tipe', 'Admin\TipeKamarController');
        Route::post('tipe/galeri/upload', 'Admin\TipeKamarController@uploadGaleri')->name('kamar-galeri-upload');
        Route::get('tipe/galeri/delete/{id}', 'Admin\TipeKamarController@deleteGaleri')->name('kamar-galeri-delete');

        Route::prefix('tipe')
            ->middleware(['auth', 'role:admin', 'verified'])
            ->group(function () {
                Route::get('/{id}/kamar', 'Admin\KamarController@index');
                Route::get('/{id}/kamar/create', 'Admin\KamarController@create');
                Route::post('/{id}/kamar', 'Admin\KamarController@store');
                Route::get('/{id}/kamar/{kamar_id}/edit', 'Admin\KamarController@edit');
                Route::put('/{id}/kamar/{kamar_id}/edit', 'Admin\KamarController@update');
                Route::delete('/{id}/kamar/{kamar_id}', 'Admin\KamarController@destroy');
            });
    });
Route::get('/verify', function () {
    return view('auth/verify');
});
Auth::routes(['verify' => true]);
