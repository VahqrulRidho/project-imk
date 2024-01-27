<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use App\Models\Event;
use App\Models\Foto;
use App\Models\Header;
use App\Models\PaketWisata;
use App\Models\Vidio;
use Illuminate\Http\Request;

class FrontEndController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinasis = Destinasi::orderBy('id', 'DESC')->limit('3')->get();
        $events = Event::orderBy('id', 'DESC')->limit('4')->get();
        $fotos = Foto::orderBy('id', 'DESC')->limit('6')->get();
        $headers = Header::orderby('id', 'DESC')->limit('3')->get();
        return view('frontend.index', [
            'headers' => $headers,
            'destinasis' => $destinasis,
            'events' => $events,
            'fotos' => $fotos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function destinasi()
    {
        $destinasis = Destinasi::orderBy('id', 'DESC')->get();
        return view('frontend.destinasi', [
            'destinasis' => $destinasis
        ]);
    }
    public function detailDestinasi($id)
    {
        $destinasi = Destinasi::find($id);
        return view('frontend.detail-destinasi', [
            'destinasi' => $destinasi
        ]);
    }

    public function detailEvent($id)
    {
        $event = Event::find($id);
        return view('frontend.detail-event', [
            'event' => $event
        ]);
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function event()
    {
        $events = Event::orderBy('id', 'DESC')->get();
        return view('frontend.event', [
            'events' => $events
        ]);
    }

    public function foto()
    {
        $fotos = Foto::orderBy('id', 'DESC')->get();
        return view('frontend.foto', [
            'fotos' => $fotos
        ]);
    }

    public function lokasi()
    {
        return view('frontend.lokasi');
    }

    public function paketWisata()
    {
        $pakets = PaketWisata::orderBy('id', 'DESC')->get();
        return view('frontend.paket-wisata', [
            'pakets' => $pakets
        ]);
    }

    public function detailPaket($id)
    {
        $paket = PaketWisata::find($id);
        return view('frontend.detail-paket', [
            'paket' => $paket
        ]);
    }
    public function potensi()
    {
        return view('frontend.potensi');
    }

    public function sejarah()
    {
        return view('frontend.sejarah');
    }

    public function strukturKepengurusan()
    {
        return view('frontend.struktur-kepengurusan');
    }

    public function vidio()
    {
        $vidios = Vidio::orderBy('id', 'DESC')->get();
        return view('frontend.vidio', [
            'vidios' => $vidios
        ]);
    }

    public function visiMisi()
    {
        return view('frontend.visi-misi');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
