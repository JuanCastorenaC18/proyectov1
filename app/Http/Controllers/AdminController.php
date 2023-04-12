<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admins.index')->only('index');
        $this->middleware('can:admins.indexcustom')->only('indexcustom');
        $this->middleware('can:admins.create')->only('create');
        $this->middleware('can:admins.store')->only('store');
        $this->middleware('can:admins.show')->only('show');
        $this->middleware('can:admins.edit')->only('edit');
        $this->middleware('can:admins.update')->only('update');
        $this->middleware('can:admins.destroy')->only('destroy');
        $this->middleware('can:admins.destroy')->only('editrol');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userssuper = User::role('Supervisor')->get();
        $users = User::latest()->paginate(5);
        
        return view('admin.admins',compact('users','userssuper'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
