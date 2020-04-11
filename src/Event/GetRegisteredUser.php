<?php


namespace WvbForum\Butler\Event;

use Flarum\User\Event\Registered;

class GetRegisteredUser {
    public $rUser;
    public $rActor;
    function handleRegistrationEvent(Registered $event){
        $this->rUser = $event->user;
        $this->rActor = $event->actor;
        return Registered::class;
    }
}