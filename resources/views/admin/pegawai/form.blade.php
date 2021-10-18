@extends('admin.layout')

@section('content')
@php
$formTitle = !empty($pegawai) ? 'Update' : 'New'
@endphp
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h2>{{ $formTitle }} pegawai</h2>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash', ['$errors' => $errors])
                    @if (!empty($pegawai))
                    {!! Form::model($pegawai, ['url' => ['admin/pegawai', $pegawai->id], 'method' => 'PUT']) !!}
                    {!! Form::hidden('id') !!}
                    @else
                    {!! Form::open(['url' => 'admin/pegawai']) !!}
                    @endif
                    <div class="form-group">
                        {!! Form::label('nik', 'NIK Pegawai') !!}
                        {!! Form::text('nik', null, ['class' => 'form-control', 'placeholder' => 'NIK Pegawai']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('full_name', 'Nama Lengkap') !!}
                        {!! Form::text('full_name', null, ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'abc@example.com']) !!}
                    </div>                    
                    <div class="form-group">
                        {!! Form::label('mobile_number', 'Nomor Handphone') !!}
                        {!! Form::text('mobile_number', null, ['class' => 'form-control', 'placeholder' => 'Nomor Handphone']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address', 'Alamat') !!}
                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Alamat']) !!}
                    </div>
                    
                    <div class="form-footer pt-5 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Save</button>
                        <a href="{{ url('admin/pegawai') }}" class="btn btn-secondary btn-default">Back</a>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection