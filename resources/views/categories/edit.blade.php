@extends('categories.layout')
   
@section('contenttwo')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 class="text-dark">Editar Categoria</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Atras</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Vaya!</strong> Hubo algunos problemas con su entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('categories.update',$category->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Nombre:</strong>
                    <input type="text" name="nombre" value="{{ $category->nombre }}" class="form-control" placeholder="Nombre">
                </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Descripcion:</strong>
                    <input type="text" name="descripcion" value="{{ $category->descripcion }}" class="form-control" placeholder="Descripcion">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br>
              <button type="submit" class="btn btn-outline-success">Enviar</button>
            </div>
        </div>
   
    </form>
@endsection