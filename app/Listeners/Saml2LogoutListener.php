<?php

namespace App\Listeners;

use Aacotroneo\Saml2\Events\Saml2LogoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Auth;
use Session;


class Saml2LogoutListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Saml2LogoutEvent  $event
     * @return void
     */
    public function handle(Saml2LogoutEvent $event)
    {
        // dd($event);
        Auth::logout();
        Session::save();
    }
}
