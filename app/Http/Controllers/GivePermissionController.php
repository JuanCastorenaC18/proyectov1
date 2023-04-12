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

class GivePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:supervisors.index')->only('index');
        $this->middleware('can:supervisors.indexcustom')->only('indexcustom');
        $this->middleware('can:supervisors.create')->only('create');
        $this->middleware('can:supervisors.store')->only('store');
        $this->middleware('can:supervisors.show')->only('show');
        $this->middleware('can:supervisors.edit')->only('edit');
        $this->middleware('can:supervisors.update')->only('update');
        $this->middleware('can:supervisors.destroy')->only('destroy');
        $this->middleware('can:supervisors.destroy')->only('editrol');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userscli = User::role('Client')->get();
        $users = User::latest()->paginate(5);
        
        return view('supervisor.supervisor',compact('users','userscli'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function indexcustom()
    {
        return view('customers.customer');
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
