<?php

namespace LaraQA\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;

class NewAnswerSubmitted extends Notification
{
    use Queueable;
    public $question;
    public $answer;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($answer,$question,$name)
    {
        // initialize
        $this->name = $name;
        $this->answer=$answer;
        $this->question = $question;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','nexmo'];
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
                    ->line('A new answer was submited to your Question.')
                    ->line("$this->name just suggested:".$this->answer->content)
                    ->action('View all answers', route('questions.show',$this->question->id))
                    ->line('Thank you for using our laraqa questions and answers!');
    }

    public function toNexmo($notifiable)
    {
      return (new NexmoMessage)
              ->content("$this->name just submitted an answer to you question!! check it out now at Laraqa ");
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
