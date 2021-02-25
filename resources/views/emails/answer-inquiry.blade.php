<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Answer</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap');

        body {
            margin: 2rem;
            font-family: 'Roboto', sans-serif;
        }

        p, td {
            font-weight: 100;
        }

        header {
            display: flex;
            justify-content: space-between;
        }

        #invoice, .sender {
            text-align: right;
        }

        order-detail {
            margin: 5rem;
        }
    </style>
</head>
<body>
    <header>
        <section id="logo"><img src="{{ asset('images/logo/logo.png') }}" width="150" alt="logo"></section>
    </header>
    <main>
        <section id="info">
            <div class="sender">
                <h4>Otantik Home</h4>
                <p>الأردن، شارع 24، بجوار مول السالم</p>
                <p>+999 12 533 37 97</p>
                <p>info@clouds-line.com</p>
            </div>
        </section>
        <section id="order-detail">
            <p>{{ $info['response'] }}</p>
        </section>
    </main>
</body>
</html>