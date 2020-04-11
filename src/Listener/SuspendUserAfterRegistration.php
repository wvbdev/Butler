<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\Suspend\Event\Suspended;
use Flarum\User\Event\Registered;
use Illuminate\Events\Dispatcher;

class SuspendUserAfterRegistration {
    /**
     * @var Registered
     */
    protected $registeredUser;
    /**
     * @var Registered
     */
    protected $registeredActor;
    /**
     * @param Dispatcher $events
     */
    protected $events;
    public function handleRegistrationEvent(Registered $event, Dispatcher $Event){
        $this->registeredUser = $event->user;
        $this->registeredActor = $event->actor;
        $this->events = $Event;
    }
    public function suspendRegisteredUser() {
        $manager = app(ExtensionManager::class);

        if ($manager->isEnabled('flarum-suspend')) {
            $this->registeredUser->suspended_until = Carbon::parse('2038-01-01');
            $this->events->dispatch(new Suspended($this->registeredUser, $this->registeredActor));
        }
    }
}
