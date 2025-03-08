<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pay With bKash - Accounting Software</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #daebf6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .payment-container {
            background: #f8ced5;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            max-width: 400px;
            width: 100%;
            text-align: center;
            position: relative;
        }

        .logo-container {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #fff;
            border: 4px solid #e2e8f0;
            padding: 10px;
            position: absolute;
            top: -60px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; /* Ensures the image doesn't overflow the circular container */
        }

        .logo {
            width: auto; /* Maintain aspect ratio */
            /* height: 100%;  */
            max-width: 100%; /* Ensure it doesn't overflow */
        }

        .payment-container h2 {
            font-size: 1.5rem;
            color: #2d3748;
            margin-top: 70px;
            margin-bottom: 1rem;
        }

        .payment-container p {
            color: #4a5568;
            margin-bottom: 2rem;
        }

        .bkash-logo {
            width: 200px;
            margin: 0 auto 1.5rem;
        }

        .btn-pay {
            background: #0b7f96;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s ease;
        }

        .btn-pay:hover {
            background: #095f73;
        }

        .footer-text {
            margin-top: 1.5rem;
            font-size: 0.875rem;
            color: #718096;
        }

        /* Responsive Styles */
        @media (max-width: 600px) {
            .payment-container {
                padding: 1.5rem;
            }

            .logo-container {
                width: 100px;
                height: 100px;
                top: -50px;
            }

            .payment-container h2 {
                font-size: 1.25rem;
                margin-top: 60px;
            }

            .payment-container p {
                font-size: 0.875rem;
            }

            .bkash-logo {
                width: 150px;
            }

            .btn-pay {
                padding: 10px 20px;
                font-size: 0.875rem;
            }

            .footer-text {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 400px) {
            .payment-container {
                padding: 1rem;
            }

            .logo-container {
                width: 80px;
                height: 80px;
                top: -40px;
            }

            .payment-container h2 {
                font-size: 1.1rem;
                margin-top: 50px;
            }

            .payment-container p {
                font-size: 0.75rem;
                margin-bottom: 1.5rem;
            }

            .bkash-logo {
                width: 120px;
            }

            .btn-pay {
                padding: 8px 16px;
                font-size: 0.75rem;
            }

            .footer-text {
                font-size: 0.65rem;
            }
        }
    </style>
</head>
<body>
    <form method="get" action="{{ route('bkash-create-payment', ['user_id' => $user->id]) }}" class="payment-container">
        {{-- <input type="hidden" name="user_id" value="{{ $user->id }}"> --}}
        <!-- Software Logo -->
        <div class="logo-container">
            <img src="{{ asset('images/logo.png') }}" alt="Accounting Software Logo" class="logo" />
        </div>

        <!-- Heading -->
        <h2>Pay With bKash</h2>
        <p>Complete your payment securely using bKash.</p>

        <!-- bKash Logo -->
        <img src="{{ asset('images/bkash-logo.png') }}" alt="bKash Logo" class="bkash-logo" />

        <!-- Payment Button -->
        <button type="submit" class="btn-pay">Pay 500.00 BDT</button>

        <!-- Footer Text -->
        <p class="footer-text">Secured by bKash | Accounting Software</p>
    </form>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</body>
</html>