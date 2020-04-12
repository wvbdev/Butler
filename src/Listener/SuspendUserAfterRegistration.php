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

    /**
     * @param Dispatcher $events
     */
    protected $events;

    public function suspendRegisteredUser($suspendedUser, $suspendedActor) {
        $manager = app(ExtensionManager::class);
        if ($manager->isEnabled('flarum-suspend')) {
            $suspendedUser->suspended_until = Carbon::parse('2038-01-01');
            //app('events')->dispatch(new Suspended($this->suspendedUser, $this->suspendedActor));
            app('events')->dispatch(new Suspended($suspendedUser, $suspendedActor));
        }
    }
}
