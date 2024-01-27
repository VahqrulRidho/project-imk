<?php

namespace App\Http\Controllers;

use App\Models\Visi;
use Illuminate\Http\Request;

class VisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visis = Visi::orderBy('id', 'DESC')->get();
        return view('admin.visi.index', [
            'visis' => $visis,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.visi.create');
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
            'visi' => 'required'
        ]);

        Visi::create($request->all());

        return redirect()->route('visi')
            ->with('success', 'Visi created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function show(Visi $visi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visi = Visi::find($id);
        return view('admin.visi.edit', [
            'visi' => $visi
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'visi' => 'required',
        ]);

        $data = [
            'visi' => $request->visi,
        ];

        Visi::find($id)->update($data);

        return redirect()->route('visi')
            ->with('success', 'Visi updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Visi  $visi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Visi::find($id)->delete();

        return redirect()->route('visi')
            ->with('success', 'Visi deleted successfully');
    }
}
