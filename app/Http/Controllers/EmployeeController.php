<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Response;
use App\Tables\EmployeesTable;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('employees_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access employees');

        return view('employees.index', [
            'employees' => EmployeesTable::class,
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('employees_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create employees');

        return view('employees.create', [
            'departments' => Department::pluck('name', 'id'),
            'designations' => Designation::pluck('name', 'id'),
            'offices' => Office::pluck('name', 'id'),
        ]);
    }

    public function store(StoreEmployeeRequest $request, EmployeeService $employeeService)
    {
        abort_unless(Gate::allows('employees_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create employees');

        $employee = $employeeService->setValidated($request->validated())->create();

        Toast::title("Employee $employee->employee_number created successfully")->autoDismiss(3);

        return redirect()->route('employees.index');
    }

    public function show(Employee $employee)
    {
        abort_unless(Gate::allows('employees_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access employees');

        return view('employees.show', [
            'employee' => $employee->load('department', 'designation', 'user:id,name', 'updater:id,name'),
        ]);
    }

    public function edit(Employee $employee)
    {
        abort_unless(Gate::allows('employees_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update employees');

        return view('employees.edit', [
            'employee' => $employee,
            'departments' => Department::pluck('name', 'id'),
            'designations' => Designation::pluck('name', 'id'),
            'offices' => Office::pluck('name', 'id'),
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee, EmployeeService $employeeService)
    {
        abort_unless(Gate::allows('employees_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update employees');

        $employeeService->setValidated($request->validated())->setEmployee($employee)->update();

        Toast::title("Employee $employee->employee_number updated successfully")->autoDismiss(3);

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee, EmployeeService $employeeService)
    {
        abort_unless(Gate::allows('employees_delete'), Response::HTTP_FORBIDDEN, 'You are not authorised to delete employees');

        $employeeService->setEmployee($employee)->delete();

        Toast::title("Employee $employee->employee_number deleted successfully")->autoDismiss(3);

        return redirect()->route('employees.index');
    }
}
