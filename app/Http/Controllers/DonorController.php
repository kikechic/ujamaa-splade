<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Tables\DonorsTable;
use Illuminate\Http\Response;
use App\Services\DonorService;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreDonorRequest;
use App\Http\Requests\UpdateDonorRequest;

class DonorController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('donors_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access donors');

        return view('donors.index', [
            'donors' => DonorsTable::class,
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('donors_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create donors');

        return view('donors.create');
    }

    public function store(StoreDonorRequest $request, DonorService $donorService)
    {
        abort_unless(Gate::allows('donors_create'), Response::HTTP_FORBIDDEN, 'You are not authorised to create donors');

        $donorService->setValidated($request->validated())->create();

        Toast::title("Donor created.")->autoDismiss(3);

        return redirect()->route('donors.index');
    }

    public function show(Donor $donor)
    {
        abort_unless(Gate::allows('donors_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access donors');

        return view('donors.show', [
            'donor' => $donor->load('user:id,name', 'updater:id,name')
        ]);
    }

    public function edit(Donor $donor)
    {
        abort_unless(Gate::allows('donors_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update donors');

        return view('donors.edit', [
            'donor' => $donor
        ]);
    }

    public function update(UpdateDonorRequest $request, Donor $donor, DonorService $donorService)
    {
        abort_unless(Gate::allows('donors_update'), Response::HTTP_FORBIDDEN, 'You are not authorised to update donors');

        $donorService->setValidated($request->validated())->setDonor($donor)->update();

        Toast::title("Donor updated.")->autoDismiss(3);

        return redirect()->route('donors.index');
    }

    public function destroy(Donor $donor, DonorService $donorService)
    {
        abort_unless(Gate::allows('donors_delete'), Response::HTTP_FORBIDDEN, 'You are not authorised to delete donors');

        $donorService->setDonor($donor)->delete();

        Toast::title("Donor deleted.")->autoDismiss(3);

        return redirect()->route('donors.index');
    }
}
