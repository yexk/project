<?php

namespace App\Jobs;

use App\Mail\SendMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $to;
    protected $cc;
    protected $bcc;
    protected $subject;
    protected $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
        $this->to = $request['to'];
        $this->cc = empty($request['cc']) ? '' : $request['cc'];
        $this->bcc = empty($request['bcc']) ? '' : $request['bcc'];
        $this->subject = $request['subject'];
        $this->message = $request['message'];
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->cc)
        {
            Mail::to($this->to)->cc($this->cc)->send(new SendMessage($this->request, $this->subject, $this->message));
        }else if ($this->bcc)
        {
            Mail::to($this->to)->bcc($this->bcc)->send(new SendMessage($this->request, $this->subject, $this->message));
        }else if ($this->cc && $this->bcc)
        {
            Mail::to($this->to)->cc($this->cc)->bcc($this->bcc)->send(new SendMessage($this->request, $this->subject, $this->message));
        }else
        {
            Mail::to($this->to)->send(new SendMessage($this->request, $this->subject, $this->message));
        }

    }
}
