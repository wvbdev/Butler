<?php

namespace WvbForum\Butler\Listener;

use Carbon\Carbon;
use Flarum\Extension\ExtensionManager;
use Flarum\Suspend\Event\Suspended;
use Flarum\User\Event\Registered;
use Flarum\User\User;
use Illuminate\Contracts\Events\Dispatcher;

class SuspendUserAfterRegistration {

    /**
     * @var Registered
     */
    private $registeredUser;

    /**
     * @var Registered
     */
    private $registeredActor;

    /**
     * @param Dispatcher $events
     */
    protected $events;

    /**
     * @var User $user
     */
    private $suspendedUser;

    /**
     * @var User $actor
     */
    private $suspendedActor;

    public function handleRegistrationEvent(Registered $event, Dispatcher $Event){
        $this->registeredUser = $event->user;
        $this->registeredActor = $event->actor;
        $this->events = $Event;
    }
    public function bootUserModal(User $user, User $actor){
        $this->registeredUser = $user;
        $this->registeredActor = $actor;
        $this->suspendedUser = $user;
        $this->suspendedActor = $actor;
    }
    public function suspendRegisteredUser() {
        $manager = app(ExtensionManager::class);

        if ($manager->isEnabled('flarum-suspend')) {
            $this->registeredUser->suspended_until = Carbon::parse('2038-01-01');
            app('events')->dispatch(new Suspended($this->suspendedUser, $this->suspendedActor));
        }
    }
}
