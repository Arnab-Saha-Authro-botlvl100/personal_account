{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link rel="stylesheet" href="{{ asset('css/register.css') }}"> --}}
    <style>
        body {
            height: 100vh;
            margin: 0;
            display: grid;
            place-content: center;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6d84b2, #7b3b77, #77f089);
            background-size: 200% 200%;
            animation: gradientAnimation 10s ease infinite;
            position: relative; /* Ensure particles are positioned relative to the body */
            overflow: hidden; /* Prevent scrolling */
            /* filter: blur(2px); */
        }
       /* Container and Form Styling */
       .container {
            position: relative;
            height: auto;
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent background */
            backdrop-filter: blur(10px); /* Apply blur effect */
            box-shadow: 25px 30px 55px rgba(85, 85, 85, 0.3); /* Adjusted shadow */
            border-radius: 13px;
            overflow: hidden;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2); /* Optional: Add a subtle border */
        }

        .form-container {
            width: 100%;
            align-items: center;
            max-width: 400px;
            margin: 0 auto;
        }

        /* Text Styling */
        .mb-4 {
            margin-bottom: 1rem;
        }

        .text-sm {
            font-size: 0.875rem;
        }

        .text-gray-600 {
            color: #fc5f5f;
            font-weight: 500;
        }

        /* Input Field Styling */
        .infield {
            position: relative;
            margin: 8px 0;
            width: 100%;
        }

        .infield input {
            width: 100%;
            padding: 12px 15px;
            background-color: transparent;
            border: 1px solid #bdbdbd;
            outline: none;
            border-radius: 4px;
            transition: all 0.3s ease-in;
        }

        .infield input:focus {
            border-color: #17508a;
            box-shadow: 0 0 5px rgba(73, 94, 115, 0.5);
        }

        .infield label {
            position: absolute;
            
            transform: translateY(-50%);
            color: #999;
            font-size: 14px;
            pointer-events: none;
            transition: all 0.7s ease-in-out;
        }

        .infield input:focus + label,
        .infield input:not(:placeholder-shown) + label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #0059b1;
            background-color: #f6f5f7;
            padding: 0 5px;
        }

        .infield input::placeholder{
            color: white;
            font-weight: 700;
        }
        .primary-button {
            border-radius: 20px;
            border: none;
            background: linear-gradient(to right, #0059b1, #007bff);
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: background 0.5s ease-out;
        }

        .primary-button:hover {
            background: linear-gradient(to right, #007bff, #044382);
        }

        a {
            color: #adadfc;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
            
        }
        a.forgot {
            padding-bottom: 3px;
            border-bottom: 2px solid;
            margin-right: 5px;
            cursor: pointer;
        }

        .toast {
            position: fixed;
            top: 20px; /* Adjust the top spacing as needed */
            left: 20px; /* Adjust the left spacing as needed */
            z-index: 1050; /* Ensure the toast is above other elements */
        }
    
        button {
            border-radius: 20px;
            border: 1px solid rgba(61, 35, 129, 0.464);
            background: linear-gradient(to right, rgb(12, 57, 106), rgb(91, 93, 145)); /* Corrected gradient syntax */
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: background 0.3s ease; /* Optional: Add smooth transition */
        }

        button:hover {
            background: linear-gradient(to right, rgb(92, 97, 148), rgb(41, 23, 107)); /* Optional: Reverse gradient on hover */
        }

        .form-container button{
            margin-top: 17px;
            transition: 80ms ease-in;
        }

      
        #particles-js {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent; /* Ensure particles are transparent */
            z-index: -1; 
        }
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        @media (max-width: 498px){
            form{
                display: flex !important;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }
        }

    </style>
</head>

<body>
    <div id="particles-js"></div>

    
    <!-- Toast Container -->
    <div id="toast" class="toast align-items-center text-white bg-danger border-0 position-fixed top-0 end-0 m-3"
    style="background-color: red; color:aliceblue; font-weight:500; padding:10px" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <!-- Error messages will be inserted here -->
            </div>
            {{-- <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button> --}}
        </div>
    </div>


    <div class="container">
        <div class="form-container">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
    
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
    
                <!-- Email Address -->
                <div class="infield">
                    <input id="email" type="email" name="email" placeholder="Email" :value="old('email')" required autofocus />
                    {{-- <label for="email">Email</label> --}}
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
    
                <!-- Submit Button -->
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="primary-button">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if ($errors->any())
        <script>
            const errors = {!! json_encode($errors->all()) !!};
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                if (typeof errors !== 'undefined' && errors.length > 0) {
                    const toastEl = document.getElementById('toast');
                    const toastBody = toastEl.querySelector('.toast-body');
                    const errorMessage = errors.join('<br>');
                    toastBody.innerHTML = errorMessage;
                    const toast = new bootstrap.Toast(toastEl);
                    toast.show();
                }
            });
        </script>
    @endif

<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script>
    particlesJS("particles-js", {
        particles: {
            number: {
                value: 80,
                density: {
                    enable: true,
                    value_area: 800,
                },
            },
            color: {
                value: ["#f803fc", "#fcd703", "#03fceb"], // Array of colors
            },
            shape: {
                type: "circle",
                stroke: {
                    width: 0,
                    color: "#000000",
                },
            },
            opacity: {
                value: 0.5,
            },
            size: {
                value: 3,
                random: true,
            },
            line_linked: {
                enable: true,
                distance: 150,
                color: "#ffffff",
                opacity: 0.4,
                width: 1,
            },
            move: {
                enable: true,
                speed: 2,
                direction: "none",
                random: false,
                straight: false,
                out_mode: "out",
                bounce: false,
                attract: {
                    enable: false,
                    rotateX: 600,
                    rotateY: 1200,
                },
            },
        },
        interactivity: {
            detect_on: "canvas",
            events: {
                onhover: {
                    enable: true,
                    mode: "repulse",
                },
                onclick: {
                    enable: true,
                    mode: "push",
                },
                resize: true,
            },
        },
        retina_detect: true,
    });
</script>
</body>
</html>