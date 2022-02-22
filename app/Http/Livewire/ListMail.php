<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Person;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ManageMail;
use Illuminate\Support\Facades\Auth;

class ListMail extends DataTableComponent
{

    public function columns():array
    {
        return [
            Column::make('Title', 'subject')
                ->sortable()
                ->searchable(),
                Column::make('Destination', 'destination')
                ->sortable()
                ->searchable(),
            Column::make('Message', 'message')
                ->sortable()
                ->searchable()
        ];
    }

    public function query(): Builder
    {
        return ManageMail::query()->where([['user_id',Auth::user()->id]]);
    }


}
