<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserActivities extends Notification
{
    use Queueable;

    private $subject;
    private $heading;
    private $list;
    private $link;

    /**
     * Create a new notification instance.
     *
     * @param $subject
     * @param $heading
     * @param $list
     * @param $link
     */
    public function __construct($subject, $heading, $list, $link)
    {
        $this->subject = $subject;
        $this->heading = $heading;
        $this->list = $list;
        $this->link = $link;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = (new MailMessage)
            ->greeting("Hello Blade,")
            ->subject($this->subject ?? 'User Activity')
            ->bcc('raj@vbeasy.com')
            ->line($this->heading);

        if ($this->list) {
            $idx = 1;
            foreach ($this->list as $item) {
                $mail->line("{$idx}. {$item}");
                $idx++;
            }
        }
        if (!empty($this->link)) {
            $mail->action('Link', $this->link);
        }
        return $mail;
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
}
