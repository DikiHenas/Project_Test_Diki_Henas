<?php

namespace App\Http\Controllers;

use App\Exports\AbsensiExport;
use App\Models\Absensi;
use App\Models\Pegawai;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Prophecy\Argument\Token\AnyValuesToken;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{

    public function __construct(){
        $this->data['currentAdminMenu'] = 'pegawai';
		$this->data['currentAdminSubMenu'] = 'absensi';        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->data['filter'] = $request->query('search');
        if($this->data['filter']!=null){
            $this->data['filter'] = $request->query('filter');
            $this->data['datas']=DB::table('absensi')->join('pegawai', 'absensi.nik', '=', 'pegawai.nik')
            ->select('absensi.id','absensi.nik','pegawai.full_name','absensi.date_time','absensi.in_out')
            ->where('pegawai.full_name', 'like', '%'.$this->data['filter'].'%')
            ->orWhere('absensi.nik', 'like', '%'.$this->data['filter'].'%')->orderBy('id', 'DESC')->paginate(3);
        }
        else{
            $this->data['datas']=DB::table('absensi')->join('pegawai', 'absensi.nik', '=', 'pegawai.nik')
        ->select('absensi.id','absensi.nik','pegawai.full_name','absensi.date_time','absensi.in_out')
        ->orderBy('id','DESC')->paginate(2);
        }    

        // $this->data['datas']=Absensi::orderBy('id','DESC')->paginate(10);
        
        return view('admin.absensi.index',$this->data);
    }
    public function exportCSV(){
        $data=DB::table('absensi')->join('pegawai', 'absensi.nik', '=', 'pegawai.nik')
        ->select('absensi.nik','pegawai.full_name','absensi.date_time','absensi.in_out')
        ->orderBy('pegawai.full_name','ASC')->get();
        $fileName = 'Data Absensi Pegawai-'. date('Y-M-D').'.csv';
        return Excel::download(new AbsensiExport($data), $fileName);
        return view('admin.pegwai.index', $this->data);
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
        $params = $request->except('_token');
        try{
            Pegawai::where('nik', $params['nik'])->firstOrFail();
        }
        catch(Exception $e) {
            Session::flash('error', 'data pegawai not found');
            return redirect('/');
        } 
        
        $lastData = Absensi::where('nik', $params['nik'])->latest()->first();
        if ($lastData != null) {
            if ($lastData->in_out == "IN") {
                $params['date_time'] = date_create();
                $params['in_out'] = "OUT";   
                Session::flash('error', 'Anda Berhasil Absen Pulang');             
            } else {
                $params['date_time'] = date_create();
                $params['in_out'] = "IN";            
                Session::flash('success', 'Anda Berhasil Absen Masuk');
            }
        } else {
            $params['date_time'] = date_create();
            $params['in_out'] = "IN";
            Session::flash('success', 'Anda Berhasil Absen Masuk');
        }        
        Absensi::create($params);

        return redirect('/');
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
    // private function checkLastStatus($nik){
    //     $date_now = date("Y-m-d");
    //     $lastData = Absensi::where('nik', $params['nik'])->latest()->first();
    //     $lastData_date = date("Y-m-d", strtotime($lastData->date));
    //     dd($lastData_date);
    //     if ($date_now - $lastData_date > 0) {
    //         $params['date_time'] = date("Y-m-d H:i:s");
    //         $params['in_out'] = "IN";
    //     } else if ($date_now - $lastData_date = 0) {
    //         if ($lastData->in_out == "IN") {
    //             $params['date_time'] = date("Y-m-d H:i:s");
    //             $params['in_out'] = "OUT";
    //         } else {
    //             $params['date_time'] = date("Y-m-d H:i:s");
    //             $params['in_out'] = "IN";
    //         }
    //     }
    //     else{
    //         //date not right
    //     }
    //     return $params;
    // }
}
