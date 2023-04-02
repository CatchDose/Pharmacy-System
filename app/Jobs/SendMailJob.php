<?php

namespace App\Jobs;

use App\Mail\NotificationEmail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $client;
    /**
     *
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->client=$user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->client->email)->send(new NotificationEmail($this->client->name));
    }

}
