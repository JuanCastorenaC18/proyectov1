<?php

namespace App\Http\Controllers;

use App\Mail\MailAlSuper;
use App\Mail\MailAlAdmin;
use Illuminate\Support\Facades\Mail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use App\Http\Controllers\console;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:products.index')->only('index');
        $this->middleware('can:products.create')->only('create');
        $this->middleware('can:products.store')->only('store');
        $this->middleware('can:products.show')->only('show');
        $this->middleware('can:products.edit')->only('edit');
        $this->middleware('can:products.update')->only('update');
        $this->middleware('can:products.destroy')->only('destroy');
        $this->middleware('can:enviarPeticion')->only('enviarPeticion');
        $this->middleware('can:enviarPeticionAdmin')->only('enviarPeticionAdmin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::all();
        $products = Product::latest()->paginate(5);

        return view('products.index',compact('products', 'users'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categorias = Category::all();
        return view('products.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'stock' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categoria' => 'required',
        ]);
        $product = $request->all();

        $file = $request->file('imagen');

        $imagenProducto = date('YmdHis')."." .$file->getClientOriginalExtension();

        $product['imagen'] = "$imagenProducto";

        $filecontent = file_get_contents($file->getRealPath());

        Storage::disk('digitalocean')->put($imagenProducto, $filecontent, 'public');

        Product::create($product);

        return redirect()->route('products.index')->with('Exito', 'Producto creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        $categorias = Category::all();
        return view('products.edit',compact('product', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required',
            'stock' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required',
        ]);

        $id = $product->id;

        $producto = Product::find($id);

        $file = $request->file('imagen');

        $imagenProducto = date('YmdHis')."." .$file->getClientOriginalExtension();

        $filecontent = file_get_contents($file->getRealPath());

        $producto->nombre = $request["nombre"];
        $producto->precio = $request["precio"];
        $producto->stock = $request["stock"];
        $producto->descripcion = $request["descripcion"];
        $producto->categoria = $request["categoria"];
        $producto->imagen = "$imagenProducto";

        Storage::disk('digitalocean')->put($imagenProducto, $filecontent, 'public');

        $producto->save();

        return redirect()->route('products.index')
                        ->with('Exito','Producto creado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        /*$product->delete();

        return redirect()->route('products.index')
                        ->with('Exito','Producto eliminado con exito.');*/
        /*$product->status = false;
        $product->save();
        return redirect()->route('products.index')
                        ->with('Exito','Producto desactivado con exito.');*/

        if ($product->status == false) {
            $product->status = true;
            $product->save();
            return redirect()->route('products.index')
                            ->with('Exito','Producto activo con exito.');
        }
        else {
            $product->status = false;
            $product->save();
            return redirect()->route('products.index')
                        ->with('Exito','Producto desactivado con exito.');
        }
    }
    public function enviarPeticionAdmin(User $user)
    {
        $users = User::role('Admin')->get();
        $user = auth()->user()->email;
        Mail::to($users)->send(new MailAlAdmin($user));
        return redirect()->back()->with('Exito','Peticion enviada con exito al Admin, espere un momento para autorizarlo, Revise su Correo.');
    }

    public function enviarPeticion(User $user)
    {

        //$mail= new MailAlSuper($signed_Route);
        $users = User::role('Supervisor')->get();
        $user = auth()->user()->email;
        //return $users;
        Mail::to($users)->send(new MailAlSuper($user));
        return redirect()->back()->with('Exito','Peticion enviada con exito, espere un momento para autorizarlo, Revise su Correo.');
        //Mail::to(Auth::user()->email)->send(new MailAlSuper($mail));
        /*$usuario = User::find($id);
        Mail::to(Auth::user()->email, $usuario->email)->send(new MailAlSuper($mail));*/
        //$logeado = Auth::user();
        //$logeado->revokePermissionTo(['products.edit', 'products.update']);
        //$permission = Permission::findByName();
        //$logeado->givePermissionTo(['products.edit', 'products.update']);
        //return redirect()->route('products.codeper')

    }


}
