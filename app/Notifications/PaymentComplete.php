<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PaymentComplete extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $payment;
    public function __construct($payment)
    {
        $this->payment=$payment;
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
        return (new MailMessage)
                    ->subject('Your Payment Has Been Completed')
                    ->greeting('Dear'.$this->payment->user->name.'..!')
                    ->line('Your Tuition Fee of this '.$this->payment->semester .' has been  completed.Your tuition fee amount is '. $this->payment->amount .'('.$this->payment->currency.')'.' by using '.$this->payment->payment_type .' payment method' )
                    ->action('Login', url('/'))
                    ->line('Thankyou for your payment.....');
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
