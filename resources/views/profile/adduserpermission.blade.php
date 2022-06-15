<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add User Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @if (session("Success"))
                    <div class="alert alert-success">{{session('Success')}}</div>
                    @endif
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('permission.store') }}">
                        @csrf

                        <!--Current Password -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                            {{-- @error('email')
                                <span>{{$message}}</span>
                            @enderror --}}
                        </div>

                        <!--New Password -->
                        <div class="mt-4">
                            <x-label for="permission_form" :value="__('Permission Form')" />

                            <x-input id="permission_form" class="block mt-1 w-full" type="text" name="permission_form"
                                :value="old('permission_form')" required autofocus />
                        </div>

                        <!--New Password Confirmation -->
                        <div class="mt-4">
                            <x-label for="active_status" :value="__('Active Status')" />

                            <x-input id="active_status" class="block mt-1 w-full" type="text" name="active_status"
                                :value="old('active_status')" required autofocus />
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
