<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Tables\OfficesTable;
use Illuminate\Http\Response;
use App\Services\OfficeService;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreOfficeRequest;
use App\Http\Requests\UpdateOfficeRequest;

class OfficeController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('offices_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access offices');

        return view('offices.index', [
            'offices' => OfficesTable::class
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('offices_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create offices');

        return view('offices.create');
    }

    public function store(StoreOfficeRequest $request, OfficeService $officeService)
    {
        abort_unless(Gate::allows('offices_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create offices');

        $officeService->setValidated($request->validated())->create();

        Toast::title("Office created successfully")->autoDismiss(3);

        return redirect()->route('offices.index');
    }

    public function show(Office $office)
    {
        abort_unless(Gate::allows('offices_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access offices');

        return view('offices.show', [
            'office' => $office->load('user:id,name', 'updater:id,name')
        ]);
    }

    public function edit(Office $office)
    {
        abort_unless(Gate::allows('offices_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update offices');

        return view('offices.edit', [
            'office' => $office
        ]);
    }

    public function update(UpdateOfficeRequest $request, Office $office, OfficeService $officeService)
    {
        abort_unless(Gate::allows('offices_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update offices');

        $officeService->setValidated($request->validated())->setOffice($office)->update();

        Toast::title("Office updated successfully")->autoDismiss(3);

        return redirect()->route('offices.index');
    }

    public function destroy(Office $office, OfficeService $officeService)
    {
        abort_unless(Gate::allows('offices_delete'), Response::HTTP_FORBIDDEN, 'You are not authorised to delete offices');

        $officeService->setOffice($office)->delete();

        Toast::title("Office deleted successfully")->autoDismiss(3);

        return redirect()->route('offices.index');
    }
}
