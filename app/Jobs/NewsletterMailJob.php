<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\NewsletterMail;
use Mail;


class NewsletterMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;

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
        foreach ($this->details as $key => $value) {
            $email = $value['to'];
            $detail['user'] = $value['user'];
            $detail['title'] = $value['title'];
            $detail['subject'] = $value['subject'];
            $detail['message'] = $value['message'];
            $detail['attachment'] = $value['attachment']; 

            Mail::to($email)   
            ->send(new NewsletterMail($detail)); 
            $detail = [];
        }

    }
}
