@extends('users.layout')
   
@section('contenttre')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 class="text-dark">Asignar un rol</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Atras</a>
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
  
    <form action="{{ route('users.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Nombre:</strong>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" placeholder="Nombre">
                </div>
            </div>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Correo:</strong>
                    <input disabled type="text" name="email" value="{{ $user->email }}" class="form-control" placeholder="Correo">
                </div>
            </div>
            {!! Form::model([$user,['route'=> ['users.update', $user], 'method' => 'put']]) !!}
                @foreach ($roles as $rol)
                    <div>
                        <label>
                        </label>
                    </div>
                @endforeach
            {!! Form::close() !!}
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br>
              <button type="submit" class="btn btn-outline-success">Enviar</button>
            </div>
        </div>
    </form>
@endsection