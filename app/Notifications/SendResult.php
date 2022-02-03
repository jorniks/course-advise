<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Lang;

class SendResult extends Notification {
    use Queueable;

    protected $gradeScoreValues, $studentName;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($gradeScoreValues, $studentName) {
      $this->gradeScoreValues = $gradeScoreValues;
      $this->studentName = $studentName;
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
                    ->subject(Lang::get('YOUR PERFORMANCE RECOMMENDATION'))
                    ->greeting("Hello ". $this->studentName ."!")
                    ->line("Your highest cumulative unit is in **". $this->gradeScoreValues['course'] ."** with total point of")
                    ->line(new HtmlString("<h1 style=\"text-align:center\"> ". $this->gradeScoreValues['unitScore'] ." </h1>"))
                    ->line("After analyzing your performance over the course of four (4) semesters, it is observed that you perform better in courses related to ". $this->gradeScoreValues['course'] .". Therefore you are adviced to go for ". $this->gradeScoreValues['course'] ." related courses such as ". $this->gradeScoreValues['suggestion1'] ." or ". $this->gradeScoreValues['suggestion2'] .".")
                    ->line('')
                    ->line("With an average score of ". $this->gradeScoreValues['unitScore'] ." units in ". $this->gradeScoreValues['course'] .", diligently consider the suggested courses above and go for one that best suits your inner drive.")
                    ->line('Best Wishes!');
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
