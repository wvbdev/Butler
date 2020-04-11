<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\Suspend\Event\Suspended;
use Flarum\User\Event\Registered;

class SuspendUserAfterRegistration {
    public $registeredUser;
    public $registeredActor;
    public function handleRegistrationEvent(Registered $event){
        $this->registeredUser = $event->user;
        $this->registeredActor = $event->actor;
    }
    function suspendRegisteredUser() {
        $manager = app(ExtensionManager::class);

        if ($manager->isEnabled('flarum-suspend')) {
            $user->suspended_until = Carbon::parse('2038-01-01');
            app('events')->dispatch(new Suspended($this->registeredUser, $this->registeredActor));
        }
    }
}
