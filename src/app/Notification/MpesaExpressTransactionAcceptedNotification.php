<?php

namespace Softwarescares\Safaricomdaraja\app\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class MpesaExpressTransactionAcceptedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /*
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
    */
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        Log::info("MpesaExpressTransactionAcceptedNotification");

        return [
        /*
          "MerchantRequestID" =>  $this->success->success["success"]["MerchantRequestID"],    
          "CheckoutRequestID" =>  $this->success->success["success"]["CheckoutRequestID"],    
          "ResponseCode" => $this->success->success["success"]["ResponseCode"],    
          "ResponseDescription" =>  $this->success->success["success"]["ResponseDescription"],    
          "CustomerMessage" =>  $this->success->success["success"]["CustomerMessage"]
          */
          "MerchantRequestID" => "29115-34620561-1",    
          "CheckoutRequestID" => "ws_CO_191220191020363925",    
          "ResponseCode" => "0",    
          "ResponseDescription" => "Success. Request accepted for processing",    
          "CustomerMessage" => "Success. Request accepted for processing"
        ];
    }
}
