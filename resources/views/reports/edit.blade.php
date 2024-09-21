<x-app-layout>
    @slot('header')
        {{ _('報告編集') }}
    @endslot

    @include('reports._form', [
        'action' => route('reports.update', $report),
        'method' => 'PATCH',
        'buttonText' => __('更新'),
        'report' => $report,
    ])
</x-app-layout>
