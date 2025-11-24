<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Studygroupnotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $group;
    public $newMember;
    public $members;

    /**
     * Create a new notification instance.
     *
     * @param $group The group object (should have name, etc)
     * @param $newMember The user object of the new member
     * @param $members Array of user objects (all group members)
     */
    public function __construct($group, $newMember, $members)
    {
        $this->group = $group;
        $this->newMember = $newMember;
        $this->members = $members;
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
            ->subject('A new member has joined your group: ' . ($this->group->name ?? 'Study Group'))
            ->greeting('Hello ' . ($notifiable->name ?? 'Member') . ',')
            ->line(($this->newMember->name ?? 'A user') . ' has been added to your group "' . ($this->group->name ?? '') . '".')
            ->line('Group: ' . ($this->group->name ?? ''))
            ->line('New Member: ' . ($this->newMember->name ?? ''))
            ->line('Email: ' . ($this->newMember->email ?? ''))
            ->line('You are receiving this because you are a member of this group.')
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
            'message' => ($this->newMember->name ?? 'A user') . ' joined your group "' . ($this->group->name ?? '') . '".',
            'group_id' => $this->group->id ?? null,
            'group_name' => $this->group->name ?? '',
            'new_member_id' => $this->newMember->id ?? null,
            'new_member_name' => $this->newMember->name ?? '',
            'new_member_email' => $this->newMember->email ?? '',
        ];
    }
}
