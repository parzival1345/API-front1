        <x-slot name="logo">

        </x-slot>



        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{--{{ route('login') }}--}}">
            @csrf

            <div>
                <label for="email" value="{{ __('Email') }}" ></label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" >
            </div>

            <div class="mt-4">
                <label for="password" value="{{ __('Password') }}" ></label>
                <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" >
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <checkbox id="remember_me" name="remember" ></checkbox>
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <button class="ml-4">
                    {{ __('Log in') }}
                </button>
            </div>
            {{-- Laracoding Login with Google Demo--}}
            <div class="block mt-4">
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('login')}}">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png">
                    </a>
                </div>
            </div>
        </form>
