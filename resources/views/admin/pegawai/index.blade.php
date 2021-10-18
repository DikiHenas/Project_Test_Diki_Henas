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
                    
                    {!! Form::open(['url' => 'admin/pegawai','method' => 'GET']) !!}
                    <input type="text" class="form-control" id="filter" name="filter" placeholder="NIK atau Nama" value="{{$filter??null}}">
                    {!! Form::close() !!} 
                    <div class="card-footer text-right">
                    <a href="{{ url('admin/reports/pegawai') }}" class="btn btn-primary">Export To CSV</a>  
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Nomer Handphone</th>                            
                            <th>Action</th>

                        </thead>
                        <tbody>
                            @forelse ($pegawai as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{$p->nik}}</td>
                                <td>{{$p->full_name}}</td>
                                <td>{{$p->email}}</td>
                                <td>{{$p->mobile_number}}</td>                                

                                <td>
                                    <a href="{{ url('admin/pegawai/'. $p->id .'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                                    {!! Form::open(['url' => 'admin/pegawai/'. $p->id, 'class' => 'delete', 'style' => 'display:inline-block']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    {!! Form::submit('remove', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
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
                {{$pegawai->onEachSide(1)->links()}}
                </div>
                <div class="card-footer text-right">
                    
                    <a href="{{ url('admin/pegawai/create') }}" class="btn btn-primary">Add New</a>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection