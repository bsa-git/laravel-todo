<?php

namespace App\Listeners;

use Log;

class UserEventListener {

    /**
     * Handling user logon events.
     */
    public function onUserLogin($event) {
        $user_name = $event->user->name;
        Log::info("User {$user_name} login");
    }

    /**
     * Handling user events output from the system.
     */
    public function onUserLogout($event) {
        $user_name = $event->user->name;
        Log::info("User {$user_name} logout");
    }

    /**
     * Регистрация слушателей для подписки.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events) {
        $events->listen(
                'Illuminate\Auth\Events\Login', 'App\Listeners\UserEventListener@onUserLogin'
        );

        $events->listen(
                'Illuminate\Auth\Events\Logout', 'App\Listeners\UserEventListener@onUserLogout'
        );
    }

}
