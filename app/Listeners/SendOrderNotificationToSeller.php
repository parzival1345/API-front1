<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Mail\OrderNotificationToSeller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderNotificationToSeller
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event)
    {
        $orders = $event->orders;
        $user_id = $orders->user_id;
        $ids = Order::with('products')->where('user_id', $user_id)->get();
        foreach ($ids as $id) {
            $seller_ids = $id->products;
            foreach ($seller_ids as $seller_id) {
                $user_seller = $seller_id->user_id;
                $email = User::find($user_seller)->first('email');
                Mail::to($email)->send(new OrderNotificationToSeller($orders));
            }
        }
    }
}
