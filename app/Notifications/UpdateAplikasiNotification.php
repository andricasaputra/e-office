<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Contracts\NotificationsInterface;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Http\Controllers\Operasional\Admin\PengumumanController as Pengumuman;

class UpdateAplikasiNotification extends Notification
{
    use Queueable;

    /**
     * Untuk menyimpan isi pesan notifikasi
     *
     * @var string
     */
    public $message; 

    /**
     * Untuk menyimpan link yang akan dituju apabila 
     * pesan notifikasi di click
     *
     * @var string
     */
    public $link;

    /**
     * Create a new notification instance.
     *
     * @param string|null $message
     * @param string|null $link
     * @return void
     */
    public function __construct(Pengumuman $data)
    {
        $this->message  = $data->message;
        $this->link     = $data->link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [

            'message' => $this->message, 
            'link' => $this->link, 
            'type' => 'Aplikasi Update'
            
        ];
    }
}
