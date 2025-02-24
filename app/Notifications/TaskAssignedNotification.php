<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\Task;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskAssignedNotification extends Notification
{
    use Queueable;

    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task->load('project'); // Charge la relation project
    }


    public function via($notifiable)
    {
        return ['mail', 'database']; // Envoie la notification par email et enregistre-la dans la base de données
    }

    public function toMail($notifiable)
    {
        dd($this->task->project_id, $this->task->id);

        return (new MailMessage)
                    ->line('Vous avez été assigné à la tâche : ' . $this->task->title)
                    ->action('Voir la tâche', route('tasks.show', [
                        'project' => $this->task->project_id, // Utilisation du project_id de la tâche
                    ]))
                    ->line('Merci de vous occuper de cette tâche.');
    }


    public function toDatabase($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'message' => 'Vous avez été assigné à la tâche ' . $this->task->title,
        ];
    }
}

