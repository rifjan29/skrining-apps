<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="row">
        <div class="col-md-6 p-0">
            <div class="w-100 h-100 bg-gambar border">
                {{-- <div class="card-body p-0 "> --}}
                    <div class="position-absolute top-50 start-50 translate-middle text-center text">
                        <div class="mx-auto d-flex justify-content-center">
                            <img src="{{ asset('images/logo.png') }}" class="logo mx-auto" alt="Nest Dashboard" />
                        </div>
                        <h2 class="fw-bold text-white">SKRINING PASIEN</h2>
                        <p class="text-white">You can sign in to access with your existing account</p>
                    </div>
                    <img src="{{ asset('image.png') }}" class="img-fluid" alt="">
                    <div class="overlay"></div>
                {{-- </div> --}}
            </div>
        </div>
        <div class="col-md-6 p-0 align-items-stretch">
            <div class="card h-100 rounded-0">
                <div class="card-body h-100">
                    <h4 class="card-title mb-4">Sign in</h4>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-input-label for="password" :value="__('Password')" />

                            <x-text-input id="password" class="block mt-1 w-full"
                                            type="password"
                                            name="password"
                                            required autocomplete="current-password" />

                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <!-- Remember Me -->
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                            </label>
                        </div>

                        <div class="align-items-end mt-4">
                            <x-primary-button class="">
                                {{ __('Log in') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
