<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user, $plan;

    public function __construct($user, $plan)
    {
        $this->user = $user;
        $this->plan = $plan;
    }


    public function build()
    {
        return $this->subject('Plan Purchase Confirmation')
            ->view('emails.membershipMail')
            ->with([
                'subjectLine' => 'Your Application Submit Successfully'
                ]);

    }
}
