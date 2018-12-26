<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;

class VerifyEmail extends VerifyEmailBase
{
//    use Queueable;

    // change as you want
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable);
        }
        return (new MailMessage)
            ->subject('Preverjanje poštnega naslova')
            ->greeting("Pozdravljeni!")
            ->line("Nedavno ste se vi ali nekdo drug registrirali na naši spletni prodajalni.")
            ->line("Prosimo vas, da potrdite, da ste se res registrirali s klikom na spodnji gumb.")
            ->action(
                Lang::getFromJson('Res sem se registriral/a'),
                $this->verificationUrl($notifiable)
            )
            ->line('Če se niste registrirali in verjamete, da je prišlo do pomote, lahko prezrete to sporočilo.')
            ->line('Želimo vam veliko zabave pri nakupovanju.')
            ->salutation('Hvala in lep pozdrav!');
    }
}