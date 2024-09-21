<div class="max-w-4xl mx-auto py-10 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if ($method != 'POST')
                @method($method)
            @endif
            <div class="">
                <h2 class="">{{ __('住所') }}</h2>
                <input type="text" name="address" class="w-full">
            </div>

            <div class="">
                <h2 class="">{{ __('物件名') }}</h2>
                <input type="text" name="property" class="w-full">
            </div>

            <div class="">
                <h2 class="">{{ __('物件ナンバー') }}</h2>
                <input type="text" name="property_number" class="w-full">
            </div>

            <div class="">
                <h2 class="">{{ __('写真（最大10枚まで）') }}</h2>
                <div class="">
                    <label>
                        <input type="file" name="image" id="imgFile" accept="image/*"
                            class="hidden input-preview__src">
                        <img id="imgPreview" class="w-full h-80 border border-solid border-black object-contain"
                            src="{{ $report?->image_path ?? 'https://placehold.jp/15/ccc/000/300x300.png?text=%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%92%E9%81%B8%E6%8A%9E%E3%81%97%E3%81%A6%E3%81%8F%E3%81%A0%E3%81%95%E3%81%84' }}">
                    </label>
                </div>
            </div>

            <div class="">
                <h2 class="">{{ __('内容') }}</h2>
                <div class="">
                    <textarea name="detail" class="w-full h-full">{{ old('detail', $report?->detail) }}</textarea>
                </div>
            </div>

            <div class="">
                <h2 class="">{{ __('対応状況') }}</h2>
                <div class="">
                    <div class="">
                        <div class="">
                            <select name="status_id" class="">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}" @selected(old('status_id', $report?->latestHistory->status_id) == $status->id)>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">
                <h2 class="">{{ __('コメント') }}</h2>
                <div class="">
                    <textarea name="comment" class="w-full h-full">{{ old('comment', $report?->latestHistory->comment) }}</textarea>
                </div>
            </div>

            <div class="">
                <h2 class="">{{ __('実施日') }}</h2>
                <input type="date" name="reported_at" class="w-full"
                    value="{{ old('reported_at', $report?->reported_at) }}">
            </div>

            <div class="">
                <h2 class="">{{ __('実施時間(開始〜完了)') }}</h2>
                <input type="time" name="start_time" required>
                <input type="time" name="end_time" required>
            </div>

            <div class="">
                <h2 class="">{{ __('報告者') }}</h2>
                <div class="">
                    @foreach ($categories as $category)
                        <label>
                            <input type="radio" name="category_id" value="{{ $category->id }}"
                                @checked(old('category_id', $report?->category_id) == $category->id)>
                            {{ $category->name }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="">
                <h2 class="">{{ __('メールアドレス') }}</h2>
                <input type="email" name="email" class="w-full">
            </div>

            <div class="mt-10">
                <input type="submit" value="{{ $buttonText }}" class="border border-black px-3 py-1">
            </div>
        </form>
    </div>
</div>
