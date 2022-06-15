<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Permission') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />


                        @csrf

                        <!--Current Password -->
                        <div>
                            <x-label for="Menu" :value="__('Menu')" /> {{count($permissions)}}
                            @if (isset($permissions))
                                @foreach ($permissions as $key)
                                    <ul scope="col">{{$key->email}}</ul>
                                    <ul scope="col">{{$key->permission_id}}</ul>
                                    <ul scope="col">{{$key->active_status}}</ul>
                                    <ul scope="col">{{$key->created_at->DiffForHumans() }}</ul>
                                @endforeach
                            @endif
                        </div>


                        <div class="flex items-center justify-end mt-4">
                        </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
