<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:categories.index')->only('index');
        $this->middleware('can:categories.create')->only('create');
        $this->middleware('can:categories.store')->only('store');
        $this->middleware('can:categories.show')->only('show');
        $this->middleware('can:categories.edit')->only('edit');
        $this->middleware('can:categories.update')->only('update');
        $this->middleware('can:categories.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::latest()->paginate(5);
        
        return view('categories.index',compact('categories'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        
        Category::create($request->all());
         
        return redirect()->route('categories.index')
                        ->with('Exito','Categoria creada con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        return view('categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        
        $category->update($request->all());
        
        return redirect()->route('categories.index')
                        ->with('Exito','Categoria actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        /*$category->delete();
         
        return redirect()->route('categories.index')
                        ->with('Exito','Categoria eliminada con exito.');*/

        if ($category->status == false) {
            $category->status = true;
            $category->save();
            return redirect()->route('categories.index')
                            ->with('Exito','Categoria activado con exito.');
        }
        else {
            $category->status = false;
            $category->save();
            return redirect()->route('categories.index')
                        ->with('Exito','Categoria desactivada con exito.');
        }
    }
    
}
