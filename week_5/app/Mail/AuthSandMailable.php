<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthSandMailable extends Mailable
{
    use Queueable, SerializesModels;

    private mixed $mail_info;

    /** Create a new message instance. */
    public function __construct($mail_info)
    {
        $this->setMailInfo($mail_info);
    }

    /** mail_info 리턴 */
    public function getMailInfo(): mixed
    {
        return $this->mail_info;
    }

    /** mail_info 저장 */
    public function setMailInfo(mixed $mail_info): void
    {
        $this->mail_info = $mail_info;
    }

    /** Build the message */
    public function build(): static
    {
        $mail = $this->getMailInfo();
        return $this
            ->to($mail['to_email'], $mail['to_name'])
            ->from($mail['from_email'], $mail['from_name'])
            ->subject($mail['title'])
            ->view('mailable.auth-sand-mail', ['mail' => $mail]);
    }
}
