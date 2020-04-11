<?php


namespace WvbForum\Butler\Event;

use Flarum\User\Event\Registered;

class GetRegisteredInfo {
    public $rUser;
    public $rActor;
    function handleRegistrationEvent(Registered $event){
        $this->rUser = $event->user;
        $this->rActor = $event->actor;
    }
}