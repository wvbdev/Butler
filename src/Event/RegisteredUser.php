<?php

namespace WvbForum\Butler\Event;

use Flarum\User\Event\Registered;

class GetRegisteredUser {
    function handleRegistrationEvent(Registered $event){
        return $event->user;
    }
}