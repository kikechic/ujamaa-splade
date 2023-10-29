@php
    $user = \App\Models\User::find($userId);
    
    $signature = null;
    $url = '';
    
    if ($user) {
        $signature = $user->getFirstMedia('signatures');
    
        if ($signature) {
            $url = $signature->getUrl();
        }
    }
    
    if ($signature) {
        $signatureSize = \App\Helpers\Helpers::signatureSize($signature);
    }
@endphp

@if ($signature && $url)
    <img src="{{ $url }}" alt="signature" height="{{ $signatureSize->height }}"
        width="{{ $signatureSize->width }}">
@endif
