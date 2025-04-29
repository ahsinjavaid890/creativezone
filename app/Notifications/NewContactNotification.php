<?php
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class NewContactNotification extends Notification
{
    protected $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function via($notifiable)
    {
        return ['database']; // You can also add 'mail' if you want email too
    }

    public function toDatabase($notifiable)
    {
        return [
            'name' => $this->contact->name,
            'email' => $this->contact->email,
            'subject' => $this->contact->subject,
            'message' => $this->contact->message,
        ];
    }
}
