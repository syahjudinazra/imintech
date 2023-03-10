<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Kanibal;

use App\Exports\KanibalExport;
use Maatwebsite\Excel\Facades\Excel;


class KanibalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $kanibal = Kanibal::sortable()->orderBy('tanggal', 'desc')->paginate(20);
        return view('kanibal.index', compact('kanibal'));
        // return view('kanibal.index', [
        //     'kanibal' => DB::table('kanibals')->paginate(20)
        // ]);
    }

    public function cari(Request $request)
    {
        // menangkap data pencarian
        $cari = $request->cari;

        // mengambil data dari table pegawai sesuai pencarian data
        $kanibal = DB::table('kanibals')
        ->where('tanggal', 'like', "%" . $cari . "%")
            ->orWhere('serialnumber', 'like', "%" . $cari . "%")
            ->orWhere('pelanggan', 'like', "%" . $cari . "%")
            ->orWhere('model', 'like', "%" . $cari . "%")
            ->paginate();

        // mengirim data pegawai ke view index
        return view('kanibal.index', ['kanibal' => $kanibal]);
    }

    public function export_excel()
    {
        return Excel::download(new KanibalExport, 'DataKanibal.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kanibal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|max:255',
            'serialnumber' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'model' => 'required|max:255',
            'ram' => 'max:255',
            'android' => 'max:255',
            'garansi' => 'max:255',
            'kerusakan' => 'required|max:255',
            'kerusakanbawaan' => 'max:255',
            'teknisi' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'snkanibal' => 'required|max:255',
            'nosparepart' => 'required|max:255',
            'note' => 'max:255',
        ]);

        Kanibal::create($validatedData);

        return redirect('/kanibal')->with('success', 'Data telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @return \Illuminate\View\View
     */
    public function show(Kanibal $kanibal)
    {

        return view('kanibal.show', [
            'kanibal' => Kanibal::find($kanibal)->where('id', $kanibal->id)
        ]);
        // $kanibal = Kanibal::find('id');
        // return view('kanibal.show')->with('kanibal', $kanibal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kanibal  $kanibal
     * @return \Illuminate\Http\Response
     */
    public function edit(Kanibal $kanibal)
    {
        return view('kanibal.edit', [
            'kanibal' => $kanibal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kanibal $kanibal)
    {
        $validatedData = $request->validate([
            'tanggal' => 'required|max:255',
            'serialnumber' => 'required|max:255',
            'pelanggan' => 'required|max:255',
            'model' => 'required|max:255',
            'ram' => 'max:255',
            'android' => 'max:255',
            'garansi' => 'max:255',
            'kerusakan' => 'required|max:255',
            'kerusakanbawaan' => 'max:255',
            'teknisi' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'snkanibal' => 'required|max:255',
            'nosparepart' => 'required|max:255',
            'note' => 'max:255',
        ]);

        Kanibal::where('id', $kanibal->id)
            ->update($validatedData);

        return redirect('/kanibal')->with('success', 'Data telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kanibal $kanibal)
    {
        Kanibal::destroy($kanibal->id);
        return redirect('/kanibal')->with('success', 'Data telah dihapus');
    }

    //move data table
    public function finish(Request $request, Kanibal $kanibal)
    {
        //    echo $kanibal->id;
        $kanibal = DB::table('kanibals')->where('id', '' . $kanibal->id . '')->first();

        //    echo $user->serialnumber;
        DB::table('barangs')->insert(
            array(
                'tanggal'     =>   $kanibal->tanggal,
                'serialnumber'   =>   $kanibal->serialnumber,
                'pelanggan'   =>   $kanibal->pelanggan,
                'model'   =>   $kanibal->model,
                'ram'   =>   $kanibal->ram,
               'android'   =>   $kanibal->android,
               'garansi'   =>   $kanibal->garansi,
               'kerusakan'   =>   $kanibal->kerusakan,
               'kerusakanbawaan'  =>   $kanibal->kerusakanbawaan,
               'teknisi'   =>   $kanibal->teknisi,
               'perbaikan'   =>   $kanibal->perbaikan,
               'snkanibal'   =>   $kanibal->snkanibal,
               'nosparepart'   =>   $kanibal->nosparepart,
               'note'   =>   $kanibal->note,
            )
        );
        DB::table('kanibals')->where('id', $kanibal->id)->delete();
        return redirect('/servicedone')->with('success', 'Data berhasil dipindahkan');
    }
}
