@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Absensi</div>

                <div class="card-body">
                    {!! Form::open(['url' => 'absensi']) !!}
                    <div class="form-group">
                        {!! Form::label('nik', 'NIK Pegawai') !!}
                        {!! Form::text('nik', null, ['class' => 'form-control', 'placeholder' => 'NIK Pegawai']) !!}
                    </div>
                    <button type="submit" class="btn btn-primary btn-default">Save</button>
                    {!! Form::close() !!}                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection