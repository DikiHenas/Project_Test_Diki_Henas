@extends('admin.layout')

@section('content')

<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>Pegawai</h2>
                </div>

                <div class="card-body">
                    @include('admin.partials.flash')
                    {!! Form::open(['url' => 'admin/absensi','method' => 'GET']) !!}
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="NIK atau Nama" value="{{$filter??null}}">
                    {!! Form::close() !!} 
                    <div class="card-footer text-right">                    
                    <a href="{{ url('admin/reports/absensi') }}" class="btn btn-primary">Export To CSV</a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Jam</th>
                            <th>Status</th>                                                       

                        </thead>
                        <tbody>
                            @forelse ($datas as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{$data->nik}}</td>
                                <td>{{$data->full_name}}</td>
                                <td>{{date("d-m-Y", strtotime($data->date_time));}}</td>
                                <td>{{date("H:i:s", strtotime($data->date_time));}}</td>
                                <td>{{$data->in_out}}</td>                                                                
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">No records found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                </div>                                            
                <div class="pagination .pagination-flat">
                {{$datas->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection