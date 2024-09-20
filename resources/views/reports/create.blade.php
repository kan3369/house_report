<x-app-layout>
    @slot('header')
        {{ _('報告登録') }}
    @endslot
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/2.4.0/Control.Geocoder.min.css">

    @include('reports._form', [
        'action' => route('reports.store'),
        'method' => 'POST',
        'buttonText' => __('登録'),
        'report' => null,
    ])

    <script>
        // プレビュー
        const fileForm = document.getElementById('imgFile'); // IDがimgFileの要素を取得
        const filePreview = document.getElementById('imgPreview'); // IDがimgPreviewの要素を取得

        // フォームの変更のイベントに処理を追加
        fileForm.onchange = function() {
            const reader = new FileReader(); // 読み込み用Readerを用意

            // Rederで読み込んだときの処理を追加
            reader.onload = function(e) {
                filePreview.src = e.target.result // 読み取りした内容をプレビュー用要素に指定
            };

            reader.readAsDataURL(this.files[0]); // フォームで読み込んだファイルをReaderで読み取り
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/perliedman-leaflet-control-geocoder/2.4.0/Control.Geocoder.min.js">
    </script>
    <script>
        // let map;
        // map = L.map('map');
        // //中心の経度緯度
        // const center = ['38.9866042', '141.1137843'];
        // //ズームレベル
        // const zoom = 12;
        // //マップの中心地とズームレベルを指定
        // map.setView(center, zoom);
        // const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '© <a href="http://osm.org/copyright">OpenStreetMap</a>',
        //     maxZoom: 19
        // });
        // tileLayer.addTo(map);
        // //住所検索機能
        // const option = {
        //     collapsed: false, //コントローラーの折り畳み
        //     placeholder: '住所を入力してください。', //プレースホルダーテキスト
        //     errorMessage: '見つかりませんでした',
        //     showUniqueResult: false,
        // }
        // L.Control.geocoder(option).addTo(map);

        // 地図表示
        // すべてのファイルが読み込まれてから処理
        window.onload = (e) => {
            // 地図表示
            const map = L.map('map').setView([38.9866042, 141.1137843], 15); // centerとzoomの値を指定
            L.tileLayer('http://tile.openstreetmap.jp/{z}/{x}/{y}.png').addTo(map); // 地図タイルを表示

            // フォーム要素を取得
            const lat = document.getElementById('latitude');
            const lng = document.getElementById('longitude');

            let clicked;
            let marker;

            // バリデーションエラー時のピン立て
            if (lat.value && lng.value) {
                clicked = true;
                marker = L.marker([lat.value, lng.value], {
                    draggable: true
                }).addTo(map);

                marker.on('dragend', function(event) {
                    const position = marker.getLatLng();

                    lat.value = position.lat;
                    lng.value = position.lng;
                });
            }

            // クリックでピン立て
            map.on('click', function(e) {
                if (clicked !== true) {
                    clicked = true;
                    marker = L.marker([
                        e.latlng['lat'],
                        e.latlng['lng']
                    ], {
                        draggable: true
                    }).addTo(map);

                    lat.value = e.latlng['lat'];
                    lng.value = e.latlng['lng'];

                    marker.on('dragend', function(event) {
                        const position = marker.getLatLng();

                        lat.value = position.lat;
                        lng.value = position.lng;
                    });
                }
            });
        }
    </script>
</x-app-layout>
