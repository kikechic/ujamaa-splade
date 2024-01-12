<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Response;
use App\Tables\LeaveTypesTable;
use App\Services\LeaveTypeService;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreLeaveTypeRequest;
use App\Http\Requests\UpdateLeaveTypeRequest;
use Illuminate\Support\Facades\Redirect;

class LeaveTypeController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('leave_types_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access leave types');

        return view('leave-types.index', [
            'leaveTypes' => LeaveTypesTable::class,
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('leave_types_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access leave types');

        return view('leave-types.create');
    }

    public function store(StoreLeaveTypeRequest $request, LeaveTypeService $leaveTypeService)
    {
        abort_unless(Gate::allows('leave_types_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access leave types');

        $leaveTypeService->setValidated($request->validated())->create();

        Toast::title("Leave type created.")->autoDismiss(3);

        return Redirect::route('leaveTypes.index');
    }

    public function show(LeaveType $leaveType)
    {
        abort_unless(Gate::allows('leave_types_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access leave types');

        return view('leave-types.show', [
            'leaveType' => $leaveType->load('user:id,name', 'updater:id,name'),
        ]);
    }

    public function edit(LeaveType $leaveType)
    {
        abort_unless(Gate::allows('leave_types_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access leave types');

        return view('leave-types.edit', [
            'leaveType' => $leaveType,
        ]);
    }

    public function update(UpdateLeaveTypeRequest $request, LeaveType $leaveType, LeaveTypeService $leaveTypeService)
    {
        abort_unless(Gate::allows('leave_types_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access leave types');

        $leaveTypeService->setValidated($request->validated())->setLeaveType($leaveType)->update();

        Toast::title("Leave type updated.")->autoDismiss(3);

        return Redirect::route('leaveTypes.index');
    }

    public function destroy(LeaveType $leaveType, LeaveTypeService $leaveTypeService)
    {
        abort_unless(Gate::allows('leave_types_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access leave types');

        $leaveTypeService->setLeaveType($leaveType)->delete();

        Toast::title("Leave type deleted.")->autoDismiss(3);

        return Redirect::route('leaveTypes.index');
    }
}
