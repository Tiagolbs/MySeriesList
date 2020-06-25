<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Serie;

class SeriesController extends Controller
{

    public function index() {
        $series = Serie::All();
        return view('series.index', ['series' => $series]);
    }

    public function create() {
        return view('series.create');
    }

    public function store(Request $request) {
        $new_serie = $request->all();
        Serie::Create($new_serie);

        return redirect()->route('series');
    }

    public function edit($id) {
        $serie = Serie::find($id);
        return view('series.edit', compact('serie'));
    }

    public function update(Request $request, $id) {
        Serie::find($id)->update($request->all());
        return redirect()->route('series');
    }
}
