<?php

namespace App\Notifications;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportUpdatedToGuest extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(Report $report)
    {
        $this->report = $report;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('報告の内容が更新されました')
            ->line("カテゴリー: " . $this->report->category->name)
            ->line("緯度: " . $this->report->latitude)
            ->line("経度: " . $this->report->longitude)
            ->line("内容: " . $this->report->detail)
            ->line("")
            ->line("対応状況: " . $this->report->status_name)
            ->line("対応予定日: " . $this->report->latestHistory->start_date . '~' . $this->report->latestHistory->end_date)
            ->line("対応完了日: " . $this->report->latestHistory->completed_at)
            ->line("")
            ->line("この内容で更新されました。")
            ->action('詳細確認', route("reports.show", $this->report));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
