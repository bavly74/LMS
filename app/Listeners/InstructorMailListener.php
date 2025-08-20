<?php

namespace App\Listeners;

use App\Events\InstructorMailEvent;
use App\Mail\InstructorRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class InstructorMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(InstructorMailEvent $event): void
    {
        if (config('mail_queue.is_queue')) {
            Mail::to($event->instructor->email)->queue(new InstructorRequest($event->instructor , $event->status)) ;
        }else{
            Mail::to($event->instructor->email)->send(new InstructorRequest($event->instructor , $event->status)) ;
        }
    }
}
