<x-tenant-app-layout>
    @php
        $breadcrumbLinks = [
            ['url' => route('app.dashboard'), 'text' => __('Dashboard')],
            ['url' => route('app.billing.subscriptions.index'), 'text' => __('Subscriptions')],
            ['text' => __('app.list')],
        ];
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title="__('Subscriptions')" :addNewAction="route('app.billing.subscriptions.create')" />
        </div>
    </x-slot>

    <table class="table border-y border-base-content/20">
        <thead>
            <tr>
                <th class="ps-4">Name</th>
                <th>Plan</th>
                <th>Price</th>
                <th>Status</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($subscriptions as $subscription)
                <tr>
                    <td class="ps-4 font-semibold">{{ $subscription->name }}</td>
                    <td>{{ $subscription->plan }}</td>
                    <td>{{ number_format($subscription->price, 2) }}</td>
                    <td>{{ $subscription->status }}</td>
                    <td class="text-end pe-4">
                        <a href="{{ route('app.billing.subscriptions.edit', $subscription) }}"
                            class="btn btn-xs btn-outline btn-primary">{{ __('Edit') }}</a>
                        <button type="button" class="btn btn-xs btn-outline btn-error"
                            onclick="document.getElementById('deleteResourceForm').action = '{{ route('app.billing.subscriptions.destroy', $subscription) }}';">{{ __('Delete') }}</button>
                    </td>
                </tr>
            @empty
                <x-common.no-record columns=5 />
            @endforelse
        </tbody>
    </table>

    {!! $subscriptions->links() !!}

</x-tenant-app-layout>
