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
    </script>
</x-app-layout>
