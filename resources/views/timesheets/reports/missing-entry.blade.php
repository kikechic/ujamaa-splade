<x-app-layout>
    <x-splade-modal position="top" class="!p-0">
        <x-splade-form method="GET" action="{{ route('timesheets.reports.missing') }}">
            <x-dialog-modal>
                <x-slot:title>
                    {{ __('Missing Timesheets Report') }}
                </x-slot:title>
                <x-slot:content>
                    <x-form-line-item required>
                        <x-slot:label>
                            {{ __('Timesheet Period') }}
                        </x-slot:label>
                        <x-splade-select name="timesheet_period_id" :options="$timesheetPeriods" choices />
                    </x-form-line-item>
                </x-slot:content>
                <x-slot:footer>
                    <x-splade-submit type="link" modal class="mr-1">
                        {{ __('Submit') }}
                    </x-splade-submit>
                    <x-splade-button type="button" @click="modal.close">
                        {{ __('Back') }}
                    </x-splade-button>
                </x-slot:footer>
            </x-dialog-modal>
        </x-splade-form>
    </x-splade-modal>
</x-app-layout>
