<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Order</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap');

        body {
            margin: 2rem;
            font-family: 'Roboto', sans-serif;
        }

        p, td {
            font-weight: 100;
        }

        header, #info {
            display: flex;
            justify-content: space-between;
        }

        #invoice, .sender {
            text-align: right;
        }

        table {
            margin-top: 3rem;
        }

        table tbody td {
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <section id="logo"><img src="{{ asset('images/logo/logo.png') }}" width="150" alt="logo"></section>
        <section id="invoice">
            <h4>Invoice</h4>
            <p>INVOICE NO.</p>
            <p>{{ $order->code }}</p>
            <p>INVOICE DATE</p>
            <p>{{ $order->created_at }}</p>
        </section>
    </header>
    <main>
        <section id="info">
            <div class="recepient">
                <h4>Recepient</h4>
                <p>{{ $customer->name }}</p>
                <p>{{ $customer->mobile }}</p>
                <p>{{ $customer->email }}</p>
            </div>
            <div class="sender">
                <h4>Otantik Home</h4>
                <p>الأردن، شارع 24، بجوار مول السالم</p>
                <p>+999 12 533 37 97</p>
                <p>info@clouds-line.com</p>
            </div>
        </section>
        <section id="order-detail">
            <p>{{ $msg }}</p>
            <table style="width:100%">
                <thead>
                    <th style="width: 60%">Item</th>
                    <th style="width: 20%">Qty</th>
                    <th style="width: 20%">Price</th>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['quantity'] }}</td>
                        <td>{{ $product['price'] }} {{ $currency }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td>Subtotal</td>
                        <td>{{ $order->products_price }} {{ $currency }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Discount</td>
                        <td>{{ $order->discount }} {{ $currency }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{ $order->payment_amount }} {{ $currency }}</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>