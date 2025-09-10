<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ loginType: '{{ old('login_type', 'user') }}' }" class="w-full">

            {{-- Tab Buttons --}}
            <div class="mb-8 flex border-b border-d5">
                <button type="button" id="login-user-tab" @click="loginType = 'user'"
                        :class="{ 'border-d1 text-d1': loginType === 'user', 'border-transparent text-d5 hover:text-d4': loginType !== 'user' }"
                        class="py-4 px-1 text-center border-b-2 font-semibold text-base w-1/2 focus:outline-none transition duration-150 ease-in-out">
                    User Login
                </button>
                <button type="button" id="login-church-tab" @click="loginType = 'church'"
                        :class="{ 'border-d1 text-d1': loginType === 'church', 'border-transparent text-d5 hover:text-d4': loginType !== 'church' }"
                        class="py-4 px-1 text-center border-b-2 font-semibold text-base w-1/2 focus:outline-none transition duration-150 ease-in-out">
                    Church Login
                </button>
            </div>

            <x-validation-errors class="mb-4" />

            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ $value }}
                </div>
            @endsession

            {{-- User Login Form --}}
            <div x-show="loginType === 'user'">
                <h2 class="text-2xl font-bold text-d4 text-center mb-6">User Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="login_type" value="user">
                    <div class="space-y-6">
                        <div>
                            <x-label for="user_login_identifier" value="Email or Username" class="text-base font-medium mb-1 text-d4"/>
                            <x-input id="user_login_identifier" class="block w-full" type="text" name="email" :value="old('email')" required autofocus placeholder="you@example.com or your_username" />
                        </div>
                        <div>
                            <x-label for="user_login_password" value="Password" class="text-base font-medium mb-1 text-d4"/>
                            <x-input id="user_login_password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-8">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm hover:text-d1 rounded-md" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <x-button class="ms-4 bg-c1 hover:bg-ch1 dark:bg-d1 dark:hover:bg-dh1 text-c3 text-base font-bold py-3 px-6">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </div>

            {{-- Church Login Form --}}
            <div x-show="loginType === 'church'" x-cloak>
                 <h2 class="text-2xl font-bold text-d4 text-center mb-6">Church Login</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="login_type" value="church">
                     <div class="space-y-6">
                        <div>
                            <x-label for="church_login_identifier" value="Church Name or Email" class="text-base font-medium mb-1 text-d4"/>
                            <x-input id="church_login_identifier" class="block w-full" type="text" name="email" :value="old('email')" required placeholder="First Community Church or church@example.com" />
                        </div>
                        <div>
                            <x-label for="church_login_password" value="Password" class="text-base font-medium mb-1 text-d4"/>
                            <x-input id="church_login_password" class="block w-full" type="password" name="password" required autocomplete="current-password" />
                        </div>
                    </div>
                    <div class="flex items-center justify-between mt-8">
                         @if (Route::has('password.request'))
                            <a class="underline text-sm hover:text-d1 rounded-md" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        <x-button class="ms-4 bg-c1 hover:bg-ch1 dark:bg-d1 dark:hover:bg-dh1 text-c3 text-base font-bold py-3 px-6">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </div>

        </div>
    </x-authentication-card>
</x-guest-layout>

