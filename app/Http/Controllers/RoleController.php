<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Tables\RolesTable;
use App\Services\RoleService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;

class RoleController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        return view('roles.index', [
            'roles' => RolesTable::class
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('companies_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create companies');

        return view('roles.create', [
            'permissions' => Permission::pluck('name', 'id')
        ]);
    }

    public function store(StoreRoleRequest $request, RoleService $roleService)
    {
        abort_unless(Gate::allows('companies_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create companies');

        $roleService->setValidated($request->validated())->create();

        Toast::title("Role created successfully")->autoDismiss(3);

        return redirect()->route('roles.index');
    }

    public function show(Role $role)
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        return view('roles.show', [
            'role' => $role->load('permissions')->loadCount('permissions')->loadCount('users'),
        ]);
    }

    public function edit(Role $role)
    {
        abort_unless(Gate::allows('companies_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update companies');

        return view('roles.edit', [
            'role' => $role->load('permissions'),
            'permissions' => Permission::pluck('name', 'id'),
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role, RoleService $roleService)
    {
        abort_unless(Gate::allows('companies_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update companies');

        $roleService->setValidated($request->validated())->setRole($role)->update();

        Toast::title("Role updated successfully")->autoDismiss(3);

        return redirect()->route('roles.index');
    }

    public function destroy(Role $role, RoleService $roleService)
    {
        abort_unless(Gate::allows('companies_delete'), Response::HTTP_FORBIDDEN, 'You are not authorised to delete companies');

        $roleService->setRole($role)->delete();

        Toast::title("Role deleted successfully")->autoDismiss(3);

        return redirect()->route('roles.index');
    }
}
