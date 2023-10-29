<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Tables\CompaniesTable;
use App\Services\CompanyService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use ProtoneMedia\Splade\FileUploads\ExistingFile;

class CompanyController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        return view('companies.index', [
            'companies' => CompaniesTable::class
        ]);
    }

    public function create()
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        return view('companies.create', [
            'timezones' => fusion_timezones(),
        ]);
    }

    public function store(StoreCompanyRequest $request, CompanyService $companyService)
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        $companyService->setValidated($request->validated())->create();

        Toast::title('Company created successfully')->autoDismiss(3);

        return redirect()->route('companies.index');
    }

    public function show(Company $company)
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        $company->load('user:id,name', 'updater:id,name');

        $company->logo_url = ($media = $company->getFirstMedia('logos')) ? $media->getUrl() : '';

        return view('companies.show', [
            'company' => $company,
        ]);
    }

    public function edit(Company $company)
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        $company->logo = ExistingFile::fromMediaLibrary($company->getFirstMedia('logos'));

        return view('companies.edit', [
            'company' => $company,
            'timezones' => fusion_timezones(),
        ]);
    }

    public function update(UpdateCompanyRequest $request, Company $company, CompanyService $companyService)
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        $companyService->setValidated($request->validated())->setCompany($company)->update();

        Toast::title('Company updated successfully')->autoDismiss(3);

        return redirect()->route('companies.index');
    }

    public function destroy(Company $company, CompanyService $companyService)
    {
        abort_unless(Gate::allows('companies_access'), Response::HTTP_FORBIDDEN, 'You are not authorised to access companies');

        $companyService->setCompany($company)->delete();

        Toast::title('Company deleted successfully')->autoDismiss(3);

        return redirect()->route('companies.index');
    }

    public function switch(Request $request)
    {
        if ($request->new_company) {
            User::query()->where('id', auth()->id())->update([
                'current_company_id' => $request->new_company
            ]);
        }

        return redirect()->route('home');
    }
}
