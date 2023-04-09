@extends('users.layout')
  
@section('contenttre')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark"> Mostrar categoria</h2>
            </div>
            <br>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Atras</a>
            </div>
            <br>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">ID:</strong>
                {{ $user->id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Nombre:</strong>
                {{ $user->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Correo:</strong>
                {{ $user->email }}
            </div>
        </div> 
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group text-dark">
                <strong class="text-dark">Estatus:</strong>
                {{ $user->status }}
            </div>
        </div>
    </div>
@endsection