<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;

class Locations extends Component
{
    public $countries = NULL;
    public $states = NULL;
    public $cities = NULL;

    public $selectedCountry = NULL;
    public $selectedState = NULL;
    public $selectedCity = NULL;



    /**
     * ! Initialize all data in  models
     */


    /**
     * !Render view with livewire
     */

    public function render()
    {
        $this->countries = Country::all();

        $countries = $this->countries;

        return view('livewire.locations', compact('countries'));

    }



    public function updatedSelectedCountry($country_id)
    {

        $this->states = State::where('country_id', $country_id)->get();

    }

    public function updatedSelectedState($state_id)
    {

        $this->cities = City::where('state_id', $state_id)->get();

    }



}



