<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ userType: '{{ old('user_type', 'user') }}' }" class="w-full">

            {{-- Tab Buttons --}}
            <div class="mb-8 flex border-b border-d5">
                <button type="button" id="register-user-tab" @click="userType = 'user'"
                        :class="{ 'border-c1 text-c1': userType === 'user', 'border-transparent text-d5 hover:text-d4': userType !== 'user' }"
                        class="py-4 px-1 text-center border-b-2 font-semibold text-base w-1/2 focus:outline-none transition duration-150 ease-in-out">
                    Register as User
                </button>
                <button type="button" id="register-church-tab" @click="userType = 'church'"
                        :class="{ 'border-c1 text-c1': userType === 'church', 'border-transparent text-d5 hover:text-d4': userType !== 'church' }"
                        class="py-4 px-1 text-center border-b-2 font-semibold text-base w-1/2 focus:outline-none transition duration-150 ease-in-out">
                    Register a Church
                </button>
            </div>

            <x-validation-errors class="mb-4" />

            {{-- User Registration Form --}}
            <form method="POST" action="{{ route('register') }}" x-show="userType === 'user'" class="transition-all duration-300">
                @csrf
                <input type="hidden" name="user_type" value="user">
                <div class="space-y-6">
                    <div>
                        <x-label for="user-name" value="Your Name" class="text-base font-medium mb-1 text-d4" />
                        <x-input id="user-name" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="e.g., John Smith" />
                    </div>
                    <div>
                        <x-label for="user-email" value="Email" class="text-base font-medium mb-1 text-d4"/>
                        <x-input id="user-email" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com"/>
                    </div>
                    <div>
                        <x-label for="user-password" value="Password" class="text-base font-medium mb-1 text-d4"/>
                        <x-input id="user-password" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="password" name="password" required autocomplete="new-password" />
                    </div>
                    <div>
                        <x-label for="user-password-confirmation" value="Confirm Password" class="text-base font-medium mb-1 text-d4"/>
                        <x-input id="user-password-confirmation" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                </div>
                 @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-6">
                        <x-label for="user-terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="user-terms" required class="text-c1 focus:ring-c1"/>
                                <div class="ms-2 text-sm">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-d1 rounded-md">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-d1 rounded-md">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif
                <div class="flex items-center justify-end mt-8">
                    <a class="underline text-sm hover:text-d1 rounded-md" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-button class="ms-4 bg-c1 hover:bg-ch1 dark:bg-d1 dark:hover:bg-dh1 text-c3 text-base font-bold py-3 px-6">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>

            {{-- Church Registration Form --}}
            <form method="POST" action="{{ route('register') }}" x-show="userType === 'church'" x-cloak class="transition-all duration-300" style="display: none !important;">
                @csrf
                <input type="hidden" name="user_type" value="church">
                <div class="space-y-6">
                    <div>
                        <x-label for="church-name" value="Church Name" class="text-base font-medium mb-1 text-d4"/>
                        <x-input id="church-name" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="text" name="church_name" :value="old('church_name')" placeholder="e.g., First Community Church"/>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-label for="church-denomination-select" value="Denomination" class="text-base font-medium mb-1 text-d4"/>
                            <select name="denomination_id" id="church-denomination-select" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 rounded-full shadow-sm py-3 px-4 text-lg">
                                <option value="">Select a Denomination</option>
                                @foreach ($denominations as $denomination)
                                    <option value="{{ $denomination->id }}" @selected(old('denomination_id') == $denomination->id)>{{ $denomination->name }}</option>
                                @endforeach
                            </select>
                        </div>
                         <div>
                            <x-label for="church-country-select" value="Country" class="text-base font-medium mb-1 text-d4"/>
                            <select name="country_id" id="church-country-select" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 rounded-full shadow-sm py-3 px-4 text-lg">
                                <option value="">Select a Country</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}" @selected(old('country_id') == $country->id)>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div>
                        <x-label for="church-address" value="Address" class="text-base font-medium mb-1 text-d4"/>
                        <div class="space-y-2 mt-1">
                            <x-input id="church-address-line-1" class="block w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="text" name="address_line_1" :value="old('address_line_1')" placeholder="Street Address, e.g., 123 Main St"/>
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-2">
                                <x-input id="church-city" class="block md:col-span-3 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="text" name="city" :value="old('city')" placeholder="City"/>
                                <x-input id="church-postal-code" class="block md:col-span-2 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="text" name="postal_code" :value="old('postal_code')" placeholder="Postal Code"/>
                            </div>
                            <x-input id="church-state" class="block w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="text" name="state_province_region" :value="old('state_province_region')" placeholder="State / Province / Region"/>
                        </div>
                    </div>
                     <div>
                        <x-label for="church-website" value="Contact & Social Media" class="text-base font-medium mb-1 text-d4"/>
                         <div class="mt-1 grid grid-cols-1 md:grid-cols-3 gap-4">
                            <x-input id="church-website" class="block w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="url" name="website_url" :value="old('website_url')" placeholder="https://yourchurch.com"/>
                            <x-input id="church-instagram" class="block w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="url" name="instagram_url" :value="old('instagram_url')" placeholder="https://instagram.com/yourchurch"/>
                            <x-input id="church-facebook" class="block w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="url" name="facebook_url" :value="old('facebook_url')" placeholder="https://facebook.com/yourchurch"/>
                        </div>
                    </div>
                    <div>
                        <x-label for="church-email" value="Email" class="text-base font-medium mb-1 text-d4"/>
                        <x-input id="church-email" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="you@example.com"/>
                    </div>
                    <div>
                        <x-label for="church-password" value="Password" class="text-base font-medium mb-1 text-d4"/>
                        <x-input id="church-password" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="password" name="password" required autocomplete="new-password" />
                    </div>
                    <div>
                        <x-label for="church-password-confirmation" value="Confirm Password" class="text-base font-medium mb-1 text-d4"/>
                        <x-input id="church-password-confirmation" class="block mt-1 w-full bg-d3 border-d5 text-d4 focus:border-c1 focus:ring-c1 py-3 px-4 text-lg" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    <div class="pt-2">
                        <x-label value="Church Features & Amenities" class="text-base font-medium mb-1 text-d4"/>
                        <div class="p-4 border border-d5 rounded-md mt-2 bg-d3">
                            @livewire('filter-panel')
                        </div>
                    </div>
                </div>
                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-6">
                        <x-label for="church-terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="church-terms" required class="text-c1 focus:ring-c1"/>
                                <div class="ms-2 text-sm">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-d1 rounded-md">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-d1 rounded-md">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif
                <div class="flex items-center justify-end mt-8">
                    <a class="underline text-sm hover:text-d1 rounded-md" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <x-button class="ms-4 bg-c1 hover:bg-ch1 dark:bg-d1 dark:hover:bg-dh1 text-c3 text-base font-bold py-3 px-6">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>

