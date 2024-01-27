<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DestinasiController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\MisiController;
use App\Http\Controllers\PaketWisataController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PotensiController;
use App\Http\Controllers\SejarahController;
use App\Http\Controllers\StrukturKepengurusanController;
use App\Http\Controllers\VidioController;
use App\Http\Controllers\VisiController;
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

// routing gambar
Route::get('gambar/{folder}/{filename}', function ($folder, $filename) {
    $path = storage_path('app/gambar/' . $folder . '/' . $filename);

    if (!file_exists($path)) {
        abort(500);
    }

    $file = file_get_contents($path);
    $type = mime_content_type($path);

    return response($file)->header('Content-Type', $type);
})->name('show-gambar');


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontEndController::class, 'index'])->name('landing.page');
Route::get('/destinasi', [FrontEndController::class, 'destinasi'])->name('frontend.destinasi');
Route::get('/paket-wisata', [FrontEndController::class, 'paketWisata'])->name('frontend.paket.wisata');
Route::get('/event', [FrontEndController::class, 'event'])->name('frontend.event');
Route::get('/foto', [FrontEndController::class, 'foto'])->name('frontend.foto');
Route::get('/vidio', [FrontEndController::class, 'vidio'])->name('frontend.vidio');
Route::get('/contact', [FrontEndController::class, 'contact'])->name('frontend.contact');
Route::get('/lokasi', [FrontEndController::class, 'lokasi'])->name('frontend.lokasi');
Route::get('/potensi', [FrontEndController::class, 'potensi'])->name('frontend.potensi');
Route::get('/struktur-kepengurusan', [FrontEndController::class, 'strukturKepengurusan'])->name('frontend.struktur.kepengurusan');
Route::get('/visi-misi', [FrontEndController::class, 'visiMisi'])->name('frontend.visi.misi');
Route::get('/sejarah-pengelolaan', [FrontEndController::class, 'sejarah'])->name('frontend.sejarah');

Route::get('/detail-destinasi/{id}', [FrontEndController::class, 'detailDestinasi'])->name('detail.destinasi');
Route::get('/detail-event/{id}', [FrontEndController::class, 'detailEvent'])->name('detail.event');
Route::get('/detail-paket-wisata/{id}', [FrontEndController::class, 'detailPaket'])->name('detail.paket');

// Kirim Pesan
Route::post('admin/pesan/store', [PesanController::class, 'store'])->name('pesan.store');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/change-password', [App\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('update-password');

    // Visi
    Route::get('admin/visi', [VisiController::class, 'index'])->name('visi');
    Route::get('admin/visi/create', [VisiController::class, 'create'])->name('visi.create');
    Route::get('admin/visi/edit/{id}', [VisiController::class, 'edit'])->name('visi.edit');
    Route::patch('admin/visi/{id}', [VisiController::class, 'update'])->name('visi.update');
    Route::post('admin/visi/store', [VisiController::class, 'store'])->name('visi.store');
    Route::delete('admin/visi/destroy/{id}', [VisiController::class, 'destroy'])->name('visi.destroy');

    // Misi
    Route::get('admin/misi', [MisiController::class, 'index'])->name('misi');
    Route::get('admin/misi/create', [MisiController::class, 'create'])->name('misi.create');
    Route::get('admin/misi/edit/{id}', [MisiController::class, 'edit'])->name('misi.edit');
    Route::patch('admin/misi/{id}', [MisiController::class, 'update'])->name('misi.update');
    Route::post('admin/misi/store', [MisiController::class, 'store'])->name('misi.store');
    Route::delete('admin/misi/destroy/{id}', [MisiController::class, 'destroy'])->name('misi.destroy');

    // Header
    Route::get('admin/header', [HeaderController::class, 'index'])->name('header');
    Route::get('admin/header/create', [HeaderController::class, 'create'])->name('header.create');
    Route::get('admin/header/edit/{id}', [HeaderController::class, 'edit'])->name('header.edit');
    Route::patch('admin/header/{id}', [HeaderController::class, 'update'])->name('header.update');
    Route::post('admin/header/store', [HeaderController::class, 'store'])->name('header.store');
    Route::delete('admin/header/destroy/{id}', [HeaderController::class, 'destroy'])->name('header.destroy');

    // Destinasi
    Route::get('admin/destinasi', [DestinasiController::class, 'index'])->name('destinasi');
    Route::get('admin/destinasi/create', [DestinasiController::class, 'create'])->name('destinasi.create');
    Route::get('admin/destinasi/edit/{id}', [DestinasiController::class, 'edit'])->name('destinasi.edit');
    Route::patch('admin/destinasi/{id}', [DestinasiController::class, 'update'])->name('destinasi.update');
    Route::post('admin/destinasi/store', [DestinasiController::class, 'store'])->name('destinasi.store');
    Route::delete('admin/destinasi/destroy/{id}', [DestinasiController::class, 'destroy'])->name('destinasi.destroy');

    // Destinasi
    Route::get('admin/paket-wisata', [PaketWisataController::class, 'index'])->name('paket');
    Route::get('admin/paket-wisata/create', [PaketWisataController::class, 'create'])->name('paket.create');
    Route::get('admin/paket-wisata/edit/{id}', [PaketWisataController::class, 'edit'])->name('paket.edit');
    Route::patch('admin/paket-wisata/{id}', [PaketWisataController::class, 'update'])->name('paket.update');
    Route::post('admin/paket-wisata/store', [PaketWisataController::class, 'store'])->name('paket.store');
    Route::delete('admin/paket-wisata/destroy/{id}', [PaketWisataController::class, 'destroy'])->name('paket.destroy');


    // Event
    Route::get('admin/event', [EventController::class, 'index'])->name('event');
    Route::get('admin/event/create', [EventController::class, 'create'])->name('event.create');
    Route::get('admin/event/edit/{id}', [EventController::class, 'edit'])->name('event.edit');
    Route::patch('admin/event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::post('admin/event/store', [EventController::class, 'store'])->name('event.store');
    Route::delete('admin/event/destroy/{id}', [EventController::class, 'destroy'])->name('event.destroy');


    // Foto
    Route::get('admin/foto', [FotoController::class, 'index'])->name('foto');
    Route::get('admin/foto/create', [FotoController::class, 'create'])->name('foto.create');
    Route::get('admin/foto/edit/{id}', [FotoController::class, 'edit'])->name('foto.edit');
    Route::patch('admin/foto/{id}', [FotoController::class, 'update'])->name('foto.update');
    Route::post('admin/foto/store', [FotoController::class, 'store'])->name('foto.store');
    Route::delete('admin/foto/destroy/{id}', [FotoController::class, 'destroy'])->name('foto.destroy');

    // Video
    Route::get('admin/vidio', [VidioController::class, 'index'])->name('vidio');
    Route::get('admin/vidio/create', [VidioController::class, 'create'])->name('vidio.create');
    Route::get('admin/vidio/edit/{id}', [VidioController::class, 'edit'])->name('vidio.edit');
    Route::patch('admin/vidio/{id}', [VidioController::class, 'update'])->name('vidio.update');
    Route::post('admin/vidio/store', [VidioController::class, 'store'])->name('vidio.store');
    Route::delete('admin/vidio/destroy/{id}', [VidioController::class, 'destroy'])->name('vidio.destroy');

    // Contact
    Route::get('admin/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('admin/contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::get('admin/contact/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
    Route::patch('admin/contact/{id}', [ContactController::class, 'update'])->name('contact.update');
    Route::post('admin/contact/store', [ContactController::class, 'store'])->name('contact.store');
    Route::delete('admin/contact/destroy/{id}', [ContactController::class, 'destroy'])->name('contact.destroy');

    // Lokasi
    Route::get('admin/lokasi', [LokasiController::class, 'index'])->name('lokasi');
    Route::get('admin/lokasi/create', [LokasiController::class, 'create'])->name('lokasi.create');
    Route::get('admin/lokasi/edit/{id}', [LokasiController::class, 'edit'])->name('lokasi.edit');
    Route::patch('admin/lokasi/{id}', [LokasiController::class, 'update'])->name('lokasi.update');
    Route::post('admin/lokasi/store', [LokasiController::class, 'store'])->name('lokasi.store');
    Route::delete('admin/lokasi/destroy/{id}', [LokasiController::class, 'destroy'])->name('lokasi.destroy');

    // Struktur
    Route::get('admin/struktur-kepengurusan', [StrukturKepengurusanController::class, 'index'])->name('struktur');
    Route::get('admin/struktur-kepengurusan/create', [StrukturKepengurusanController::class, 'create'])->name('struktur.create');
    Route::get('admin/struktur-kepengurusan/edit/{id}', [StrukturKepengurusanController::class, 'edit'])->name('struktur.edit');
    Route::patch('admin/struktur-kepengurusan/{id}', [StrukturKepengurusanController::class, 'update'])->name('struktur.update');
    Route::post('admin/struktur-kepengurusan/store', [StrukturKepengurusanController::class, 'store'])->name('struktur.store');
    Route::delete('admin/struktur-kepengurusan/destroy/{id}', [StrukturKepengurusanController::class, 'destroy'])->name('struktur.destroy');

    // Potensi
    Route::get('admin/potensi', [PotensiController::class, 'index'])->name('potensi');
    Route::get('admin/potensi/create', [PotensiController::class, 'create'])->name('potensi.create');
    Route::get('admin/potensi/edit/{id}', [PotensiController::class, 'edit'])->name('potensi.edit');
    Route::patch('admin/potensi/{id}', [PotensiController::class, 'update'])->name('potensi.update');
    Route::post('admin/potensi/store', [PotensiController::class, 'store'])->name('potensi.store');
    Route::delete('admin/potensi/destroy/{id}', [PotensiController::class, 'destroy'])->name('potensi.destroy');

    // Sejarah
    Route::get('admin/sejarah', [SejarahController::class, 'index'])->name('sejarah');
    Route::get('admin/sejarah/create', [SejarahController::class, 'create'])->name('sejarah.create');
    Route::get('admin/sejarah/edit/{id}', [SejarahController::class, 'edit'])->name('sejarah.edit');
    Route::patch('admin/sejarah/{id}', [SejarahController::class, 'update'])->name('sejarah.update');
    Route::post('admin/sejarah/store', [SejarahController::class, 'store'])->name('sejarah.store');
    Route::delete('admin/sejarah/destroy/{id}', [SejarahController::class, 'destroy'])->name('sejarah.destroy');

    // Contact
    Route::get('admin/pesan', [PesanController::class, 'index'])->name('pesan');
    Route::delete('admin/pesan/destroy/{id}', [PesanController::class, 'destroy'])->name('pesan.destroy');
});
