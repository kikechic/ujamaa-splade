@php
    $printingTime = now();
@endphp
<table class="table mt-4 uppercase">
    <tbody>
        <tr>
            <td class="p-0 text-left" style="width: calc(100/3)%">
                <strong>Printed by: </strong>
                {{ auth()->user()->name }}
            </td>
            <td class="p-0 text-left" style="width: calc(100/3)%">
                <strong>{{ __('Date') }}: </strong>
                {{ fusion_date_format($printingTime) }}
            </td>
            <td class="p-0 text-right" style="width: calc(100/3)%">
                <strong>{{ __('Time') }}: </strong>
                {{ $printingTime->format('H:m:s A') }}
            </td>
        </tr>
    </tbody>
</table>
