<?php

/*
 * This file is part of wvbforum/butler.
 *
 * Copyright (c) 2020 JC-ProPlus.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WvbForum\Butler;

use Illuminate\Contracts\Events\Dispatcher;
use Flarum\Extend;
use Flarum\Frontend\Document;
use WvbForum\Butler\Event;
use WvbForum\Butler\Listener;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<script>console.log("Hello, world!")</script>';
        })
        ->js(__DIR__."/js/dist/forum.js"),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    function (Dispatcher $events) {
        $events->listen(Event\GetRegisteredUser::class, Listener\SuspendUserAfterRegistration::class);
    }
];
