<?php

use Flarum\User\Event\Registered;
use Flarum\Suspend\Listener;
use Flarum\User\User;

class GetInfo {
    function handleRegistrationEvent(Registered $event){
        $registeredUser = $event->user;
        return $registeredUser;
    }
    public function returnUserInfo(){
        $registered = $this->handleRegistrationEvent();
        $suspendUserName = $registered->username;
        return $suspendUserName;
    }
}
class SuspendUser {

}