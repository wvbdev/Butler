<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\Suspend\Event\Suspended;
use Flarum\User\Event\Activated;
use Flarum\Group\Group;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;

class SuspendUserAfterRegistration {

    public function subscribe(Dispatcher $event) {
        $event->listen(Activated::class, function (Activated $events) {
            $admin = new User([$id = 1]);
            $this->suspendActivatedUser($events->user, $admin);
        });
    }
    
    function suspendActivatedUser($user, $actor) {
        $manager = app(ExtensionManager::class);
        if ($manager->isEnabled('flarum-suspend')) {
            $user->suspended_until = Carbon::parse('2038-01-01');
            app('events')->dispatch(new Suspended($user, $actor));
        }
    }
}
