<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Response;
use App\Tables\DesignationsTable;
use App\Services\DesignationService;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreDesignationRequest;
use App\Http\Requests\UpdateDesignationRequest;

class DesignationController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('designations_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access designations');

        return view('designations.index', [
            'designations' => DesignationsTable::class,
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('designations_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create designations');

        return view('designations.create');
    }

    public function store(StoreDesignationRequest $request, DesignationService $designationService)
    {
        abort_unless(Gate::allows('designations_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create designations');

        $designationService->setValidated($request->validated())->create();

        Toast::title("Designation created successfully")->autoDismiss(3);

        return redirect()->route('designations.index');
    }

    public function show(Designation $designation)
    {
        abort_unless(Gate::allows('designations_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access designations');

        return view('designations.show', [
            'designation' => $designation->load('user:id,name', 'updater:id,name')
        ]);
    }

    public function edit(Designation $designation)
    {
        abort_unless(Gate::allows('designations_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update designations');

        return view('designations.edit', [
            'designation' => $designation
        ]);
    }

    public function update(UpdateDesignationRequest $request, Designation $designation, DesignationService $designationService)
    {
        abort_unless(Gate::allows('designations_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update designations');

        $designationService->setValidated($request->validated())->setDesignation($designation)->update();

        Toast::title("Designation updated successfully")->autoDismiss(3);

        return redirect()->route('designations.index');
    }

    public function destroy(Designation $designation, DesignationService $designationService)
    {
        abort_unless(Gate::allows('designations_delete'), Response::HTTP_FORBIDDEN, 'You are not authorised to delete designations');

        $designationService->setDesignation($designation)->delete();

        Toast::title("Designation deleted successfully")->autoDismiss(3);

        return redirect()->route('designations.index');
    }
}
