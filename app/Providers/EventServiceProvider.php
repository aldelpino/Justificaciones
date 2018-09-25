<?php

namespace App\Providers;

use App\Events\Justification\Submitted as JustificationSubmitted;
use App\Events\Justification\Approved as JustificationApproved;
use App\Events\Justification\Rejected as JustificationRejected;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        JustificationSubmitted::class => [
            'App\Listeners\Justification\Submitted\SendEmailToStudent',
            'App\Listeners\Justification\Submitted\SendEmailToCoordinator',
        ],
        JustificationApproved::class => [
            'App\Listeners\Justification\Approved\SendEmailToStudent',
            'App\Listeners\Justification\Approved\SendEmailToTeacher',
        ],
        JustificationRejected::class => [
            'App\Listeners\Justification\Rejected\SendEmailToStudent',
            'App\Listeners\Justification\Rejected\SendEmailToTeacher',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
