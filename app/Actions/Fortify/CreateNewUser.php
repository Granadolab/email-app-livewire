<?php

namespace App\Actions\Fortify;

use App\Models\Person;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;



class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;




    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'dni'=>['required','numeric','digits:11', 'unique:people'],
            'phone'=>['required','numeric','digits_between:8,11'],
            'birthday'=>[
                function ($attribute, $value, $fail) { //*This callback will calculate if user has  allow permissions for be register
                   $age =  Carbon::parse($value)->age;
                    if ($age < 15) {
                         $fail('The fiel'.$attribute.' doesn´t have an age valid.');
                    }
                },
                'before:today',
                'date',
                'date_format:Y-m-d'
            ],
            'city'=>['required', 'integer'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {

            $user= tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
            });

            //* Additionally will create a person like belong to user

            Person::create([
                'user_id'=>$user->id,
                'city_id'=>$input['city'],
                'dni'=>$input['dni'],
                'phone'=>$input['phone'],
                'birthday'=>$input['birthday']
            ]);

            return $user;
        });
    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
