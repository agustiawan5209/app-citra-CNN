<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreKriteriaRequest;
use App\Http\Requests\UpdateKriteriaRequest;
use Inertia\Inertia;

class KriteriaController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Kriteria/Index',[
            'kriteria'=> Kriteria::filter(Request::only('search', 'order'))->paginate(10),
            'search'=> Request::input('search'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKriteriaRequest $request)
    {
        $kriteria = Kriteria::create($request->all());
        return redirect()->route('Kriteria.index')->with('message', 'Data Jenis Kriteria Obat Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKriteriaRequest $request, Kriteria $kriteria)
    {
        $kriteria = Kriteria::find(Request::input('slug'))->update($request->all());
        return redirect()->route('Kriteria.index')->with('message', 'Data Jenis Kriteria Obat Berhasil Di Tambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria)
    {
        $kriteria = Kriteria::find(Request::input('slug'))->delete();
        return redirect()->route('Kriteria.index')->with('message', 'Data Jenis Kriteria Obat Berhasil Di Hapus');
    }
}
