<x-app-layout>
    @slot('header')
        {{ _('報告一覧') }}
    @endslot

    {{-- 一覧表示 --}}
    <div class="max-w-4xl mx-auto mt-5">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <div class="max-h-96 overflow-scroll scrollbar-hidden">
                <table class="table-auto w-full text-center">
                    <thead class="sticky top-0 bg-gray-100">
                        <tr>
                            <th></th>
                            <th>カテゴリー</th>
                            <th>対応状態</th>
                            <th>非対応理由</th>
                            <th>報告日</th>
                            <th>完了日</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>
                                    <img src="{{ $report->image_path }}" alt="" class="h-12 w-12 object-contain">
                                </td>
                                <td>{{ $report->category_name }}</td>
                                <td>{{ $report->status_name }}</td>
                                <td>{{ $report->reason_name }}</td>
                                <td>{{ $report->reported_at->format('Y/m/d') }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
