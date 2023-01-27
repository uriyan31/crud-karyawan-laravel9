<?php

namespace App\Http\Controllers;

use App\Models\karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class karyawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $data = karyawan::orderBy('nik','desc')->paginate(5);
        return view('karyawan.index')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('nik',$request->nik);
        Session::flash('nama',$request->nama);
        Session::flash('posisi',$request->posisi);

        $request->validate([
            'nik'=>'required|numeric|unique:karyawan,nik',
            'nama'=>'required',
            'posisi'=>'required',
        ],[
            'nik.required'=>'NIK wajib diisi',
            'nik.numeric'=>'NIK wajib dalam angka',
            'nik.unique'=>'NIK yang diisikan sudah ada dalam database',
            'nama.required'=>'Nama wajib diisi',
            'posisi.required'=>'Posisi wajib diisi',
        ]);
        $data = [
            'nik'=>$request->nik,
            'nama'=>$request->nama,
            'posisi'=>$request->posisi,
        ];
        karyawan::create($data);
        return redirect()->to('karyawan')->with('success','Berhasil menambahkan data');
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
        $data = karyawan::where('nik',$id)->first();
        return view('karyawan.edit')->with('data',$data);
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
        $request->validate([
            'nama'=>'required',
            'posisi'=>'required',
        ],[
            'nama.required'=>'Nama wajib diisi',
            'posisi.required'=>'Posisi wajib diisi',
        ]);
        $data = [
            'nama'=>$request->nama,
            'posisi'=>$request->posisi,
        ];
        karyawan::where('nik',$id)->update($data);
        return redirect()->to('karyawan')->with('success','Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        karyawan::where('nik',$id)->delete();
        return redirect()->to('karyawan')->with('success','Berhasil melakukan delete data');
    }
}
