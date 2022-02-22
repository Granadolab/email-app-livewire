<x-jet-dialog-modal wire:model="viewingModal">
    <x-slot name="title">
        @lang('Modal edit ')
    </x-slot>

        <x-slot name="content">
            @if (isset($currentModal))
              <form  wire:submit.prevent="updateInfo">
                <div>
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <input id="name" class="block mt-1 w-full" wire:model="name"   type="text" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" wire:model="email" type="email" name="email" value="{{$currentModal->email}}" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="dni" value="{{ __('DNI') }}" />
                    <x-jet-input id="dni" class="block mt-1 w-full" wire:model="dni" type="number" name="dni" value="{{$currentModalPerson->dni}}" required />
                </div>


                <div class="mt-4">
                    <x-jet-label for="phone" value="{{ __('Phone') }}" />
                    <x-jet-input id="phone" class="block mt-1 w-full" wire:model="phone" type="text" name="phone" value="{{$currentModalPerson->phone}}" required />
                </div>


                <div class="mt-4">
                    <x-jet-label for="birthday" value="{{ __('Birthday') }}" />
                    <x-jet-input id="birthday" class="block mt-1 w-full" wire:model="birthday" type="date" name="birthday" value="{{$currentModalPerson->birthday}}" required />
                </div>


                @livewire('locations')
              </form>


            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click.prevent="updateInfo"  wire:loading.attr="disabled">
                @lang('Update')
            </x-jet-secondary-button>
        </x-slot>


</x-jet-dialog-modal>
