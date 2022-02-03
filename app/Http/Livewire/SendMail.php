<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Notifications\SendResult;
use App\Models\User;


class SendMail extends Component {
  public $gradeScoreValues,
        $studentName,
        $studentEmail = 'dictsocial@gmail.com',
        $showEmailModal = false,
        $buttonText = 'Send to Mail';

  public function render() {
    return view('livewire.send-mail')->extends('layouts.app');
  }

  public function sendMail(Request $request) {
    $this->buttonText = 'Sending...';
    
    $user = User::firstOrNew([
      'name' => $this->studentName,
      'email' => $this->studentEmail,
      'password' => 'password'
    ]);

    $user->notify(new SendResult($this->gradeScoreValues, $this->studentName));

    $this->showEmailModal = false;
    $this->buttonText = 'Send to Mail';

    $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Mail Sent Successfully!']);

    return;
  }
}
