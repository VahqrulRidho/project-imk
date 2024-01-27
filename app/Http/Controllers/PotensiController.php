<?php

namespace App\Http\Controllers;

use App\Models\Potensi;
use Illuminate\Http\Request;

class PotensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $potensis = Potensi::orderBy('id', 'DESC')->get();
        return view('admin.potensi.index', [
            'potensis' => $potensis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.potensi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        Potensi::create($request->all());

        return redirect()->route('potensi')
            ->with('success', 'Potensi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Potensi  $potensi
     * @return \Illuminate\Http\Response
     */
    public function show(Potensi $potensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Potensi  $potensi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $potensi = Potensi::find($id);
        return view('admin.potensi.edit', [
            'potensi' => $potensi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Potensi  $potensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        request()->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ];

        Potensi::find($id)->update($data);

        return redirect()->route('potensi')
            ->with('success', 'Potensi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Potensi  $potensi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Potensi::find($id)->delete();

        return redirect()->route('potensi')
            ->with('success', 'Potensi deleted successfully');
    }
}
