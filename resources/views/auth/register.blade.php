<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div x-data="{ userType: 'user' }" class="w-full">
            <!-- Tab Buttons -->
            <div class="mb-4 flex justify-center border-b border-gray-200">
                <button type="button" @click="userType = 'user'"
                        :class="{ 'border-indigo-500 text-indigo-600': userType === 'user', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': userType !== 'user' }"
                        class="py-4 px-1 text-center border-b-2 font-medium text-sm w-1/2 focus:outline-none">
                    Register as User
                </button>
                <button type="button" @click="userType = 'church'"
                        :class="{ 'border-indigo-500 text-indigo-600': userType === 'church', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': userType !== 'church' }"
                        class="py-4 px-1 text-center border-b-2 font-medium text-sm w-1/2 focus:outline-none">
                    Register a Church
                </button>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" name="user_type" :value="userType">

                <!-- User-Specific Fields -->
                <div x-show="userType === 'user'">
                    <div>
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    </div>
                </div>

                <!-- Church-Specific Fields -->
                <div x-show="userType === 'church'" x-cloak style="display: none !important;">
                    <div class="space-y-4">
                        <div>
                            <x-label for="church_name" value="{{ __('Church Name') }}" />
                            <x-input id="church_name" class="block mt-1 w-full" type="text" name="church_name" :value="old('church_name')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-label for="denomination_id" value="{{ __('Denomination') }}" />
                                <select name="denomination_id" id="denomination_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select a Denomination</option>
                                    @foreach ($denominations as $denomination)
                                        <option value="{{ $denomination->id }}" {{ old('denomination_id') == $denomination->id ? 'selected' : '' }}>{{ $denomination->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-label for="country_id" value="{{ __('Country') }}" />
                                <select name="country_id" id="country_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="">Select a Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <x-label for="address_line_1" value="{{ __('Address Line 1') }}" />
                            <x-input id="address_line_1" class="block mt-1 w-full" type="text" name="address_line_1" :value="old('address_line_1')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-label for="city" value="{{ __('City') }}" />
                                <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" />
                            </div>
                            <div>
                                <x-label for="state_province_region" value="{{ __('State / Province / Region') }}" />
                                <x-input id="state_province_region" class="block mt-1 w-full" type="text" name="state_province_region" :value="old('state_province_region')" />
                            </div>
                            <div>
                                <x-label for="postal_code" value="{{ __('Postal Code') }}" />
                                <x-input id="postal_code" class="block mt-1 w-full" type="text" name="postal_code" :value="old('postal_code')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <x-label for="website_url" value="{{ __('Website URL') }}" />
                                <x-input id="website_url" class="block mt-1 w-full" type="url" name="website_url" :value="old('website_url')" />
                            </div>
                            <div>
                                <x-label for="instagram_url" value="{{ __('Instagram URL') }}" />
                                <x-input id="instagram_url" class="block mt-1 w-full" type="url" name="instagram_url" :value="old('instagram_url')" />
                            </div>
                            <div>
                                <x-label for="facebook_url" value="{{ __('Facebook URL') }}" />
                                <x-input id="facebook_url" class="block mt-1 w-full" type="url" name="facebook_url" :value="old('facebook_url')" />
                            </div>
                        </div>

                        <!-- Livewire Filter Panel -->
                        <div class="mt-4">
                            <x-label value="{{ __('Church Features & Amenities') }}" />
                            <div class="p-4 border rounded-md mt-1">
                                @livewire('filter-panel')
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Common Fields -->
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />
                                <div class="ms-2">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ms-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
