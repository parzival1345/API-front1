 <!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>تأییدیه سفارش</title>
    <style>
        body {
            font-family: 'Tahoma', sans-serif;
        }
        .container {
            padding: 20px;
            background-color: #f8f8f8;
        }
        .content {
            background-color: #ffffff;
            padding: 30px;
        }
        .footer {
            text-align: center;
            margin-top: 10px;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <h1>سلام {{ $order->user->name }}،</h1>
        <p>سفارش شما با موفقیت ثبت شد. جزئیات سفارش به شرح زیر است:</p>
        <ul>
            <li>عنوان سفارش: {{ $order->title }}</li>
            <li>قیمت کل: {{ number_format($order->total_price) }} تومان</li>
        </ul>
        <p>می‌توانید وضعیت سفارش خود را از حساب کاربریتان پیگیری کنید.</p>
    </div>
    <div class="footer">
        با تشکر،<br>
        تیم پشتیبانی {{ config('app.name') }}
    </div>
</div>
</body>
</html>
