<?php

namespace App\Http\Controllers;

use App\Models\Workday;
use App\Tables\WorkdaysTable;
use App\Http\Controllers\Controller;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreWorkdayRequest;
use App\Http\Requests\UpdateWorkdayRequest;

class WorkdayController extends Controller
{
    public function index()
    {
        abort_unless(request()->user()->can('workdays_access'), 403, 'You are not authorised to access workdays');

        return view('fusion.workdays.index', [
            'workdays' => WorkdaysTable::class
        ]);
    }

    public function create()
    {
        abort_unless(request()->user()->can('workdays_create'), 403, 'You are not authorised to create workdays');
    }

    public function store(StoreWorkdayRequest $request)
    {
        abort_unless(request()->user()->can('workdays_create'), 403, 'You are not authorised to create workdays');

        return redirect()->route('workdays.index');
    }

    public function show(Workday $workday)
    {
        abort_unless(request()->user()->can('workdays_access'), 403, 'You are not authorised to access workdays');

        $workday->load('user:id,name', 'updater:id,name');

        return view('fusion.workdays.show', compact('workday'));
    }

    public function edit(Workday $workday)
    {
        abort_unless(request()->user()->can('workdays_update'), 403, 'You are not authorised to update workdays');

        return view('fusion.workdays.edit', [
            'workday' => $workday
        ]);
    }

    public function update(UpdateWorkdayRequest $request, Workday $workday)
    {
        abort_unless(request()->user()->can('workdays_update'), 403, 'You are not authorised to update workdays');

        $workday->update($request->validated());

        Toast::title("Workday updated successfully")->autoDismiss(3);

        return redirect()->route('workdays.index');
    }

    public function destroy(Workday $workday)
    {
        abort_unless(request()->user()->can('workdays_delete'), 403, 'You are not authorised to delete workdays');

        return redirect()->route('workdays.index');
    }
}
