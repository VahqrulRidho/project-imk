<?php

namespace App\Http\Controllers;

use App\Models\StrukturKepengurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturKepengurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strukturs = StrukturKepengurusan::orderBy('id', 'DESC')->get();

        return view('admin.struktur.index', [
            'strukturs' => $strukturs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.struktur.create');
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
        $foto->storeAs('/gambar/struktur/', $foto->hashName());


        StrukturKepengurusan::create([
            'judul' => $judul,
            'foto'     => $foto->hashName(),
        ]);
        //redirect to index
        return redirect()->route('struktur')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StrukturKepengurusan  $strukturKepengurusan
     * @return \Illuminate\Http\Response
     */
    public function show(StrukturKepengurusan $strukturKepengurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StrukturKepengurusan  $strukturKepengurusan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $struktur = StrukturKepengurusan::find($id);
        return view('admin.struktur.edit', [
            'struktur' => $struktur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StrukturKepengurusan  $strukturKepengurusan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = StrukturKepengurusan::find($id);

        // Melakukan Validasi Data
        $this->validate($request, [
            'judul' => 'required',
            'foto' => 'nullable|mimes:jpeg,png,jpg,svg|max:2048'
        ]);

        $judul = $request->input('judul');
        $foto = $request->file('foto');

        if ($foto) {
            //upload image
            $foto->storeAs('/gambar/struktur/', $foto->hashName());

            // Hapus Gambar lama
            Storage::exists('/gambar/struktur/' . $data->foto);
            Storage::delete('/gambar/struktur/' . $data->foto);

            $data->update([
                'judul' => $judul,
                'foto'     => $foto->hashName(),
            ]);
        } else {
            $data->update([
                'judul' => $judul,
            ]);
        }
        return redirect()->route('struktur')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StrukturKepengurusan  $strukturKepengurusan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = StrukturKepengurusan::find($id);

        // Hapus Gambar lama
        Storage::exists('/gambar/struktur/' . $data->foto);
        Storage::delete('/gambar/struktur/' . $data->foto);

        // Hapus modul dari database
        $data->delete();

        return redirect()->route('struktur')
            ->with('success', 'Struktur deleted successfully');
    }
}
