<x-app-layout>
    @slot('header')
        {{ _('ユーザー一覧') }}
    @endslot

    <div class="max-w-4xl mx-auto py-10 lg:px-8">
        <div class="p-4 bg-white shadow rounded-lg">
            <table class="table-auto border-separate border-spacing-x-6 border-spacing-y-2">
                <thead>
                    <tr>
                        <th class="text-left">{{ __('Name') }}</th>
                        <th class="text-left">{{ __('Email') }}</th>
                        <th>{{ __('Admin') }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="text-left">{{ $user->name }}</td>
                            <td class="text-left">{{ $user->email }}</td>
                            <td class="text-center"><input type="checkbox"disabled @checked($user->admin)></td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}"
                                    class="border border-black text-sm px-2 py-1 mr-3">{{ __('Edit') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="ml-6 my-5">
                <a href="{{ route('register') }}" class="border border-black text-sm px-4 py-2">{{ __('ユーザー作成') }}</a>
            </div>
        </div>
    </div>
</x-app-layout>
