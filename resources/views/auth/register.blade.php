<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <!--Location -->
            <div class="mt-2">
                <x-label for="location" :value="__('Company *')" />
                <select class="block mt-1 w-full" id="location" name="location" required autofocus >
                    <option value="AIAP">Aisin Asia Pacific</option>
                    <option value="ATAC">Aisin Thai Automotive</option>
                    <option value="SA">Siam Aisin</option>
                </select>
            </div>
            <!-- Email Address -->
            <div class="mt-2">
                <x-label for="email" :value="__('Email Account *')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
            <!--Employee ID-->
            <div class="mt-2">
                <x-label for="employee_id" :value="__('Employee ID (Windows Login ID) *')" />

                <x-input id="employee_id" class="block mt-1 w-full" type="text" name="employee_id" :value="old('employee_id')"
                style="text-transform:uppercase"  placeholder="Example: 095-AIAP, 0024-ATAC, 0251-SA " required autofocus />
            </div>
            <!--First Name -->
            <div class="mt-2">
                <x-label for="first_name" :value="__('First Name *')" />
                <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" style="text-transform:uppercase" required autofocus />
            </div>
            <!--Last Name -->
            <div class="mt-2">
                <x-label for="last_name" :value="__('Last Name *')" />
                <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" style="text-transform:uppercase" required autofocus />
            </div>
            <!--Section -->
            <div class="mt-2">
                <x-label for="section" :value="__('Section Name')" />

                <x-input id="section" class="block mt-1 w-full" type="text" name="section" :value="old('section')" style="text-transform:uppercase" />
            </div>
            <!--Department -->
            <div class="mt-2">
                <x-label for="department" :value="__('Department Name')" />

                <x-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department')" style="text-transform:uppercase"/>
            </div>
            <!--Division -->
            <div class="mt-2">
                <x-label for="division" :value="__('Division Name')" />

                <x-input id="division" class="block mt-1 w-full" type="text" name="division" :value="old('division')" style="text-transform:uppercase"/>
            </div>
            <!-- Password -->
            <div class="mt-2">
                <x-label for="password" :value="__('Password *')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>
            <!-- Confirm Password -->
            <div class="mt-2">
                <x-label for="password_confirmation" :value="__('Confirm Password *')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
