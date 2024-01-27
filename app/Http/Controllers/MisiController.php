<?php

namespace App\Http\Controllers;

use App\Models\Misi;
use Illuminate\Http\Request;

class MisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $misis = Misi::orderBy('id', 'DESC')->get();
        return view('admin.misi.index', [
            'misis' => $misis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.misi.create');
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
            'misi' => 'required'
        ]);

        Misi::create($request->all());

        return redirect()->route('misi')
            ->with('success', ' Misi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Misi  $misi
     * @return \Illuminate\Http\Response
     */
    public function show(Misi $misi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Misi  $misi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $misi = Misi::find($id);
        return view('admin.misi.edit', [
            'misi' => $misi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Misi  $misi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Misi $misi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Misi  $misi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Misi $misi)
    {
        //
    }
}
