<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifEmailRegist extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectText;
    public $description;
    public $fileUrl;
    public $namefull;
    public $isEmpty;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subjectText, $description, $fileUrl, $namefull, $isEmpty)
    {
        $this->subjectText = $subjectText;
        $this->description = $description;
        $this->fileUrl     = $fileUrl;
        $this->namefull    = $namefull;
        $this->isEmpty     = $isEmpty;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->from('data@uid.or.id', 'Success Registration') // set email & nama pengirim
            ->subject($this->subjectText ?: 'United In Diversity')
            ->view('emails.notif_email_regist')
            ->with([
                'subject'     => $this->subjectText,
                'description' => $this->description,
                'fileUrl'     => $this->fileUrl,
                'namefull'    => $this->namefull,
                'isEmpty'     => $this->isEmpty,
            ]);


        // Attach file jika ada
        if (!empty($this->fileUrl)) {
            $path = public_path($this->fileUrl);
            if (file_exists($path)) {
                $email->attach($path, [
                    'as'   => basename($path),
                    'mime' => mime_content_type($path),
                ]);
            }
        }

        return $email;
    }
}
