<x-tenant-app-layout>
    @php
        $breadcrumbLinks = [
            [
                'url' => route('app.dashboard'),
                'text' => __('Dashboard'),
            ],
            [
                'url' => route('app.users.index'),
                'text' => __('Users'),
            ],
            [
                'text' => __('app.list'),
            ],
        ];
    @endphp

    <x-slot name="header">
        <div class="p-4 space-y-6">
            <x-common.breadcrumb :links=$breadcrumbLinks :title="__('Users')" :addNewAction="route('app.users.create')" />
        </div>
    </x-slot>

    <table class="table border-y border-base-content/20">
        <thead>
            <tr>
                <th scope="col" class="ps-4">
                    <x-tables.sortable-header field="name" :current-sort="request('sort')">
                        Name
                    </x-tables.sortable-header>
                </th>
                <th scope="col">
                    <x-tables.sortable-header field="email" :current-sort="request('sort')">
                        Email
                    </x-tables.sortable-header>
                </th>
                <th scope="col">
                    <x-tables.sortable-header field="email_verified_at" :current-sort="request('sort')">
                        Email Verified At
                    </x-tables.sortable-header>
                </th>

                <th scope="col">
                    <span class="sr-only">Actions</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td class="ps-4 font-semibold">
                        {{ $user->name }}</td>
                    <td>
                        {{ $user->email }}</td>
                    <td>
                        {{ $user->email_verified_at ? $user->email_verified_at->diffForHumans() : 'Not verified' }}
                    </td>

                    <td class="text-end pe-4">
                        <a href="{{ route('app.users.edit', $user) }}"
                            class="btn btn-xs btn-outline btn-primary">{{ __('Edit') }}</a>
                        <button type="button" class="btn btn-xs btn-outline btn-error" aria-haspopup="dialog"
                            aria-expanded="false" aria-controls="delete-modal" data-overlay="#delete-modal"
                            onclick="document.getElementById('deleteResourceForm').action = '{{ route('app.users.destroy', $user) }}';">{{ __('Delete') }}</button>
                    </td>
                </tr>
            @empty
                <x-common.no-record columns=4 />
            @endforelse
        </tbody>
    </table>

    {!! $users->links() !!}

</x-tenant-app-layout>
