@extends('layouts.alumno')

@section('utilitiesHead')
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Dropzone.js -->
  <link href="/vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">
    <style>
        #loader{
        visibility:hidden;
        }
    </style>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Cambiar Contraseña</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        {{-- alumno/contrasena/cambiar --}}
                                        {{-- action="{{url('alumno/store')}}" --}}
                                        <form method="POST" action="{{url('alumno/contrasena/cambiar')}}" aria-label="{{ __('Reset Password') }}">
                                            {{-- <form method="POST" action="{{ route('contrasena.change') }}" aria-label="{{ __('Reset Password') }}"> --}}
                                            {{-- <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}"> --}}
                                            @csrf
                                            {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="form-group row">
                                                <label for="actual" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña Actual') }}</label>
                                                <div class="col-md-6">
                                                    <input id="actual" type="password" class="form-control" name="actual" required autofocus>
                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="nueva" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Contraseña') }}</label>

                                                <div class="col-md-6">
                                                    <input id="nueva" type="password" class="form-control" name="nueva" required>

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="renueva" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                                                <div class="col-md-6">
                                                    <input id="renueva" type="password" class="form-control" name="renueva" required>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Confirmar') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
