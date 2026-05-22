<x-layouts.guest>
    <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:max-w-md lg:p-8">
        <div class="flex items-center gap-3">
            <img src="https://pub-99de907071b34c5b818be772a36c0976.r2.dev/logo-icon.jpg" class="size-8" alt="brand-logo" />
            <h2 class="text-base-content text-xl font-bold">{{ config('app.name') }}</h2>
        </div>
        <div>
            <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Verify your email</h3>
            <p class="text-base-content/80">An activation link has been sent to your email address:
                {{ auth()->user()->email }}.
                Please check your inbox and click on the link to complete the activation process.</p>
        </div>
        <div class="space-y-4">

            @if (session('status') == 'verification-link-sent')
                <p class="text-success">
                    A new email verification link has been emailed to you!
                </p>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="mb-4 space-y-4">
                @csrf

                <button class="btn btn-lg btn-primary btn-gradient btn-block">Resend Verification Email</button>
            </form>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <p class="text-base-content/80 text-center">
                    Want to use a different account?
                    <button type="submit" class="link link-animated link-primary font-normal">Log Out</button>
                </p>
            </form>
        </div>
    </div>
</x-layouts.guest>
