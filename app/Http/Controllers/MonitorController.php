<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Carbon\Carbon;

use App\Models\Barang;
use App\Models\Barangsp;
use App\Models\Kanibal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('monitor.index', [
            'barang' => DB::table('barangs')->orderBy('tanggal', 'desc')->paginate(10, ['*'], 'servicedone'),
            'barangsp' => DB::table('barangsps')->orderBy('tanggal', 'desc')->paginate(10, ['*'], 'servicepending'),
            'kanibal' => DB::table('kanibals')->orderBy('tanggal', 'desc')->paginate(10, ['*'], 'kanibal')
        ]);
    }


    public function total(Request $request, Barang $barang, Barangsp $barangsp, Kanibal $kanibal )
    {
        $barang = Barang::count();
        $barangsp = Barangsp::count();
        $kanibal = Kanibal::count();

        return view('monitor.index', compact('barangs','barangsps','kanibals')
    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
