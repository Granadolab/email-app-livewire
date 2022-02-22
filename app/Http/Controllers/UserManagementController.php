<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.manage-users');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $input)
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
                         $fail('The fiel'.$attribute.' doesnt have an age valid.');
                    }
                },
                'before:today',
                'date',
                'date_format:Y-m-d'
            ],
            'city'=>['required', 'integer']
        ])->validate();

        return DB::transaction(function () use ($input) {

            $user= User::updateOrCreate([
                'name' => $input['name'],
                'email' => $input['email'],
            ]);

            $user->person->updateOrCreate([
                'user_id'=>$user->id,
                'city_id'=>$input['city'],
                'dni'=>$input['dni'],
                'phone'=>$input['phone'],
                'birthday'=>$input['birthday']
            ]);

            return redirect()->route('users-management');
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
