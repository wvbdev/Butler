<?php

/*
 * This file is part of wvbforum/butler.
 *
 * Copyright (c) 2020 JC-ProPlus.
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace WVBForum\Butler;

use Flarum\Extend;
use Flarum\Frontend\Document;

return [
    (new Extend\Frontend('forum'))
        ->content(function (Document $document) {
            $document->head[] = '<script>console.log("Hello, world!")</script>';
        })
];
