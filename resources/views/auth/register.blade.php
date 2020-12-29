<x-guest-layout>

    <x-auth-card class="sm:max-w-3xl">
        <h3 class="text-xl font-bold uppercase text-gray-700 text-center mt-4 mb-2">Register</h3>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="sm:flex sm:flex-wrap">
            @csrf

            <!-- Name -->
            <div class="sm:w-1/2 mt-4 px-2">
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="sm:w-1/2 mt-4 px-2">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="sm:w-1/2 mt-4 px-2">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="sm:w-1/2 mt-4 px-2">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <!-- University -->
            <div class="sm:w-1/2 mt-4 px-2">
                <x-label for="university" :value="__('University')" />

                <x-input id="university" class="block mt-1 w-full" type="text" name="university"
                    :value="old('university')" required autofocus />
            </div>

            <!-- Faculty -->
            <div class="sm:w-1/2 mt-4 px-2">
                <x-label for="faculty" :value="__('Faculty')" />

                <x-input id="faculty" class="block mt-1 w-full" type="text" name="faculty" :value="old('faculty')"
                    required autofocus />
            </div>

            <!-- Department -->
            <div class="sm:w-1/2 mt-4 px-2">
                <x-label for="department" :value="__('Department')" />

                <x-input id="department" class="block mt-1 w-full" type="text" name="department"
                    :value="old('department')" required autofocus />
            </div>

            <div class="flex flex-col items-center mt-8 sm:w-full mb-4">
                <x-button class="mb-4 px-16 py-3">
                    {{ __('Register') }}
                </x-button>

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </x-auth-card>

</x-guest-layout>
