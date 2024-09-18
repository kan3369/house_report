<x-app-layout>
    @slot('header')
        {{ _('報告登録') }}
    @endslot
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/2.4.0/Control.Geocoder.min.css">
    <div class="max-w-4xl mx-auto py-10 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="">
                    <h2 class="">{{ __('場所') }}</h2>
                    <input type="hidden" name="latitude" id="latitude">
                    <input type="hidden" name="longitude" id="longitude">
                    <div class="mt-0 col-span-2">
                        <div class="w-full h-80 border border-solid border-black">
                            <div class="h-full" id="map"></div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <h2 class="">{{ __('カテゴリー') }}</h2>
                    <div class="">
                        @foreach ($categories as $category)
                            <label>
                                <input type="radio" name="category_id" value="{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="">
                    <h2 class="">{{ __('写真') }}</h2>
                    <div class="">
                        <label>
                            <input type="file" name="image" id="imgFile" accept="image/*"
                                class="hidden input-preview__src">
                            <img id="imgPreview" class="w-full h-80 border border-solid border-black object-contain"
                                src="https://placehold.jp/15/ccc/000/300x300.png?text=%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB%E3%82%92%E9%81%B8%E6%8A%9E%E3%81%97%E3%81%A6%E3%81%8F%E3%81%A0%E3%81%95%E3%81%84">
                        </label>
                    </div>
                </div>

                <div class="">
                    <h2 class="">{{ __('内容') }}</h2>
                    <div class="">
                        <textarea name="detail" class=" "></textarea>
                    </div>
                </div>

                <div class="">
                    <h2 class="">{{ __('報告日') }}</h2>
                    <div class="">
                        <div class="">
                            <div class="">
                                <input type="datetime-local" name="reported_at" class="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <h2 class="">{{ __('対応状況') }}</h2>
                    <div class="">
                        <div class="">
                            <div class="">
                                <select name="status_id" class="">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id }}">
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <h2 class="">{{ __('非対応理由') }}</h2>
                    <div class="">
                        <div class="">
                            <div class="">
                                <select name="reason_id" class="">
                                    <option></option>
                                    @foreach ($reasons as $reason)
                                        <option value="{{ $reason->id }}">
                                            {{ $reason->name }}
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
                        <textarea name="comment" class=" "></textarea>
                    </div>
                </div>

                <div class="">
                    <h2 class="">{{ __('対応完了日') }}</h2>
                    <div class="">
                        <div class="">
                            <div class="">
                                <input type="date" name="completed_at" class="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <input type="submit" value="{{ __('登録') }}" class="border border-black px-3 py-1">
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/2.4.0/Control.Geocoder.min.js">
    </script>
    <script>
        let map;
        map = L.map('map');
        //中心の経度緯度
        const center = ['38.9866042', '141.1137843'];
        //ズームレベル
        const zoom = 12;
        //マップの中心地とズームレベルを指定
        map.setView(center, zoom);
        const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        });
        tileLayer.addTo(map);
        //住所検索機能
        const option = {
            collapsed: false, //コントローラーの折り畳み
            placeholder: '住所を入力してください。', //プレースホルダーテキスト
            errorMessage: '見つかりませんでした',
            showUniqueResult: false,
        }
        L.Control.geocoder(option).addTo(map);
    </script>
</x-app-layout>
