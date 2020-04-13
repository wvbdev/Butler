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
     * @var User
     */
    public $suspendedUser;

    /**
     * @var User
     */
    public $suspendedActor;

    public function subscribe(Dispatcher $event) {
        $event->listen(Registered::class, function (Registered $events) {
            $this->assignSuspendActor();
            $this->handleRegistrationEvent();
        });
    }

    function assignSuspendActor(User $user) {
        if ($user->id == 1) {
            $this->suspendedActor = $user;
        }
        return $this->suspendedActor;
    }

    function handleRegistrationEvent(Dispatcher $event) {
        $event->listen(Registered::class, function (Registered $events) {
            $this->suspendedUser = $events->user;
            $this->suspendRegisteredUser($this->suspendedUser, $this->suspendedActor);
        });
    }

    function suspendRegisteredUser($user, $actor) {
        $manager = app(ExtensionManager::class);
        $this->suspendedUser = $user;
        $this->suspendedActor = $actor;
        if ($manager->isEnabled('flarum-suspend')) {
            $user->suspended_until = Carbon::parse('2038-01-01');
            app('events')->dispatch(new Suspended($user, $actor));
        }
    }
}
