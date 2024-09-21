<x-app-layout>
    <x-slot name="header">
        {{ __('報告詳細') }}
    </x-slot>

    <div class="max-w-4xl mx-auto py-10 show_inner">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h2 class="text-lg font-bold property_name">物件名: {{ $report->property_name }}</h2>
            <p class="text"><span class="bold">物件ナンバー: </span>{{ $report->latestHistory->property_number }}</p>
            <p class="text"><span class="bold">住所: </span>{{ $report->latestHistory->address }}</p>
            <p class="text"><span class="bold">報告者: </span>{{ $report->category_name }}</p>
            <p class="text"><span class="bold">対応状況: </span>{{ $report->status_name }}</p>
            <p class="text"><span class="bold">実施日:
                </span>{{ $report->latestHistory->reported_at->format('Y/m/d') }}</p>
            <div class="time_wrap text">
                <p><span class="bold">開始時間: </span>{{ $report->latestHistory->start_time->format('H:i') }}</p>
                <p><span class="bold">終了時間: </span>{{ $report->latestHistory->end_time->format('H:i') }}</p>
            </div>
            <p class="text"><span class="bold">メールアドレス: </span>{{ $report->email }}</p>
            <p class="text"><span class="bold">コメント: </span>{{ $report->latestHistory->comment }}</p>

            <div class="mt-4">
                <h3 class="text-md font-bold">画像</h3>
                <img src="{{ $report->image_path }}" alt="" class="h-48 w-64 object-contain">
                <p><span class="bold">内容: </span>{{ $report->detail }}</p>
            </div>


            <div class="mt-10">
                <a href="{{ route('reports.index') }}" class="border border-black px-3 py-1">戻る</a>
            </div>
        </div>
    </div>
</x-app-layout>
