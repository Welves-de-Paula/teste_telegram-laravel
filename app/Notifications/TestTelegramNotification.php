<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\TelegramFile;
use NotificationChannels\Telegram\TelegramPoll;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramContact;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Telegram\TelegramLocation;

class TestTelegramNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //

        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }



    public function toTelegram($notifiable)
    {


        return TelegramMessage::create()
            ->token($this->data['bot_token'])
            ->to(-704549771)
            ->content($this->data['message']);


        // return TelegramPoll::create()
        //     ->to(-704549771)
        //     ->question("Funcionou ?")
        //     ->choices(['Sim', 'Não', 'Deu ruim']);


        // return TelegramContact::create()
        //     ->to(-704549771)
        //     ->firstName('Welves')
        //     ->lastName('(Programador)')
        //     ->phoneNumber('5527992660994');



        // return TelegramFile::create()
        //     ->to(-704549771)
        //     ->content('Link ERP Apex (https://erp.apexsoftware.com.br/login)')
        //     ->photo('https://file-examples-com.github.io/uploads/2017/10/file_example_JPG_1MB.jpg');


        // return TelegramFile::create()
        //     ->to(-704549771)
        //     ->content('Did you know we can set a custom filename too?')
        //     ->document('https://file-examples-com.github.io/uploads/2017/10/file-sample_150kB.pdf', 'sample.pdf');


        // return TelegramLocation::create()
        //     ->to(-704549771)
        //     ->latitude('40.6892494')
        //     ->longitude('-74.0466891');
    }
}
