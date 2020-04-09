<?php

use Flarum\User\Event\Registered;
use Flarum\Suspend\Listener;
use Flarum\User\User;

class GetInfo {
    function handleRegistrationEvent(Registered $event){
        return $event->user;
    }
    public function returnUserInfo(){
        $registered = $this->handleRegistrationEvent();
        return $registered->username;
    }
}
class SuspendUser {

}