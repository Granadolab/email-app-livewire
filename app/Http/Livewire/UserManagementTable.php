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


class UserManagementTable extends DataTableComponent
{

    public $name, $email, $dni, $phone, $birthday, $city;

    // public $paginationEnabled = true;

    // public $responsive = true;

    //   public $perPageAccepted = [100, 200, 500];

    public  $viewingModal = false;

    public $currentModal;
    public $currentModalPerson;



    public function columns():array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
                Column::make('DNI', 'dni')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->sortable()
                ->searchable(),
                Column::make('Phone')
                ->sortable()
                ->searchable(),
                Column::make('Birthday', 'birthday')
                ->sortable()
                ->searchable(),
                Column::make('Age', 'birthday')
                ->sortable()
                ->format(function($value) {
                    return Carbon::parse($value)->age;
                }),
            Column::make('Created At', 'created_at')
                ->sortable()
                ->searchable(),
            Column::make('Updated At', 'updated_at')
                ->sortable()
                ->searchable(),
            Column::make('Actions', 'user_id')
            ->sortable()
            ->format(function($value) {
                return '
                <button type="button" wire:click.prevent ="viewHistoryModal('.$value.')">Edit</button>
                <button type="button" wire:click.prevent ="delete('.$value.')">delete</button>
                ';
            })
            ->asHtml()

        ];
    }


    public function updateInfo()
    {
        $input=[
            'name' => $this->name,
            'email' => $this->email,
            'city'=>$this->city,
            'dni'=>$this->dni,
            'phone'=>$this->phone,
            'birthday'=>$this->birthday
        ];

        return DB::transaction(function () use ($input) {

            $user= User::updateOrCreate([
                'email' => $input['email'],
            ],
            [
                'name' => $input['name'],
            ]);

            $user->person->updateOrCreate([
                'user_id'=>$user->id,
            ],
            [
                'city_id'=>$input['city'],
                'dni'=>$input['dni'],
                'phone'=>$input['phone'],
                'birthday'=>$input['birthday']
            ]
        );

            return redirect()->route('users-management');
        });

        session()->flash('message', $this->student_id ? 'Student updated.' : 'Student created.');
        $this->resetModal();
    }

    /**
     * @param modeId == id of user
     */
    public function viewHistoryModal($modelId): void
    {
        $this->viewingModal = true;
        $this->currentModal = User::findOrFail($modelId);
        $this->currentModalPerson = User::findOrFail($modelId)->person;

        $this->name = $this->currentModal->name;
        $this->email = $this->currentModal->email;
        $this->city = $this->currentModalPerson->city_id;
        $this->dni = $this->currentModalPerson->dni;
        $this->phone =$this->currentModalPerson->phone;
        $this->birthday = $this->currentModalPerson->birthday;

    }

    public function delete($id)
    {
        User::findOrFail($id)->person->delete();
        User::findOrFail($id)->delete();
        session()->flash('message', 'Studen deleted.');
    }

    public function resetModal(): void
    {
        $this->reset('viewingModal', 'currentModal');
    }

    public function modalsView(): string
    {
        return 'livewire.modal-edit';
    }

    public function query(): Builder
    {
        return User::query()->join('people', 'people.user_id', 'users.id');
    }


}
