<?php

namespace App\Http\Controllers;

use App\Models\PaketWisata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketWisataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pakets = PaketWisata::all();
        return view('admin.paket.index', [
            'pakets' => $pakets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.paket.create');
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
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $nama = $request->input('nama');
        $harga = $request->input('harga');
        $deskripsi = $request->input('deskripsi');
        $foto = $request->file('foto');

        //upload image
        $foto->storeAs('/gambar/paket-wisata/', $foto->hashName());


        PaketWisata::create([
            'nama' => $nama,
            'harga' => $harga,
            'deskripsi' => $deskripsi,
            'foto'     => $foto->hashName(),
        ]);
        //redirect to index
        return redirect()->route('paket')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaketWisata  $paketWisata
     * @return \Illuminate\Http\Response
     */
    public function show(PaketWisata $paketWisata)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaketWisata  $paketWisata
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paket = PaketWisata::find($id);
        return view('admin.paket.edit', [
            'paket' => $paket
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaketWisata  $paketWisata
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = PaketWisata::find($id);

        // Melakukan Validasi Data
        $this->validate($request, [
            'nama' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $nama = $request->input('nama');
        $harga = $request->input('harga');
        $deskripsi = $request->input('deskripsi');
        $foto = $request->file('foto');

        if ($foto) {
            //upload image
            $foto->storeAs('/gambar/paket-wisata/', $foto->hashName());

            // Hapus Gambar lama
            Storage::exists('/gambar/paket-wisata/' . $data->foto);
            Storage::delete('/gambar/paket-wisata/' . $data->foto);

            $data->update([
                'nama' => $nama,
                'harga' => $harga,
                'deskripsi' => $deskripsi,
                'foto'     => $foto->hashName(),
            ]);
        } else {
            $data->update([
                'nama' => $nama,
                'harga' => $harga,
                'deskripsi' => $deskripsi,
            ]);
        }
        return redirect()->route('paket')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaketWisata  $paketWisata
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = PaketWisata::find($id);

        // Hapus Gambar lama
        Storage::exists('/gambar/paket-wisata/' . $data->foto);
        Storage::delete('/gambar/paket-wisata/' . $data->foto);

        // Hapus modul dari database
        $data->delete();

        return redirect()->route('paket')
            ->with('success', 'Paket deleted successfully');
    }
}
