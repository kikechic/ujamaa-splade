@seoTitle(__('Notifications'))
<x-app-layout>
    <x-panel class="max-w-5xl mx-auto">
        <x-slot:header>
            {{ __('Unread Notifications') }}
        </x-slot:header>
        <x-slot:actions>
            <x-splade-button type="link" confirm="Mark all as read" method="POST"
                confirm-text="Are you sure you want to mark all notifications as read?" :href="route('markNotification')">
                {{ __('Mark all as read') }}
            </x-splade-button>
        </x-slot:actions>
        <table class="text-sm w-full table-fixed">
            <tbody>
                @forelse($notifications as $notification)
                    <tr @class(['border-b', 'border-t' => $loop->first])>
                        <td class="pr-4 py-4 align-middle">
                            @if ($notification->type === 'App\Notifications\TimesheetReopenedNotification')
                                <p>
                                    [{{ $notification->created_at }}]
                                    Timesheet
                                    <x-splade-link class="hover:underline text-blue-500" modal :href="route('timesheets.edit', $notification->data['id'])">
                                        {{ $notification->data['number'] }}
                                    </x-splade-link>
                                    reopened.
                                </p>
                            @endif
                            @if ($notification->type === 'App\Notifications\TimesheetApprovedNotification')
                                <p>
                                    [{{ $notification->created_at }}]
                                    Timesheet
                                    <x-splade-link class="hover:underline text-blue-500" modal :href="route('timesheets.show', $notification->data['id'])">
                                        {{ $notification->data['number'] }}
                                    </x-splade-link>
                                    approved.
                                </p>
                            @endif
                            @if ($notification->type === 'App\Notifications\TimesheetRejectedNotification')
                                <p>
                                    [{{ $notification->created_at }}]
                                    Timesheet
                                    <x-splade-link class="hover:underline text-blue-500" modal :href="route('timesheets.show', $notification->data['id'])">
                                        {{ $notification->data['number'] }}
                                    </x-splade-link>
                                    rejected.
                                </p>
                            @endif
                            @if ($notification->type === 'App\Notifications\TimesheetReturnedNotification')
                                <p>
                                    [{{ $notification->created_at }}]
                                    Timesheet
                                    <x-splade-link class="hover:underline text-blue-500" modal :href="route('timesheets.edit', $notification->data['id'])">
                                        {{ $notification->data['number'] }}
                                    </x-splade-link>
                                    returned.
                                </p>
                                <p>
                                    {{ $notification->data['comment'] }}
                                </p>
                            @endif
                        </td>
                        <td class="w-20 align-middle">
                            <x-splade-link method="POST" class="text-sky-500 hover:underline float-right"
                                :href="route('markNotification', ['id' => $notification->id])">
                                {{ __('Mark as read') }}
                            </x-splade-link>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="py-10">
                            <span>
                                {{ __('There are no new notifications') }}
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </x-panel>
</x-app-layout>
