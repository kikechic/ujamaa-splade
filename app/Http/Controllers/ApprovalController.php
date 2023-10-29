<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Approval;
use App\Models\Employee;
use Illuminate\Http\Response;
use App\Tables\ApprovalsTable;
use App\Services\ApprovalService;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreApprovalRequest;
use App\Http\Requests\UpdateApprovalRequest;

class ApprovalController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('approvals_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access approvals');

        return view('approvals.index', [
            'approvals' => ApprovalsTable::class,
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('approvals_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create approvals');
    }

    public function store(StoreApprovalRequest $request)
    {
        abort_unless(Gate::allows('approvals_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create approvals');
    }

    public function show(User $user)
    {
        abort_unless(Gate::allows('approvals_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access approvals');

        return view('approvals.show', [
            'user' => $user->load([
                'approval' => [
                    'employee',
                    'approver',
                    'substitute'
                ]
            ])
        ]);
    }

    public function edit(User $user)
    {
        abort_unless(Gate::allows('approvals_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update approvals');

        return view('approvals.edit', [
            'user' => $user->load('approval'),
            'employees' => Employee::select('id', 'first_name', 'middle_name', 'last_name', 'employee_number')->get()->pluck('display_name', 'id'),
            'users' => User::whereNot('id', $user->id)->pluck('name', 'id'),
        ]);
    }

    public function update(UpdateApprovalRequest $request, User $user, ApprovalService $approvalService)
    {
        abort_unless(Gate::allows('approvals_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update approvals');

        $approvalService->setValidated($request->validated())->setApprovalUser($user)->update();

        Toast::title("Approval set up updated succesfully")->autoDismiss(3);

        return redirect()->route('approvals.index');
    }

    public function destroy(Approval $approval)
    {
        abort_unless(Gate::allows('approvals_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access approvals');

        return redirect()->route('approvals.index');
    }
}
