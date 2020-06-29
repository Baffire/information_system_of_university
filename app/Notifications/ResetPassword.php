<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Сброс пароля')
            ->line('Вы получили это письмо, потому что с вашего аккаунта был отправлен запрос на сброс пароля.')
            ->action('Сбросить пароль', url('password/reset', $this->token))
            ->line('Эта ссылка для сброса пароля будет доступна в течение 60 минут. Если вы не отправляли запрос, проигнорируйте это письмо.');
    }
}
