<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destinasis = Destinasi::orderBy('id', 'DESC')->get();
        return view('admin.destinasi.index', [
            'destinasis' => $destinasis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.destinasi.create');
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
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $judul = $request->input('judul');
        $deskripsi = $request->input('deskripsi');
        $foto = $request->file('foto');

        //upload image
        $foto->storeAs('/gambar/destinasi/', $foto->hashName());


        Destinasi::create([
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'foto'     => $foto->hashName(),
        ]);
        //redirect to index
        return redirect()->route('destinasi')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function show(Destinasi $destinasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $destinasi = Destinasi::find($id);
        return view('admin.destinasi.edit', [
            'destinasi' => $destinasi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = Destinasi::find($id);

        // Melakukan Validasi Data
        $this->validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $judul = $request->input('judul');
        $deskripsi = $request->input('deskripsi');
        $foto = $request->file('foto');

        if ($foto) {
            //upload image
            $foto->storeAs('/gambar/destinasi/', $foto->hashName());

            // Hapus Gambar lama
            Storage::exists('/gambar/destinasi/' . $data->foto);
            Storage::delete('/gambar/destinasi/' . $data->foto);

            $data->update([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
                'foto'     => $foto->hashName(),
            ]);
        } else {
            $data->update([
                'judul' => $judul,
                'deskripsi' => $deskripsi,
            ]);
        }
        return redirect()->route('destinasi')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Destinasi  $destinasi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Destinasi::find($id);

        // Hapus Gambar lama
        Storage::exists('/gambar/destinasi/' . $data->foto);
        Storage::delete('/gambar/destinasi/' . $data->foto);

        // Hapus modul dari database
        $data->delete();

        return redirect()->route('destinasi')
            ->with('success', 'Destinasi deleted successfully');
    }
}
