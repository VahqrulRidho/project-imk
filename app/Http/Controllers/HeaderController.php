<?php

namespace App\Http\Controllers;

use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = Header::orderBy('id', 'DESC')->get();
        return view('admin.header.index', [
            'headers' => $headers,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.header.create');
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
        $foto->storeAs('/gambar/header/', $foto->hashName());


        Header::create([
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'foto'     => $foto->hashName(),
        ]);
        //redirect to index
        return redirect()->route('header')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function show(Header $header)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $header = Header::find($id);
        return view('admin.header.edit', [
            'header' => $header
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = Header::find($id);

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
            $foto->storeAs('/gambar/header/', $foto->hashName());

            // Hapus Gambar lama
            Storage::exists('/gambar/header/' . $data->foto);
            Storage::delete('/gambar/header/' . $data->foto);

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
        return redirect()->route('header')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Header  $header
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Header::find($id);

        // Hapus Gambar lama
        Storage::exists('/gambar/header/' . $data->foto);
        Storage::delete('/gambar/header/' . $data->foto);

        // Hapus modul dari database
        $data->delete();

        return redirect()->route('header')
            ->with('success', 'Header deleted successfully');
    }
}
