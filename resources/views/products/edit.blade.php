@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1 class="text-dark">Editar producto</h1>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Atras</a>
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

    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Nombre:</strong>
                    <input type="text" name="nombre" value="{{ $product->nombre }}" class="form-control" placeholder="Nombre">
                </div>
            </div>
            <br>
            <div class="input-group mb-3 col-xs-12 col-sm-12 col-md-12">
            <br>
                <strong class="text-dark">Precio:</strong>
                <span class="input-group-text">$</span>
                <input type="text" name="precio" value="{{ $product->precio }}" class="form-control" placeholder="Precio">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Stock:</strong>
                    <input type="text" name="stock" value="{{ $product->stock }}" class="form-control" placeholder="Stock">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Descripcion:</strong>
                    <input type="text" name="descripcion" value="{{ $product->descripcion }}" class="form-control" placeholder="Descripcion">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <img id="imagenSelecionada" src="https://spaces-server.sgp1.digitaloceanspaces.com/{{ $product->imagen }}" height="4%" width="4%">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong class="text-dark">Imagen:</strong>
                    <input type="file" id="imagen" value="{{ $product->imagen }}" name="imagen" class="form-control" placeholder="Imagen">
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group text-dark">
                    <strong>Categoria:</strong>
                    <select name="categoria" class="form-control" placeholder="Categoria" aria-label="Default select example">
                        <option selected>{{ $product->categoria }}</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $product->categoria }}'.'{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <br>
              <button type="submit" class="btn btn-outline-success">Enviar</button>
            </div>
        </div>

    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(e){
            $('#imagen').change(function(){
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagenSelecionada').attr('src', e.target.result);
                    $('#imagenSelecionada').show();
                }
                reader.readAsDataURL(this.files[0]);
            })
        })
    </script>
@endsection
