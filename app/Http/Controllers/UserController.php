<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create');
        $this->middleware('can:users.store')->only('store');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.edit')->only('edit');
        $this->middleware('can:users.update')->only('update');
        $this->middleware('can:users.destroy')->only('destroy');
        $this->middleware('can:users.destroy')->only('editrol');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::latest()->paginate(5);
        
        return view('users.index',compact('users'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->assignRole('Client');
        $user->save();
        //User::create($request->all());
         
        return redirect()->route('users.index')
                        ->with('Exito','Usuario creada con exito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $permissions= Permission::all();
        return view('users.edit',compact('user', 'permissions'));
    }

    public function editpermiso(User $user): View
    {
        $permissions= Permission::all();
        return view('users.editpermiso',compact('user', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);
        
        $user->update($request->all());
        
        return redirect()->route('users.index')
                        ->with('Exito','Usuario actualizada con exito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        /*$user->delete();
        return redirect()->route('users.index')
                        ->with('Exito','Usuario eliminada con exito.');*/
        if ($user->status == false) {
            $user->status = true;
            $user->save();
            return redirect()->route('users.index')
                            ->with('Exito','Usuario activo con exito.');
        }
        else {
            $user->status = false;
            $user->save();
            return redirect()->route('users.index')
                        ->with('Exito','Usuario desactivado con exito.');
        }
    }
    public function updatepermisos(User $user): RedirectResponse
    {
        
    }
}
