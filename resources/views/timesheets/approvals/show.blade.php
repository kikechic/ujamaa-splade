<x-app-layout>
    <x-section-title>
        <x-slot name="title">
            {{ __('Approve Timesheet') }}
        </x-slot>
    </x-section-title>

    <x-section-border/>

    <x-panel>
        <x-splade-form method="POST" :action="route('timesheets.approvals.store', $timesheet)" :default="$timesheet">
            @include('fusion.human-resource.timesheets.partials.show', ['approving' => true])
            <x-form-actions>
                <x-splade-submit type="button"
                                 @click="form.approve = true; form.reject = false; form.return = false; form.submit()"
                                 :label="__('Approve')"/>
                <x-splade-submit danger type="button"
                                 @click="form.reject = true; form.approve = false; form.return = false; form.submit()"
                                 :label="__('Reject')"/>
                <x-splade-submit danger type="button"
                                 @click="form.return = true; form.reject = false; form.approve = false; form.submit()"
                                 :label="__('Return')"/>
            </x-form-actions>
        </x-splade-form>
    </x-panel>
</x-app-layout>
