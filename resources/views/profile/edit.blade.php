<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('profile.update') }}">
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
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email',$profile->email)" required autofocus/>
                        </div>

                        <!-- Employee ID -->
                        <div class="mt-2">
                            <x-label for="employee_id" :value="__('Employee ID (Windows Login ID) *')" />
                            <x-input id="employee_id" class="block mt-1 w-full" type="text" name="employee_id"
                                    :value="old('employee_id',$profile->employee_id)" style="text-transform:uppercase" required autofocus/>
                        </div>

                        <!--First Name -->
                        <div class="mt-2">
                            <x-label for="first_name" :value="__('First Name')" />
                            <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                                :value="old('first_name',$profile->first_name)" style="text-transform:uppercase"  required autofocus />
                        </div>

                        <!--Last Name -->
                        <div class="mt-2">
                            <x-label for="last_name" :value="__('Last Name')" />
                            <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                                :value="old('last_name',$profile->last_name)" style="text-transform:uppercase"  required autofocus />
                        </div>

                        <!--Section -->
                        <div class="mt-2">
                            <x-label for="section" :value="__('Section Name')" />

                            <x-input id="section" class="block mt-1 w-full" type="text" name="section"
                            :value="old('section',$profile->section)" style="text-transform:uppercase"/>
                        </div>
                        <!--Department -->
                        <div class="mt-2">
                            <x-label for="department" :value="__('Department Name')" />

                            <x-input id="department" class="block mt-1 w-full" type="text" name="department"
                            :value="old('department' ,$profile->department)" style="text-transform:uppercase"/>
                        </div>
                        <!--Division -->
                        <div class="mt-2">
                            <x-label for="division" :value="__('Division Name')" />

                            <x-input id="division" class="block mt-1 w-full" type="text" name="division"
                            :value="old('division' ,$profile->division)" style="text-transform:uppercase"/>
                        </div>


                        <div class="flex items-center justify-end mt-4">

                            <x-button class="ml-4">
                                {{ __('Save') }}
                            </x-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
