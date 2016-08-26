<?php

/*
 * This file is part of the equipc/laravel-lang package.
 *
 * (c) EquiPC <contact@equipc.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EquiPC\LaravelLang\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class Publish extends Command
{
    protected $signature = 'lang:publish
                            {locales=all : Comma-separated list of, eg: fr,nl}
                            {--force : override existing files.}';

    protected $description = 'Publish language files to resources directory.';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $locale = $this->argument('locales');
        $force = $this->option('force') ? 'f' : 'n';

        $sourcePath = base_path('vendor/caouecs/laravel-lang/src');
        $targetPath = base_path('resources/lang/');

        if (!is_dir($targetPath) || !is_writable($targetPath)) {
            return $this->error('The lang path "resources/lang/" does not exist or not writable.');
        }

        $files = [];
        $published = [];

        if ($locale == 'all') {
            $files = $sourcePath.'/*';
            $message = 'all';
        } else {
            foreach (explode(',', $locale) as $filename) {
                $file = $sourcePath.'/'.trim($filename);

                if (!file_exists($file)) {
                    $this->error("Lang '$filename' not found.");
                    continue;
                }

                $published[] = $filename;
                $files[] = $file;
            }

            if (empty($files)) {
                return;
            }

            $files = implode(' ', $files);
            $message = json_encode($published);
        }

        $process = new Process("cp -r{$force} $files $targetPath");

        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                return $this->error(trim($buffer));
            }
        });

        $type = ($force == 'f') ? 'overwrite' : 'no overwrite';

        $this->info("Published languages <comment>({$type})</comment>: {$message}.");
    }
}
