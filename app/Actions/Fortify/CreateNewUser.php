<?php

namespace App\Actions\Fortify;

use App\Models\Church;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        $validator = Validator::make($input, [
            'user_type' => ['required', 'string', 'in:user,church'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        // Add conditional validation based on user type
        $validator->sometimes('name', ['required', 'string', 'max:255'], function ($input) {
            return $input['user_type'] === 'user';
        });

        $validator->sometimes(['church_name', 'denomination_id', 'country_id', 'address_line_1', 'city', 'state_province_region', 'postal_code'], ['required', 'string', 'max:255'], function ($input) {
            return $input['user_type'] === 'church';
        });

        $validator->sometimes(['website_url', 'instagram_url', 'facebook_url'], ['nullable', 'url', 'max:255'], function ($input) {
            return $input['user_type'] === 'church';
        });

        $validator->sometimes('tags', ['nullable', 'array'], function ($input) {
            return $input['user_type'] === 'church';
        });

        $validator->sometimes('tags.*', ['exists:tags,id'], function ($input) {
            return $input['user_type'] === 'church';
        });

        $validated = $validator->validate();

        return DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['user_type'] === 'church' ? $validated['church_name'] : $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            if ($validated['user_type'] === 'church') {
                $church = Church::create([
                    'name' => $validated['church_name'],
                    'denomination_id' => $validated['denomination_id'],
                    'country_id' => $validated['country_id'],
                    'address_line_1' => $validated['address_line_1'],
                    'city' => $validated['city'],
                    'state_province_region' => $validated['state_province_region'],
                    'postal_code' => $validated['postal_code'],
                    'website_url' => $validated['website_url'] ?? null,
                    'instagram_url' => $validated['instagram_url'] ?? null,
                    'facebook_url' => $validated['facebook_url'] ?? null,
                    // Placeholder values as requested
                    'latitude' => 0,
                    'longitude' => 0,
                    'timezone' => 'UTC',
                ]);

                if (!empty($validated['tags'])) {
                    $church->tags()->attach($validated['tags']);
                }
            }

            return $user;
        });
    }
}
