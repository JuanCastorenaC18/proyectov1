@extends('admin.layout')
 
@section('contentadmin')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">Mandar Token de Permiso a un usuario</h2>
            </div>
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('Exito'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    @if ($message = Session::get('Error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    {!! Form::open(['url' => '/sendTokenAdmin', 'style' => 'border: 1px solid black; text-align: center;']) !!}
        <div class="form-group">
            <br>
            {!! Form::label('email', 'Ingrese el correo del supervisor ', ['style' => 'color: black']) !!}
            <br>
            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el correo del supervisor']) !!}
        </div>
        <br>
    {!! Form::submit('Enviar correo', ['class' => 'btn btn-outline-primary']) !!}
        <br>
    {!! Form::close() !!}
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estatus</th>
        </tr>
        @foreach ($userssuper as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
        </tr>
        @endforeach
    </table>
  
    {!! $users->links() !!}
      
@endsection