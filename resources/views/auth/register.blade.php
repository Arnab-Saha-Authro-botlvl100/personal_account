{{-- <x-guest-layout> --}}
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sign in || Sign up from</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    </head>
    
    <body>

        <div id="particles-js"></div>
        
        <div class="container" id="container">
            <div class="form-container sign-up-container">
              
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1 style="margin-top: 10px">Create Account</h1>
            
                    <!-- Form Fields -->
                    <div class="infield">
                        <input id="name" type="text" name="name" placeholder="Name" :value="old('name')" required autofocus autocomplete="name" />
                        <label></label>
                    </div>
            
                    <div class="infield">
                        <input id="phone" type="number" name="phone" placeholder="Phone" :value="old('phone')" required autofocus autocomplete="phone" />
                        <label></label>
                    </div>
            
                    <div class="infield">
                        <input id="email" type="email" name="email" placeholder="Email" :value="old('email')" required autocomplete="username" />
                        <label></label>
                    </div>
            
                    <div class="infield">
                        <input id="address" type="text" name="address" placeholder="Address" :value="old('address')" required autocomplete="username" />
                        <label></label>
                    </div>
            
                    <div class="infield">
                        <input id="password" type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                        <label></label>
                    </div>
            
                    <div class="infield">
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                        <label></label>
                    </div>
            
                    <button type="submit">Sign Up</button>
            
                    <div class="flex items-center justify-end mt-4" >
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                         href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    </div>
                </form>
            </div>
            <div class="form-container sign-in-container">
               
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                
                    <h1>Log In</h1>
                
                    <!-- Email Field -->
                    <div class="infield">
                        <input type="email" placeholder="Email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <label></label>
                        {{-- <x-input-error :messages="$errors->get('email')" class="mt-2" /> --}}
                    </div>
                
                    <!-- Password Field -->
                    <div class="infield">
                        <input type="password" placeholder="Password" name="password" required autocomplete="current-password" />
                        <label></label>
                        {{-- <x-input-error :messages="$errors->get('password')" class="mt-2" /> --}}
                    </div>
                
                    <!-- Forgot Password Link -->
                    <a href="{{ route('password.request') }}" class="forgot">Forgot your password?</a>
                
                    <!-- Submit Button -->
                    <button type="submit">Sign In</button>
                </form>
            </div>
            <div class="overlay-container" id="overlayCon">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button>Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button>Sign Up</button>
                    </div>
                </div>
                <button id="overlayBtn"></button>
            </div>
        </div>
    
     
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
        <!-- js code -->
        <script>
            const container = document.getElementById('container');
            const overlayCon = document.getElementById('overlayCon');
            const overlayBtn = document.getElementById('overlayBtn');
        
            overlayBtn.addEventListener('click', () => {
                // console.log('overlayBtn clicked');
                container.classList.toggle('right-panel-active'); 
            });
        </script>
    
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
{{-- </x-guest-layout> --}}
