<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Models\Category;
use App\Models\Reason;
use App\Models\Report;
use App\Models\ReportStatusHistory;
use App\Models\Status;
use App\Notifications\ReportCreatedToStaff;
use App\Notifications\ReportUpdatedToGuest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchReportRequest $request)
    {
        $categories = Category::all();
        $statuses = Status::all();

        $params = $request->query();
        $reports = Report::search($params)->orderBy('reported_at')->get();

        return view('reports.index', compact('reports', 'categories', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $statuses = Status::all();
        $reasons = Reason::all();
        return view('reports.create', compact('categories', 'statuses', 'reasons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // 送信された情報はRequestクラスのインスタンスとして$requestを定義
    public function store(StoreReportRequest $request)
    {
        $report = new Report($request->all());

        $file = $request->file('image');
        // ファイル名だけだと、重複の可能性があるのでランダムな値を付与
        $report->image = \Str::orderedUuid() . '_' . $file->getClientOriginalName();

        DB::beginTransaction();
        try {
            $report->save();  // 報告の保存

            $history = new ReportStatusHistory($request->all());  // フォームの内容を取得
            $history->report_id = $report->id;  // 保存した報告のidを取得
            $history->user_id = auth()->id();  // 認証したユーザーのidを取得
            $history->save();

            if (!Storage::putFileAs('images/reports', $file, $report->image)) {
                throw new \Exception('写真の保存に失敗しました。');
            }
            session()->flash('notice', '報告を登録しました。');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->withErrors($e->getMessage());
        }

        // カテゴリーごとの通知先にメールを送信する
        $report->category->notify(new ReportCreatedToStaff($report));

        return redirect()->route('reports.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        $categories = Category::all();
        $statuses = Status::all();
        $reasons = Reason::all();
        return view('reports.edit', compact('categories', 'statuses', 'reasons', 'report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportRequest $request, Report $report)
    {
        // 履歴を受け取ったデータで上書き
        $history = $report->latestHistory->fill($request->all());
        $history->user_id = auth()->id();

        // 変更があるか確認
        if ($history->isDirty()) {
            // 変更あり (新しい履歴)
            $history->replicate()->save();
            session()->flash('notice', '内容を更新しました');
        } else {
            // 変更なし (日付のみ更新)
            $history->updated_at = now();
            $history->save();
        }

        // 状況が更新された場合は報告の連絡先にメールを送信する
        if ($history->status_id != $history->getOriginal()['status_id']) {
            $report->notify(new ReportUpdatedToGuest($report));
        }

        return redirect()->route('reports.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
