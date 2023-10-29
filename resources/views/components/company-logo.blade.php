@php
	$company = \App\Models\Company::find(auth()->user()->current_company_id);

	$logo = null;
	$url = '';

	if ($company) {
	    $logo = $company->getFirstMedia('logos');

	    if ($logo) {
	        $url = $logo->getUrl();
	    }
	}

	if ($logo) {
	    $logoSize = \App\Helpers\Helpers::logoSize($logo);
	}
@endphp

@if ($logo && $url)
	<img
		src="{{ $url }}"
		alt="logo"
		height="{{ $logoSize->height }}"
		width="{{ $logoSize->width }}"
	>
@endif
