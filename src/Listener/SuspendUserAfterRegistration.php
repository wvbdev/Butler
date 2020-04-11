<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\Suspend\Event\Suspended;
use WvbForum\Butler\Event\GetRegisteredUser;

class SuspendUserAfterRegistration {
    function SuspendRegisteredUser() {
        $manager = app(ExtensionManager::class);
        $registeredUser = GetRegisteredUser::class->handleRegistrationEvent();
        $actor = null;

        if ($manager->isEnabled('flarum-suspend')) {
            $registeredUser->suspended_until = Carbon::parse('2038-01-01');
            app('events')->dispatch(new Suspended($registeredUser, $actor));
        }
    }
}
