<?php
  
namespace App\Http\Controllers;

use App\Mail\MailAlSuper;
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
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::latest()->paginate(5);
        
        return view('products.index',compact('products'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
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

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis')."." .$imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $product['imagen'] = "$imagenProducto";
        }
        Product::create($product);
        return redirect()->route('products.index')->with('Exito', 'Producto creado correctamente.');

        /*Product::create($request->all());
        
        return redirect()->route('products.index')
                        ->with('Exito','Producto creado con exito.');*/
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
        return view('products.edit',compact('product'));
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
        $prod->$request->all();

        if ($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'imagen/';
            $imagenProducto = date('YmdHis')."." .$imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg, $imagenProducto);
            $prod['imagen'] = "$imagenProducto";
        } else {
            unset($prod['imagen']);
        }
        Product::update($prod);
        
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

    public function enviarPeticion(MailAlSuper $mail): View
    {
        //$mail= new MailAlSuper($signed_Route);
        $users = User::role('Supervisor')->get();
        Mail::to($users)->send(new MailAlSuper($mail));
        //Mail::to(Auth::user()->email)->send(new MailAlSuper($mail));
        /*$usuario = User::find($id);
        Mail::to(Auth::user()->email, $usuario->email)->send(new MailAlSuper($mail));*/

        //return redirect()->route('products.codeper')
        return view('products.codeper')
                        ->with('Exito','Peticion enviada con exito, espere un momento para autorizarlo, Revise su Correo.');
    }
}
