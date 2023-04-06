@extends('users.layout')
 
@section('contenttre')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">DLCC production</h2>
            </div>
            <br>
            @can('users.create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Crear nuevo usuario</a>
                </div>
            @endcan
            
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Estatus</th>
            <th width="280px">Accion</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->status }}</td>
            <td>
                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                    @can('users.show')
                        <a class="btn btn-outline-primary" href="{{ route('users.show',$user->id) }}">Ver</a>
                    @endcan
                    
                    @can('users.edit')
                        <a class="btn btn-outline-warning" href="{{ route('users.edit',$user->id) }}">Editar Permisos</a>
                    @endcan
                    
                    @can('users.destroy')
                        @csrf
                        @method('DELETE')
        
                        <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $users->links() !!}
      
@endsection