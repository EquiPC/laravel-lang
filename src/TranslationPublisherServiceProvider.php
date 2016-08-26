<?php

/*
 * This file is part of the overtrue/laravel-lang.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EquiPC\LaravelLang;

use Illuminate\Support\ServiceProvider;
use EquiPC\LaravelLang\Commands\Publish as PublishCommand;

class TranslationPublisherServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     */
    public function register()
    {
         $this->commands(PublishCommand::class);
    }
    
}
