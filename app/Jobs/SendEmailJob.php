<?php

namespace App\Jobs;

use App\Helpers\MailHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = $this->details['email'];
        $name = $this->details['name'];
        $hostLink = $this->details['hostLink'];
        $html = '<p>Click this link you can join the class</p><br> Link: <a href="'.$hostLink.'" style="color: #fff; background-color: #0f7dc2; border-color: #0f7dc2; padding: 10px 15px;" target="_blank">Join A Class</a>';
        $subject = __('emails.merithub_parent_link');
        $BODY = __('emails.merithub_parent_link_body', ['USERNAME' => $name, 'HTMLTABLE' => $html]);
        $body_email = __('emails.template', ['BODYCONTENT' => $BODY]);
        $mail = MailHelper::mail_send($body_email, $email, $subject);
    }
}
