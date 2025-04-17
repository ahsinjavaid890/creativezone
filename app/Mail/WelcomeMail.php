<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user) // Accept artist or user
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Welcome to CreativeZone')
                    ->view('emails.welcomemail')
                    ->with([
                        'messageBody' => "Dear {$this->user->fname} {$this->user->lname},\n\nThank you for applying as an artist. We will review your application and get back to you shortly.\n\nRegards,\nCreativeZone Team",
                        'subjectLine' => 'Your Application Submit Successfully'
                    ]);
    }
}