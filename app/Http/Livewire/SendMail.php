<?php

namespace App\Http\Livewire;

use App\Jobs\SendEmailtest;
use App\Mail\SentEmailTest;
use App\Models\ManageMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;



class SendMail extends Component
{

    public $subject = 'Un Mensaje nuevo', $destination='example@test.com', $message='Hi, how are you ?';
    public $details=[];

    /**
     * ! Send te email
     */
    public function send()
    {
        $details['destination']=$this->destination;
        $details['subject']=$this->subject;
        $details['message']=$this->message;
        //* dispatch Job queue for send emails
        dispatch(new SendEmailtest($details));
        $this->store();
    }

    public function shortCut()
    {
        $this->emit('ListMail');

    }


    /**
     * !Store in databases
     */
    public function store()
    {
        $create=ManageMail::updateOrCreate([
            'user_id'=>Auth::user()->id,
            'subject'=>$this->subject
        ],
        [
            'destination'=>$this->destination,
            'message'=>$this->message
        ]
        );
    }

    public function render()
    {
        return view('livewire.send-mail');
    }
}
