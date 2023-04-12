@extends('products.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-dark">DLCC production</h2>
            </div>
            <br>
            @can('products.create')
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Crear nuevo producto</a>
                </div>
            @endcan
            
            <br>
        </div>
    </div>
   
    @if ($message = Session::get('Exito'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripcion</th>
            <th width="10%">Imagen</th>
            <th>Categoria</th>
            <th>Estatus</th>

            <th width="280px">Accion</th>
        </tr>
        @foreach ($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->nombre }}</td>
            <td>{{ $product->precio }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->descripcion }}</td>
            <td><img src="/imagen/{{ $product->imagen }}" height="30%" width="30%"></td>
            <td>{{ $product->categoria }}</td>
            <td>{{ $product->status }}</td>
            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                    @can('products.show')
                        @if ($product->status == true)
                            <a class="btn btn-primary" href="{{ route('products.show',$product->id) }}">Ver</a>
                        @else
                            <a class="btn btn-outline-primary{{ !$product->is_active ? ' disabled' : '' }}" href="{{ route('products.show',$product->id) }}" @disabled(true)>Ver</a>
                        @endif
                    @endcan
                    
                    @can('products.edit')
                        @if ($product->status == true)
                            <a class="btn btn-warning" href="{{ route('products.edit',$product->id) }}">Editar</a>
                        @else
                            <a class="btn btn-outline-warning{{ !$product->is_active ? ' disabled' : '' }}" href="{{ route('products.edit',$product->id) }}">Editar</a>
                        @endif
                    @endcan
                
                    @can('products.destroy')
                        @csrf
                        @method('DELETE')
                        @if ($product->status == true)
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
    @can('products.update')
        <p>Usted ya tiene permisos.</p>
    @endcan
    @cannot('products.update')
        <p>Usted no tiene permisos vaya al menu de cliente para solicitarlo.</p>
    @endcannot
    
    
  
    {!! $products->links() !!}
      
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!--<script>
    window.addEventListener("load", function() {
        document.getElementById("btnpeticion").disabled = false;
        document.getElementById("btnpeticion").addEventListener("click", function() {
            // Deshabilita el botón
            //document.getElementById("btnpeticion").disabled = true;
            //document.getElementById("btnpeticion").disabled = false;
        });
    });
    
</script>-->
