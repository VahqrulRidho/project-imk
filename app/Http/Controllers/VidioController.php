<?php

namespace App\Http\Controllers;

use App\Models\Vidio;
use Illuminate\Http\Request;

class VidioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vidios = Vidio::orderBy('id', 'DESC')->get();
        return view('admin.vidio.index', [
            'vidios' => $vidios,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vidio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'link_youtube' => 'required'
        ]);

        $judul = $request->input('judul');

        $url_parts = parse_url($request->input('link_youtube'));

        if (isset($url_parts['query'])) {
            parse_str($url_parts['query'], $query_params);
            // $video_embed = "https://www.youtube.com/embed/" . $query_params['v'];
            $video_embed = isset($query_params['v']) ? "https://www.youtube.com/embed/" . $query_params['v'] : '';
        }

        Vidio::create([
            'judul' => $judul,
            'link_youtube' => $video_embed,
        ]);

        return redirect()->route('vidio')
            ->with('success', 'Video created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function show(Vidio $vidio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vidio = Vidio::find($id);
        return view('admin.vidio.edit', [
            'vidio' => $vidio
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $data = Vidio::find($id);
        $request->validate([
            'judul' => 'required',
            'link_youtube' => 'required'
        ]);

        $judul = $request->input('judul');
        $video_embed = $request->input('link_youtube');
        $url_parts = parse_url($request->input('link_youtube'));

        if (isset($url_parts['query'])) {
            parse_str($url_parts['query'], $query_params);
            $video_embed = isset($query_params['v']) ? "https://www.youtube.com/embed/" . $query_params['v'] : '';
        }

        $data->update([
            'judul' => $judul,
            'link_youtube' => $video_embed,
        ]);

        return redirect()->route('vidio')
            ->with('success', 'Video created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vidio  $vidio
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vidio::find($id)->delete();

        return redirect()->route('vidio')
            ->with('success', 'Vidio deleted successfully');
    }
}
