<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KirimEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        $check = User::where('email',$this->email)->first();
        $link = url('reset_password/' . $check->email);
        return $this->subject('Reset Your Password')
                    ->view('email_password') // Tampilan email
                    ->with([
                        'email' =>  $check->email,
                        'nama'  =>  $check->name,
                        'link'  =>  $link
                    ]);
    }
}
