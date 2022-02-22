
<div class="flex flex-row p-6 ">
   <div class='flex flex-col-8'>
    <div>
        <x-jet-label for="subject" value="{{ __('Subject') }}" />
        <x-jet-input id="subject" class=" mt-1 px-2 w-48" type="text" name="subject"  wire:model='subject' required autofocus autocomplete="name" />
    </div>
    <div>
        <x-jet-label for="detination" value="{{ __('Destination ') }}" />
        <x-jet-input id="detination" class=" mt-1 px-2 w-48" type="email" name="detination" wire:model="destination"  required />
    </div>
    <div>
        <x-jet-label for="message" value="{{ __('Message') }}" />
        <x-jet-input id="message" class=" mt-1 px-2 w-48" type="text" name="message" wire:model="message"  required />
    </div>
   </div>
   <div class='flex flex-col p-6 justify-center'>
      <div class='p-12'>
        <button wire:click.prevent="send" wire:click.prevent="shortCut" >Enviar</button>
      </div>
   </div>
</div>
