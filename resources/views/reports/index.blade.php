<x-app-layout>
    @slot('header')
        {{ _('報告一覧') }}
    @endslot

    {{-- 検索部分 --}}
    <div class="max-w-4xl mx-auto mt-5">
        <div class=" bg-white shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('reports.index') }}">
                <div class="grid grid-cols-3 gap-1 p-6">
                    <div class="col-span-1">
                        報告者
                    </div>
                    <div class="col-span-2">
                        <div class="grid grid-cols-2">
                            @foreach ($categories as $category)
                                <label>
                                    <input type="checkbox" name="category_id[]" value="{{ $category->id }}"
                                        @checked(in_array($category->id, old('category_id', request()->query('category_id')) ?? []))>
                                    {{ $category->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-span-1">
                        対応状況
                    </div>
                    <div class="col-span-2">
                        <div class="grid grid-cols-{{ $statuses->count() }} gap-1">
                            @foreach ($statuses as $status)
                                <label>
                                    <input type="checkbox" name="status_id[]" value="{{ $status->id }}" id=""
                                        @checked(in_array($status->id, old('status_id', request()->query('status_id')) ?? []))>
                                    {{ $status->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-span-1">
                        実施日
                    </div>
                    <input type="date" name="reported_start_date" class="py-0"
                        value="{{ old('reported_start_date',request()->has('reported_start_date')? request()->query('reported_start_date'): now()->addMonth(-1)->format('Y-m-d')) }}">
                    <input type="date" name="reported_end_date" class="py-0"
                        value="{{ old('reported_end_date', request()->query('reported_end_date')) }}">
                    <div class="flex mt-6">
                        <div class="border border-solid border-black p-1">
                            <input type="submit" value="検索">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- 一覧表示 --}}
    <div class="max-w-4xl mx-auto mt-5">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <div class="max-h-96 overflow-scroll scrollbar-hidden">
                <table class="table-auto w-full text-center">
                    <thead class="sticky top-0 bg-gray-100">
                        <tr>
                            <th></th>
                            <th>報告者</th>
                            <th>対応状態</th>
                            <th>実施日</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>
                                    <img src="{{ $report->image_path }}" alt=""
                                        class="h-16 w-20 object-contain">
                                </td>
                                <td>{{ $report->category_name }}</td>
                                <td>{{ $report->status_name }}</td>
                                <td>{{ $report->latestHistory->reported_at->format('Y/m/d') }}</td>
                                <td>
                                    {{ $report->latestHistory->completed_at?->format('Y/m/d') }}
                                </td>
                                <td>
                                    <a href="{{ route('reports.edit', $report) }}">
                                        <div
                                            class="border border-solid border-black py-1 px-3 rounded-md hover:bg-gray-300">
                                            編集
                                        </div>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('reports.show', $report) }}">
                                        <div
                                            class="border border-solid border-black py-1 px-3 rounded-md hover:bg-gray-300">
                                            詳細
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
