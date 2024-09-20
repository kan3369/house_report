<x-app-layout>
    <x-slot name="header">
        {{ __('ユーザー編集') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.update', $user) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Name -->
                        <div class="mt-5 grid grid-cols-3 gap-6">
                            <h2 class="col-auto text-lg font-medium content-center">
                                {{ __('Name') }}
                            </h2>
                            <div class="col-span-2">
                                <input type="text" name="name" class="w-full"
                                    value="{{ old('name', $user->name) }}" class="w-full">
                            </div>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-5 grid grid-cols-3 gap-6">
                            <h2 class="col-auto text-lg font-medium content-center">
                                {{ __('Email') }}
                            </h2>
                            <div class="col-span-2">
                                <input type="email" name="email" class="w-full"
                                    value="{{ old('email', $user->email) }}">
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mt-5 grid grid-cols-3 gap-6">
                            <h2 class="col-auto text-lg font-medium content-center">
                                {{ __('Password') }}
                            </h2>
                            <div class="col-span-2">
                                <small>{{ __('パスワードを変更する場合のみ入力してください。') }}</small>
                                <input type="password" name="password" class="w-full">
                            </div>
                        </div>

                        <!-- Password Confirm -->
                        <div class="mt-5 grid grid-cols-3 gap-6">
                            <h2 class="col-auto text-lg font-medium content-center">
                                {{ __('Confirm Password') }}
                            </h2>
                            <div class="col-span-2">
                                <input type="password" name="password_confirmation" class="w-full">
                            </div>
                        </div>

                        <!-- Admin -->
                        <div class="mt-5 grid grid-cols-3 gap-6">
                            <h2 class="col-auto text-lg font-medium content-center">
                                {{ __('Admin') }}
                            </h2>
                            <div class="col-span-2">
                                <input type="checkbox" name="admin" value="1" @checked($user->is_admin)
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ms-4">
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
