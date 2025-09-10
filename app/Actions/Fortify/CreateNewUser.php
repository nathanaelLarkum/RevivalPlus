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
        // This is the core of the logic. We validate based on the 'user_type'
        // hidden field from your registration form.
        if ($input['user_type'] === 'church') {
            $this->validateChurchRegistration($input);
        } else {
            $this->validateUserRegistration($input);
        }

        // We wrap the database creation in a transaction. This is a best practice.
        // It ensures that if creating the church fails for any reason, the user
        // account is not created either, preventing orphaned user records.
        return DB::transaction(function () use ($input) {
            $user = User::create([
                // If it's a church, use the church name as the user's name.
                // Otherwise, use the name they provided.
                'name' => $input['user_type'] === 'church' ? $input['church_name'] : $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            // If the user is registering a church, we create the church record
            // and attach all the selected tags from the filter panel.
            if ($input['user_type'] === 'church') {
                $church = $user->church()->create([
                    'name' => $input['church_name'],
                    'denomination_id' => $input['denomination_id'],
                    'country_id' => $input['country_id'],
                    'address_line_1' => $input['address_line_1'],
                    'city' => $input['city'],
                    'state_province_region' => $input['state_province_region'],
                    'postal_code' => $input['postal_code'],
                    'website_url' => $input['website_url'],
                    'instagram_url' => $input['instagram_url'],
                    'facebook_url' => $input['facebook_url'],
                    // NOTE: You will need a more robust way to get these later,
                    // perhaps from a geocoding API based on the address.
                    // For now, we'll use placeholders.
                    'latitude' => 0,
                    'longitude' => 0,
                    'timezone' => 'UTC',
                ]);

                // Attach all the tags from the checkboxes
                if (!empty($input['tags'])) {
                    $church->tags()->attach($input['tags']);
                }
            }

            return $user;
        });
    }

    /**
     * Validation rules for a standard user registration.
     */
    protected function validateUserRegistration(array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
    }

    /**
     * Validation rules for a church registration.
     */
    protected function validateChurchRegistration(array $input): void
    {
        Validator::make($input, [
            'church_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'denomination_id' => ['required', 'exists:denominations,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state_province_region' => ['required', 'string', 'max:255'],
            'postal_code' => ['required', 'string', 'max:255'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'], // Ensures every tag ID submitted is valid
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();
    }
}
