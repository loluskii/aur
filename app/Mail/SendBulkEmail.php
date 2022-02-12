<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendBulkEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $detail;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($detail, $name)
    {
        $this->detail = $detail;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Newsletter from AUR2611')->view('mail.admin.newsletter');
    }
}
