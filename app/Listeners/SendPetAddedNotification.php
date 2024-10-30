<?php

namespace App\Listeners;

use App\Events\PetAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\PetAddedMail;

class SendPetAddedNotification
{

    public function handle(PetAdded $event)
    {
        // Send email to admin about the new pet
        Mail::to('kumarasirirandika0706@gmail.com')->send(new PetAddedMail($event->pet));
    }
}

