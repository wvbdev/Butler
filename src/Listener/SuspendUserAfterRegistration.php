<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\User\Event\Activated;
use Illuminate\Contracts\Events\Dispatcher;

class SuspendUserAfterRegistration {

    public function subscribe(Dispatcher $event) {
        $event->listen(Activated::class, function (Activated $events) {
            $this->suspendActivatedUser($events->user);
        });
    }

    function suspendActivatedUser($user) {
        $manager = app(ExtensionManager::class);
        if ($manager->isEnabled('flarum-suspend')) {
            $user->suspended_until = Carbon::parse('2038-01-01');
        }
    }
}
