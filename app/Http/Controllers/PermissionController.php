<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Response;
use App\Tables\PermissionsTable;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('permissions_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access permissions');

        return view('permissions.index', [
            'permissions' => PermissionsTable::class,
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('permissions_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access permissions');
    }

    public function store(StorePermissionRequest $request)
    {
        abort_unless(Gate::allows('permissions_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access permissions');
    }

    public function show(Permission $permission)
    {
        abort_unless(Gate::allows('permissions_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access permissions');
    }

    public function edit(Permission $permission)
    {
        abort_unless(Gate::allows('permissions_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access permissions');
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        abort_unless(Gate::allows('permissions_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access permissions');
    }

    public function destroy(Permission $permission)
    {
        abort_unless(Gate::allows('permissions_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access permissions');
    }
}
