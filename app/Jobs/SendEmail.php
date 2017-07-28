<?php

namespace App\Jobs;

use App\Mail\YexkMail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $to;
    protected $title;
    protected $message;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$to,$title,$message)
    {
        $this->data    = $data;
        $this->to      = $to;
        $this->title   = $title;
        $this->message = $message;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         // 发邮件操作
         Mail::to($this->to)->queue(new YexkMail($this->data));
    }
}
