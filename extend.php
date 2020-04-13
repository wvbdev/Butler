<?php

/*
 * This file is part of WvbForum/butler.
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
use Flarum\User\Event\Registered;
use WvbForum\Butler\Listener\SuspendUserAfterRegistration;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<script>console.log("Horld!")</script>';
        })
        ->js(__DIR__."/js/dist/forum.js"),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    function (Dispatcher $events) {
        $events->subscribe(SuspendUserAfterRegistration::class);
    }
];
