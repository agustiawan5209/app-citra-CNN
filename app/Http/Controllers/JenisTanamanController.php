<?php

namespace App\Http\Controllers;

use App\Models\JenisTanaman;
use App\Http\Requests\StoreJenisTanamanRequest;
use App\Http\Requests\UpdateJenisTanamanRequest;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class JenisTanamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Tanaman/Index',[
            'tanaman'=> JenisTanaman::filter(Request::only('search', 'order'))->paginate(10),
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
    public function store(StoreJenisTanamanRequest $request)
    {
        $jenisTanaman = JenisTanaman::create($request->all());
        return redirect()->route('Tanaman.index')->with('message', 'Data Jenis Tanaman Obat Berhasil Di Tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisTanaman $jenisTanaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisTanaman $jenisTanaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJenisTanamanRequest $request, JenisTanaman $jenisTanaman)
    {
        $jenisTanaman = JenisTanaman::find(Request::input('slug'))->update($request->all());
        return redirect()->route('Tanaman.index')->with('message', 'Data Jenis Tanaman Obat Berhasil Di Tambah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisTanaman $jenisTanaman)
    {
        $jenisTanaman = JenisTanaman::find(Request::input('slug'))->delete();
        return redirect()->route('Tanaman.index')->with('message', 'Data Jenis Jenis Tanaman Obat Berhasil Di Hapus');
    }
}
