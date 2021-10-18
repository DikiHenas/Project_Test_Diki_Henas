<?php

namespace App\Http\Controllers;

use App\Exports\PegawaiExport;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Exception;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{

    public function __construct(){
        $this->data['currentAdminMenu'] = 'pegawai';
		$this->data['currentAdminSubMenu'] = 'pegawai';        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        $this->data['filter'] = $request->query('filter');
        if($this->data['filter']!=null){
            $this->data['filter'] = $request->query('filter');
            $this->data['pegawai']=Pegawai::where('pegawai.full_name', 'like', '%'.$this->data['filter'].'%')
            ->orWhere('pegawai.nik', 'like', '%'.$this->data['filter'].'%')->orderBy('id', 'DESC')->paginate(2);
        }
        else{
            $this->data['pegawai'] = Pegawai::orderBy('id', 'DESC')->paginate(1);    
        }    
        return view('admin.pegawai.index', $this->data);
    }

    // public function indexSearch(Request $request){
        
        
    //     return view('admin.pegawai.index', $this->data);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['pegawai'] = null;
        return view('admin.pegawai.form', $this->data);
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
            'nik' => 'required|max:16',
            'full_name'=>'required',
            'email' => 'required',
            'mobile_number'=>'required',
            'address'=> 'required'
        ]);
       $params = $request->except('_token');
       $pegawai=Pegawai::where('nik',$params['nik'])->first();
       if(!empty($pegawai)){
        Session::flash('error', 'nik sudah terdaftar');
        return redirect('admin/pegawai');
       }
        if (Pegawai::create($params)) {
            Session::flash('success', 'data pegawai berhasil ditambahkan');
        }
        return redirect('admin/pegawai');
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->data['pegawai'] = Pegawai::findOrFail($id);
        return view('admin.pegawai.form', $this->data);
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
            'nik' => 'required|max:16',
            'full_name'=>'required',
            'email' => 'required',
            'mobile_number'=>'required',
            'address'=> 'required'
        ]);
        $params = $request->except('_token');
        $pegawai = Pegawai::findOrFail($id);
        if($pegawai->update($params)){
            Session::flash('success', 'data pegawai sudah diperbarui');
        } else {
            Session::flash('error', 'data pegawai tidak dapat diperbarui');
        }
        return redirect('admin/pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        if ($pegawai->delete($pegawai)) {
            Session::flash('error', 'data pegawai berhasil dihapus.');
        }
        return redirect('admin/pegawai');
    }

    public function exportCSV(){
        $pegawai=Pegawai::orderBy('full_name','ASC')->get();
        $fileName = 'Data Pegawai-'. date('Y-M-D').'.csv';
        return Excel::download(new PegawaiExport($pegawai), $fileName);
        return view('admin.pegwai.index', $this->data);

    }



    public function Apiget()
    {
        $pegawai = Pegawai::orderBy('id', 'DESC')->get();
        if (count($pegawai) > 0) {
            $response = [
                'code' => 200,
                'data' => $pegawai,
                'message' => 'success',
            ];
            return response()->json($response, 200);
        } else {
            $response = [
                'code' => 404,
                'data' => [],
                'message' => 'Data pegawai  Not found',
            ];
            return response()->json($response, 404);
        }
    }
    public function ApigetDetail($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
        } catch (Exception $e) {
            $response = [
                'code' => 404,
                'data' => [],
                'message' => 'Data pegawai  Not found',
            ];
            return response()->json($response, 404);
        }

        $response = [
            'code' => 200,
            'data' => $pegawai,
            'message' => 'success',
        ];
        return response()->json($response, 200);
    }
    public function Apipost(Request $request)
    {
        $params = $request->except('_token');
        if (Pegawai::create($params)) {
            $response = [
                'code' => 200,
                'data' => $params,
                'message' => 'input data buku success',
            ];
            return response()->json($response, 200);
        }
    }
    public function Apiput(Request $request, $id)
    {
        $params = $request->except('_token');
        try {
            $pegawai = Pegawai::findOrFail($id);
        } catch (Exception $e) {
            $response = [
                'code' => 404,
                'data' => [],
                'message' => 'pegawai Not found',
            ];
            return response()->json($response, 404);
        }
        if ($pegawai->update($params)) {
            $response = [
                'code' => 200,
                'data' => $pegawai,
                'message' => 'update data pegawai success',
            ];
            return response()->json($response, 200);
        }
    }
    public function ApiDelete($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
        } catch (Exception $e) {
            $response = [
                'code' => 404,
                'data' => [],
                'message' => 'pegawai Not found',
            ];
            return response()->json($response, 404);
        }

        if ($pegawai->delete($pegawai)) {
            $response = [
                'code' => 200,
                'data' => $pegawai,
                'message' => 'delete pegawai  success',
            ];
            return response()->json($response, 200);
        }
    }
}
