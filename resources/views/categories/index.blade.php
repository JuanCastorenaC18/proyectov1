@extends('categories.layout')
 
@section('contenttwo')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">DLCC production</h2>
            </div>
            <br>
            @can('categories.create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Crear nuevo categoria</a>
                </div>
            @endcan
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('Exito '))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Estatus</th>
            <th width="280px">Accion</th>
        </tr>
        @foreach ($categories as $category)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $category->nombre }}</td>
            <td>{{ $category->descripcion }}</td>
            <td>{{ $category->status }}</td>
            <td>
                <form action="{{ route('categories.destroy',$category->id) }}" method="POST">

                    @can('categories.show')
                        @if ($category->status == true)
                            <a class="btn btn-outline-primary" href="{{ route('categories.show',$category->id) }}">Ver</a>
                        @else
                            <!--Ningun boton ya que esta desactivo-->
                        @endif
                    @endcan
                    
                    @can('categories.edit')
                        @if ($category->status == true)
                            <a class="btn btn-outline-warning" href="{{ route('categories.edit',$category->id) }}">Editar</a>
                        @else
                            <!--Ningun boton ya que esta desactivo-->
                        @endif
                    @endcan
                    
                    @can('categories.destroy')
                        @csrf
                        @method('DELETE')
                        @if ($category->status == true)
                            <button type="submit" class="btn btn-outline-danger">Desactivar</button>
                        @else
                            <button type="submit" class="btn btn-outline-info">Activar</button>
                        @endif
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <hr style="border-color: #000000; border-width: 2px;">
    <br>
    @auth
        @if (Auth::user()->hasRole('Client'))
            @can('products.update')
                <p style="color: #000000">Usted ya tiene permisos.</p>
            @endcan
            @cannot('products.update')
                <p style="color: #000000">Usted no tiene permisos vaya al menu de cliente para solicitarlo.</p>
            @endcannot
        @endif

        @if (Auth::user()->hasRole('Supervisor'))
            @can('products.destroy')
                <p style="color: #000000">Usted ya tiene permisos.</p>
            @endcan
            @cannot('products.destroy')
                <p style="color: #000000">Usted no tiene permisos vaya al menu de supervisor para solicitarlo.</p>
            @endcannot
        @endif
        
    @endauth
    
  
    {!! $categories->links() !!}
      
@endsection