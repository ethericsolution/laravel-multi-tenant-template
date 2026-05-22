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
                'text' => $user->id ? __('Edit') : __('Create'),
            ],
        ];

        $title = $user->id ? __('Edit') . " {$user->name}" : __('Create User');

    @endphp

    <div class="max-w-7xl space-y-6 p-4">
        <x-common.breadcrumb :links=$breadcrumbLinks :title="$title" :goBackAction="route('app.users.index')" />

        <x-common.validation-errors />

        <form method="post" action="{{ $user->id ? route('app.users.update', $user) : route('app.users.store') }}"
            class="space-y-6 max-w-xl">
            @csrf

            @isset($user->id)
                @method('put')
            @endisset


            <x-form.input :label="__('Name')" name="name" :value="$user->name" required />

            <x-form.input type="email" :label="__('Email')" name="email" :value="$user->email" required />

            <!-- Password -->
            <x-form.password label="Password" name="password" required />

            <x-form.password label="Confirm Password" name="password_confirmation" required />

            <div class="space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('app.users.index') }}" class="btn btn-soft">Cancel</a>
            </div>
        </form>
    </div>
</x-tenant-app-layout>
