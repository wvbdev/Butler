<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\Suspend\Event\Suspended;
use Flarum\User\Event\Registered;

class SuspendUserAfterRegisteration {
    function handleRegistrationEvent(Registered $event){
        return $event->user;
    }
    function SuspendRegisteredUser() {
        $manager = app(ExtensionManager::class);
        $registeredUser = $this->handleRegistrationEvent();
        $actor = null;

        if ($manager->isEnabled('flarum-suspend')) {
            $registeredUser->suspended_until = Carbon::parse('2038-01-01');
            app('events')->dispatch(new Suspended($registeredUser, $actor));
        }
    }
}
