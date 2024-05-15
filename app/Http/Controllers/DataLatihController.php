<?php

namespace App\Http\Controllers;

use Exception;
use Inertia\Inertia;
use App\Models\Aturan;
use App\Models\Attribut;
use App\Models\Kriteria;
use App\Models\DataLatih;
use App\Models\JenisTanaman;
use App\Models\KelasDataLatih;
use App\Models\DetailDataLatih;
use App\Models\HimpunanKriteria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreDataLatihRequest;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DataLatihController extends Controller
{
    public function index()
    {
        $tableName = 'data_latihs'; // Ganti dengan nama tabel yang Anda inginkan
        $columns = DB::getSchemaBuilder()->getColumnListing($tableName);


        return Inertia::render('DataLatih/Index', [
            'search' =>  Request::input('search'),
            'table_colums' => array_values(array_diff($columns, ['remember_token', 'password', 'email_verified_at', 'created_at', 'updated_at', 'user_id'])),
            'data' => DataLatih::filter(Request::only('search', 'order'))->paginate(10),
            'can' => [
                'add' => Auth::user()->can('add orangtua'),
                'edit' => Auth::user()->can('edit orangtua'),
                'show' => Auth::user()->can('show orangtua'),
                'delete' => Auth::user()->can('delete orangtua'),
            ]
        ]);
    }


    public function create()
    {
        return Inertia::render('DataLatih/Form', [
            'search' => Request::input('search'),
            'kelas' => JenisTanaman::all(),
        ]);
    }

    public function store(StoreDataLatihRequest $request)
    {

        return redirect()->route('DataLatih.index')->with('message', 'Berhasil Di Tambah');
    }



    public function destroy()
    {
        $data_latih = DataLatih::find(Request::input('slug'));
        $data_latih->delete();

        return redirect()->route('DataLatih.index')->with('message', 'Berhasil Di Hapus');
    }
}
