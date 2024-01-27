<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('admin.event.index', [
            'events' => $events
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Melakukan Validasi Data
        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'waktu' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $waktu = $request->input('waktu');
        $foto = $request->file('foto');

        //upload image
        $foto->storeAs('/gambar/event/', $foto->hashName());


        Event::create([
            'nama' => $nama,
            'deskripsi' => $deskripsi,
            'waktu' => $waktu,
            'foto'     => $foto->hashName(),
        ]);
        //redirect to index
        return redirect()->route('event')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.event.edit', [
            'event' => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = Event::find($id);

        $this->validate($request, [
            'nama' => 'required',
            'deskripsi' => 'required',
            'waktu' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $nama = $request->input('nama');
        $deskripsi = $request->input('deskripsi');
        $waktu = $request->input('waktu');
        $foto = $request->file('foto');

        if ($foto) {
            //upload image
            $foto->storeAs('/gambar/event/', $foto->hashName());

            // Hapus Gambar lama
            Storage::exists('/gambar/event/' . $data->foto);
            Storage::delete('/gambar/event/' . $data->foto);

            $data->update([
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'waktu' => $waktu,
                'foto'     => $foto->hashName(),
            ]);
        } else {
            $data->update([
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'waktu' => $waktu,
            ]);
        }
        return redirect()->route('event')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Event::find($id);

        // Hapus Gambar lama
        Storage::exists('/gambar/event/' . $data->foto);
        Storage::delete('/gambar/event/' . $data->foto);

        // Hapus modul dari database
        $data->delete();

        return redirect()->route('event')
            ->with('success', 'Event deleted successfully');
    }
}
