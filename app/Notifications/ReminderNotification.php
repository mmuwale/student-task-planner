<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $task;
    public $reminderTime;

    /**
     * Create a new notification instance.
     */
    public function __construct($task, $reminderTime = null)
    {
        $this->task = $task;
        $this->reminderTime = $reminderTime;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Reminder: ' . ($this->task->title ?? 'Task'))
            ->greeting('Hello ' . ($notifiable->name ?? 'User') . ',')
            ->line('This is a reminder for your task:')
            ->line('Title: ' . ($this->task->title ?? ''))
            ->line('Description: ' . ($this->task->description ?? ''))
            ->line('Due Date: ' . ($this->task->due_date ?? ''))
            ->when($this->reminderTime, function ($mail) {
                $mail->line('Reminder set for: ' . $this->reminderTime);
            })
            ->line('Please make sure to complete your task on time!')
            ->line('Thank you for using Student Task Planner!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'Reminder: Task "' . ($this->task->title ?? '') . '" is due soon.',
            'task_id' => $this->task->id ?? null,
            'title' => $this->task->title ?? '',
            'description' => $this->task->description ?? '',
            'due_date' => $this->task->due_date ?? '',
            'reminder_time' => $this->reminderTime,
        ];
    }
}
