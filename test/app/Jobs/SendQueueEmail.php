<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Models\Newsletter;

class SendQueueEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $details;
    public $timeout = 7200; 

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

        if (!empty($this->details['checkboxes'])) {
            foreach ($this->details['checkboxes'] as $email) {
                $data[] = Newsletter::where('email' , $email)->first();
            }
        } else {
            $data = Newsletter::all();
        }

        $input['subject'] = $this->details['subject'];

        foreach ($data as $key => $value) {
            $input['email'] = $value->email;
            Mail::send('sendmail.newsletter', ['details' => $this->details], function($message) use($input){
                $message->to($input['email'])
                    ->subject($input['subject']);
            });
        }
    }
}
