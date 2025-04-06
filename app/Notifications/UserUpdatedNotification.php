<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $passwordChanged;
    protected $newPassword;
    protected $rolesChanged;
    protected $roles;

    public function __construct($passwordChanged = false, $newPassword = null, $rolesChanged = false, $roles = [])
    {
        $this->passwordChanged = $passwordChanged;
        $this->newPassword = $newPassword;
        $this->rolesChanged = $rolesChanged;
        $this->roles = $roles;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('login');
        $message = (new MailMessage)
            ->subject('Your Account Has Been Updated')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your account on HaisenServ has been updated by an administrator.');
            
        if ($this->passwordChanged) {
            $message->line('Your password has been changed. Your new password is:')
                    ->line($this->newPassword)
                    ->line('Please change your password after you login.');
        }
        
        if ($this->rolesChanged) {
            $message->line('Your account roles have been updated. Your current roles are:')
                    ->line(implode(', ', $this->roles));
        }
            
        return $message->action('Login to Your Account', $url)
                      ->line('Thank you for using our application!');
    }
}