<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;

class ResetPasswordNotification extends ResetPasswordBase
{
//    use Queueable;
    
    public function toMail($notifiable)
    {
        
        $link = url( "/password/reset/".$this->token);

        return (new MailMessage)
            ->subject('Ponastavitev gesla')
            ->greeting("Pozdravljeni!")
            ->line("Nedavno ste si želeli spremeniti geslo. Pritisnite na spodnji gumb.")
            ->action(
                'Spremeni geslo', $link
            )
            ->line('Če niste zahtevali spremembe in verjamete, da je prišlo do pomote, lahko prezrete to sporočilo.')
            ->salutation('Hvala in lep pozdrav!');
    }
}