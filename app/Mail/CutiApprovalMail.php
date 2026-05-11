<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\Cuti;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CutiApprovalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $cuti;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cuti $cuti)
    {
        $this->cuti = $cuti;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pengajuan Cuti Baru')
                    ->view('emails.cuti_approval');
    }
}
