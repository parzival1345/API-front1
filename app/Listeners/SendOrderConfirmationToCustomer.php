<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderConfirmationToCustomer;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderConfirmationToCustomer
{
    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event)
    {
        $id=$event->orders->user_id;
        $email = User::find($id)->first('email');
        Mail::to($email)->send(new OrderConfirmationToCustomer($event->orders));
    }
}
