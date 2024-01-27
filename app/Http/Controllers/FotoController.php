<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fotos = Foto::orderBy('id', 'DESC')->get();
        return view('admin.foto.index', [
            'fotos' => $fotos,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.foto.create');
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
            'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $nama = $request->input('nama');
        $foto = $request->file('foto');

        //upload image
        $foto->storeAs('/gambar/foto/', $foto->hashName());


        Foto::create([
            'nama' => $nama,
            'foto'     => $foto->hashName(),
        ]);
        //redirect to index
        return redirect()->route('foto')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foto = Foto::find($id);
        return view('admin.foto.edit', [
            'foto' => $foto
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Foto::find($id);

        // Melakukan Validasi Data
        $this->validate($request, [
            'nama' => 'required',
            'foto' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $nama = $request->input('nama');
        $foto = $request->file('foto');

        if ($foto) {
            //upload image
            $foto->storeAs('/gambar/foto/', $foto->hashName());

            // Hapus Gambar lama
            Storage::exists('/gambar/foto/' . $data->foto);
            Storage::delete('/gambar/foto/' . $data->foto);

            $data->update([
                'nama' => $nama,
                'foto'     => $foto->hashName(),
            ]);
        } else {
            $data->update([
                'nama' => $nama,
            ]);
        }
        return redirect()->route('foto')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Foto::find($id);

        // Hapus Gambar lama
        Storage::exists('/gambar/foto/' . $data->foto);
        Storage::delete('/gambar/foto/' . $data->foto);

        // Hapus modul dari database
        $data->delete();

        return redirect()->route('foto')
            ->with('success', 'Foto deleted successfully');
    }
}
