<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Response;
use App\Tables\DepartmentsTable;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('departments_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access departments');

        return view('departments.index', [
            'departments' => DepartmentsTable::class
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('departments_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create departments');

        return view('departments.create');
    }

    public function store(StoreDepartmentRequest $request, DepartmentService $departmentService)
    {
        abort_unless(Gate::allows('departments_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create departments');

        $departmentService->setValidated($request->validated())->create();

        Toast::title("Department created.")->autoDismiss(3);

        return redirect()->route('departments.index');
    }

    public function show(Department $department)
    {
        abort_unless(Gate::allows('departments_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access departments');

        return view('departments.show', [
            'department' => $department->load('user:id,name', 'updater:id,name')
        ]);
    }

    public function edit(Department $department)
    {
        abort_unless(Gate::allows('departments_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update departments');

        return view('departments.edit', [
            'department' => $department
        ]);
    }

    public function update(UpdateDepartmentRequest $request, Department $department, DepartmentService $departmentService)
    {
        abort_unless(Gate::allows('departments_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update departments');

        $departmentService->setValidated($request->validated())->setDepartment($department)->update();

        Toast::title("Department updated.")->autoDismiss(3);

        return redirect()->route('departments.index');
    }

    public function destroy(Department $department, DepartmentService $departmentService)
    {
        abort_unless(Gate::allows('departments_delete'), Response::HTTP_FORBIDDEN, 'You are not authorised to delete departments');

        $departmentService->setDepartment($department)->delete();

        Toast::title("Department deleted.")->autoDismiss(3);

        return redirect()->route('departments.index');
    }
}
