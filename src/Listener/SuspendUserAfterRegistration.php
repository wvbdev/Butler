<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\Suspend\Event\Suspended;
use WvbForum\Butler\Event\GetRegisteredInfo;

class SuspendUserAfterRegistration {
    function SuspendRegisteredUser() {
        $manager = app(ExtensionManager::class);
        $event = new GetRegisteredInfo();
        $user = $event->rUser;
        $actor = $event->rActor;

        if ($manager->isEnabled('flarum-suspend')) {
            $user->suspended_until = Carbon::parse('2038-01-01');
            app('events')->dispatch(new Suspended($user, $actor));
        }
    }
}
