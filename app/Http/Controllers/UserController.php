<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use DB;
use Illuminate\Support\Facades\Hash;

use App\Models\User; // Asegúrate de importar la clase User correctamente.
use App\Models\Volunteer;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-user|edit-user|delete-user', ['only' => ['index','show']]);
        $this->middleware('permission:create-user', ['only' => ['create','store']]);
        $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
        $this->middleware('permission:delete-user', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('users.index', [
            'users' => User::latest('id')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create', [
            'roles' => Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $input = $request->all();
        $input['password'] = Hash::make($request->password);

        // Asignar un valor predeterminado si 'dni' no está presente
        if (!isset($input['dni'])) {
            $input['dni'] = 'default_dni_value';

        $user = User::create($input);
        $user->assignRole($request->roles);

        return redirect()->route('users.index')
                ->withSuccess('Nuevo usuario añadido correctamente.');
    }
}

    /**
     * Display the specified resource.
     */
     public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(User $user): View
    {
        // Check Only Super Admin can update his own Profile
        if ($user->hasRole('Admin')){
            if($user->id != auth()->user()->id){
                abort(403, 'EL USUARIO NO TIENE LOS PERMISOS NECESARIOS');
            }
        }

        return view('users.edit', [
            'user' => $user,
            'roles' => Role::pluck('name')->all(),
            'userRoles' => $user->roles->pluck('name')->all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $input = $request->all();

        if(!empty($request->password)){
            $input['password'] = Hash::make($request->password);
        }else{
            $input = $request->except('password');
        }

        $user->update($input);

        $user->syncRoles($request->roles);

        // Verifica si el usuario tiene el rol "volunteer"
        $volunteer = Volunteer::where('user_id', $user->id)->first();
        if ($user->hasRole('Volunteer')&& $volunteer) {
            $volunteer->update(['status' => 'active', 'approved_date' => now()]);
        }
        // else {
        //     $volunteer->update(['status' => 'inactive', 'inactive_date' => now()]);
        // }

        return redirect()->back()
                ->withSuccess('El usuario ha sido actualizado correctamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        // About if user is Super Admin or User ID belongs to Auth User
        if ($user->hasRole('Admin') || $user->id == auth()->user()->id)
        {
            abort(403, 'EL USUARIO NO TIENE LOS PERMISOS NECESARIOS');
        }

        $user->syncRoles([]);
        $user->delete();
        return redirect()->route('users.index')
                ->withSuccess('El usuario ha sido eliminado correctamente');
    }
}
