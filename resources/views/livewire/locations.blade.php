<div>

    <div class="form-group row">

        <label for="countries" class="col-md-4 col-form-label text-md-right">Country</label>

        <div class="flex flex-col w-full">

            <select wire:model="selectedCountry" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sml" name='countries'>

                <option value="" selected>Choose countries</option>

                @foreach($countries as $country)

                    <option value="{{ $country->id }}">{{ $country->name }}</option>

                @endforeach

            </select>

        </div>

    </div>


    @if (!is_null($states))

        <div class="form-group row">

            <label for="states" class="col-md-4 col-form-label text-md-right">State</label>


            <div class="flex flex-col w-full">

                <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="selectedState" name="state">

                    <option value="" selected>Choose State</option>

                    @foreach($states as $states)

                        <option value="{{ $states->id }}">{{ $states->name }}</option>

                    @endforeach

                </select>

            </div>

        </div>

    @endif

    @if (!is_null($cities))

    <div class="form-group row">

        <label for="cities" class="col-md-4 col-form-label text-md-right">City</label>


        <div class="flex flex-col w-full">

            <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" wire:model="selectedCity" name="city">

                <option value="" selected>Choose City</option>

                @foreach($cities as $city)

                    <option value="{{ $city->id }}">{{ $city->name }}</option>

                @endforeach

            </select>

        </div>

    </div>

@endif

</div>
