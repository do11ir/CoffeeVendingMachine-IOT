<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body>
    <h1>سفارش شما با موفقیت ثبت شد!</h1>
    <p>کد سفارش: {{ $order->random_code }}</p>
    <p>روش پرداخت: {{ $order->payment_method }}</p>
    
    <h2>جزئیات نوشیدنی‌های سفارش شده:</h2>
    <ul>
        @foreach($order->drinks as $drink)
        <li>
            <strong>{{ $drink->name }}</strong> (x{{ $drink->pivot->quantity }}) - 
            Price: {{ $drink->price }} 
        </li>
    @endforeach
    </ul>

    <a href="/order">بازگشت به صفحه اصلی</a>
</body>
</html>
