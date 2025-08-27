{{--
|--------------------------------------------------------------------------
| Guest Layout for Registration Page
|--------------------------------------------------------------------------
|
| This file contains the complete, updated Blade template for the user
| registration form. It now includes dynamic fields based on the
| selected user type ('user' or 'church'), incorporates the new color
| scheme, and is designed to be responsive for mobile devices.
|
--}}
<x-guest-layout>
    <x-slot name="title">Register</x-slot>

    {{-- Main authentication card container --}}
    <x-authentication-card class="bg-c3 dark:bg-d3 text-c4 dark:text-d4">
        {{-- Logo section at the top of the card --}}
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        {{-- Alpine.js data container for tab switching functionality --}}
        <div x-data="{ userType: '{{ old('user_type', 'user') }}' }">

            {{-- Tab navigation buttons section --}}
            <div class="flex border-b border-c5 dark:border-d5">
                {{-- User tab button --}}
                <button @click="userType = 'user'"
                    class="w-1/2 py-2 text-center transition-colors duration-200"
                    :class="userType === 'user' ? 'border-b-2 border-c1 dark:border-d1 font-bold text-c4 dark:text-d4' : 'text-c5 dark:text-d5 hover:text-c4 dark:hover:text-d4'">
                    User
                </button>
                {{-- Church tab button --}}
                <button @click="userType = 'church'"
                    class="w-1/2 py-2 text-center transition-colors duration-200"
                    :class="userType === 'church' ? 'border-b-2 border-c1 dark:border-d1 font-bold text-c4 dark:text-d4' : 'text-c5 dark:text-d5 hover:text-c4 dark:hover:text-d4'">
                    Church
                </button>
            </div>

            {{-- Main registration form --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Hidden input to track selected user type --}}
                <input type="hidden" name="user_type" :value="userType">

                {{--
                |--------------------------------------------------------------------------
                | User-Specific Fields Section
                |--------------------------------------------------------------------------
                |
                | This section is shown when the 'User' tab is active. It includes basic
                | fields for a personal user account.
                |
                --}}
                <div x-show="userType === 'user'" class="mt-4 space-y-4">
                    {{-- User Name input field --}}
                    <div>
                        <x-label for="user_name" value="Name" />
                        <x-input id="user_name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        @error('name') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{--
                |--------------------------------------------------------------------------
                | Church-Specific Fields Section
                |--------------------------------------------------------------------------
                |
                | This section is shown when the 'Church' tab is active. It includes all
                | the custom fields you specified for a church profile.
                |
                --}}
                <div x-show="userType === 'church'" class="mt-4 space-y-4">
                    {{-- Church Name input field --}}
                    <div>
                        <x-label for="church_name" value="Church Name" />
                        <x-input id="church_name" class="block mt-1 w-full" type="text" name="church_name" :value="old('church_name')" required />
                        @error('church_name') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Sunday Services Dropdown --}}
                    <div>
                        <x-label for="sunday_services" value="All Sunday Services" />
                        {{-- NOTE: This component is a placeholder. A custom component or livewire might be needed for a better user experience. --}}
                        <select name="sunday_services[]" id="sunday_services" multiple
                                class="border-c5 dark:border-d5 text-c4 dark:text-d4 bg-c3 dark:bg-d3 focus:border-c1 focus:ring-c1 rounded-md shadow-sm block mt-1 w-full">
                            <option value="morning">Morning service (Before 12:00)</option>
                            <option value="afternoon">Afternoon service (12:00-5:00)</option>
                            <option value="evening">Evening service (After 5:00)</option>
                        </select>
                        @error('sunday_services') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Address Fields --}}
                    {{--
                    | NOTE: A truly universal address form is not possible due to global variations.
                    | This structured approach is a robust and widely-used solution.
                    |
                    --}}
                    <div>
                        <x-label for="street" value="Address" />
                        <x-input id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street')" placeholder="Street Address" />
                        <x-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city')" placeholder="City" />
                        <div class="flex space-x-2 mt-1">
                            <x-input id="state" class="w-1/2" type="text" name="state" :value="old('state')" placeholder="State / Province" />
                            <x-input id="postal_code" class="w-1/2" type="text" name="postal_code" :value="old('postal_code')" placeholder="Postal Code" />
                        </div>
                        <x-input id="country" class="block mt-1 w-full" type="text" name="country" :value="old('country')" placeholder="Country" />
                        @error('street') <span class="text-warning text-sm mt-1">Please provide a street address.</span> @enderror
                        @error('city') <span class="text-warning text-sm mt-1">Please provide a city.</span> @enderror
                    </div>

                    {{-- Photos Input (select multiple) --}}
                    {{--
                    | NOTE: The `accept` attribute provides client-side guidance, but you MUST
                    | perform server-side validation to ensure security (e.g., check file size,
                    | mime type, and run through an image processor to prevent malicious uploads).
                    |
                    --}}
                    <div>
                        <x-label for="photos" value="Photos" />
                        <x-input id="photos" class="block mt-1 w-full" type="file" name="photos[]" multiple accept="image/jpeg,image/png,image/gif" />
                        @error('photos') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Website input field --}}
                    <div>
                        <x-label for="website" value="Website" />
                        <x-input id="website" class="block mt-1 w-full" type="url" name="website" :value="old('website')" placeholder="https://example.com" />
                        @error('website') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Instagram input field --}}
                    <div>
                        <x-label for="instagram" value="Instagram" />
                        <x-input id="instagram" class="block mt-1 w-full" type="text" name="instagram" :value="old('instagram')" placeholder="@username" />
                        @error('instagram') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Facebook input field --}}
                    <div>
                        <x-label for="facebook" value="Facebook" />
                        <x-input id="facebook" class="block mt-1 w-full" type="text" name="facebook" :value="old('facebook')" placeholder="pagename" />
                        @error('facebook') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{--
                |--------------------------------------------------------------------------
                | Common Fields for Both User Types
                |--------------------------------------------------------------------------
                |
                | These fields (email, password) are essential for every registration and
                | are displayed regardless of the selected tab.
                |
                --}}
                <div class="mt-4 space-y-4">
                    <div>
                        <x-label for="email" value="Email" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                        @error('email') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-label for="password" value="Password" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        @error('password') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <x-label for="password_confirmation" value="Confirm Password" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        @error('password_confirmation') <span class="text-warning text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Livewire 'Filter Panel' Component Placeholder --}}
                {{--
                | NOTE: This is a placeholder. You will need to create a Livewire component
                | named 'filter-panel' for this to work correctly.
                | For example: php artisan make:livewire filter-panel
                |
                --}}
                <div class="mt-4">
                    @livewire('filter-panel')
                </div>

                {{-- Submit button section --}}
                <div class="mt-4">
                    <x-button class="w-full bg-c4 hover:bg-ch4 dark:bg-d4 dark:hover:bg-dh4 text-c3 dark:text-d4 font-text">
                        Register as <span x-text="userType.charAt(0).toUpperCase() + userType.slice(1)" class="pl-1"></span>
                    </x-button>
                </div>

                {{-- 'Already registered?' link --}}
                <div class="text-sm mt-5 text-center">
                    {{ __('Already registered?') }}
                    <a class="font-medium text-c1 hover:text-ch1 dark:text-d1 dark:hover:text-dh1" href="{{ route('login') }}">
                        {{ __('Sign In') }}
                    </a>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
