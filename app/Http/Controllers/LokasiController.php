<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lokasis = Lokasi::orderBy('id', 'DESC')->get();

        return view('admin.lokasi.index', [
            'lokasis' => $lokasis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lokasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $judul = $request->input('judul');
        $foto = $request->file('foto');

        //upload image
        $foto->storeAs('/gambar/lokasi/', $foto->hashName());


        Lokasi::create([
            'judul' => $judul,
            'foto'     => $foto->hashName(),
        ]);
        //redirect to index
        return redirect()->route('lokasi')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lokasi = Lokasi::find($id);
        return view('admin.lokasi.edit', [
            'lokasi' => $lokasi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = Lokasi::find($id);

        // Melakukan Validasi Data
        $this->validate($request, [
            'judul' => 'required',
            'foto' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $judul = $request->input('judul');
        $foto = $request->file('foto');

        if ($foto) {
            //upload image
            $foto->storeAs('/gambar/lokasi/', $foto->hashName());

            // Hapus Gambar lama
            Storage::exists('/gambar/lokasi/' . $data->foto);
            Storage::delete('/gambar/lokasi/' . $data->foto);

            $data->update([
                'judul' => $judul,
                'foto'     => $foto->hashName(),
            ]);
        } else {
            $data->update([
                'judul' => $judul,
            ]);
        }
        return redirect()->route('lokasi')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lokasi  $lokasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Lokasi::find($id);

        // Hapus Gambar lama
        Storage::exists('/gambar/lokasi/' . $data->foto);
        Storage::delete('/gambar/lokasi/' . $data->foto);

        // Hapus modul dari database
        $data->delete();

        return redirect()->route('lokasi')
            ->with('success', 'Lokasi deleted successfully');
    }
}
