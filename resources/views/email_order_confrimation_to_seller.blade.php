<!-- resources/views/emails/order-notification-to-seller.blade.php -->

<p>سلام!</p>

<p>سفارش جدیدی با عنوان "{{ $order->title }}" از طرف کاربر "{{ $order->user->name }}" ثبت شده است.</p>

<h3>محصولات خریداری شده:</h3>
<ul>
    @foreach ($order->products as $product)
        <li>
            نام محصول: {{ $product->name }}
            - تعداد: {{ $product->pivot->count }}
        </li>
    @endforeach
</ul>

<p>مجموع قیمت: {{ $order->total_price }}</p>

<p>با تشکر</p>
