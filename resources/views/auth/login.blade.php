
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
        
        h1 {
            text-align: center;
            font-size: 32px;
            font-weight: bold;
            color: #000000; /* Change to match your theme */
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }

        /* Adding an underline effect */
        h1::after {
            content: "";
            width: 100%;
            height: 4px;
            background-color: #ebc075; /* Accent color */
            position: absolute;
            left: 50%;
            bottom: 0;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .infield {
            position: relative;
            margin: 8px 0;
            width: 100%;
        }

        .infield label {
            position: absolute;
            /* top: 15%;  */
            /* left: 15px; */
            transform: translateY(-50%); /* Center vertically */
            color: #ffffff;
            font-size: 14px;
            pointer-events: none; /* Ensure the label doesn't interfere with input */
            transition: all 0.3s ease-in-out;
        }

        /* Input Styling */
        .infield input {
            width: 100%;
            padding: 15px 15px;
            background-color: transparent;
            border: 1px groove #474343;
            outline: none;
            border-bottom: 2px solid #ccc;
            transition: all 0.4s ease-in-out;
            margin: 15px 0px;
        }

        /* Border animation on focus */
        .infield input:focus {
            border-bottom: 4px solid #0059b1;
        }

        /* Move label up and out of the input box when focused or has text */
        .infield input:focus + label,
        .infield input:not(:placeholder-shown) + label {
            top: -30px; /* Move label above the input */
            left: 10px; /* Adjust horizontal position */
            transform: translateY(0); /* Reset vertical centering */
            font-size: 12px; /* Reduce font size */
            color: #d58f14; /* Change label color */
            background-color: #f6f5f7; /* Add background to make the label stand out */
            padding: 0 5px; /* Add padding for better readability */
        }

        /* Increase font-size of input when it has text */
        .infield input:not(:placeholder-shown) {
            font-size: 18px; /* Adjust the size as needed */
            font-weight: bold;
        }

        .infield input::placeholder{
            color: #cd8062;
            font-weight: 700;
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
   
    {{-- <div class="back"> --}}
        <!-- Session Status -->
        {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
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

        <form method="POST" action="{{ route('login') }}">
            @csrf
        
            <h1>Log In</h1>
        
            <!-- Email Field -->
            <div class="infield">
                <label for="email">Email</label>
                <input id="email" type="email" placeholder="Type Email Address" name="email" :value="old('email')" required autofocus autocomplete="username" />
                {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
            </div>
        
            <!-- Password Field -->
            <div class="infield">
                <label for="password">Password</label>
                <input id="password" type="password" placeholder="Type Password" name="password" required autocomplete="current-password" />
                {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
            </div>
        
            <!-- Forgot Password Link -->
            <a href="{{ route('password.request') }}" class="forgot">Forgot your password?</a>
        
            <!-- Submit Button -->
            <button type="submit">Sign In</button>
        </form>
    {{-- </div> --}}

    
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
                    value: 180,
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