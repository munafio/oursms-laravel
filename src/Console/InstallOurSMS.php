<?php

namespace Munafio\OurSMS\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallOurSMS extends Command
{
    protected $signature = 'oursms:install';

    protected $description = 'Install OurSMS package';

    public function handle()
    {
        $this->info('Installing OurSMS...');

        $envFile = app()->environmentFilePath();
        if(File::exists($envFile)){
            $this->line('----------');
            $this->line('Adding environment variables..');
            File::append($envFile, "\nOURSMS_USER_ID=\nOURSMS_SECRET_KEY=");
            $this->info('[✓] Added.');
        }

        $assetsToBePublished = [
            'config' => config_path('oursms.php'),
        ];

        foreach ($assetsToBePublished as $target => $path) {
            $this->line('----------');
            $this->process($target, $path);
        }

        $this->line('----------');
        $this->info('[✓] OurSMS installed successfully');
    }

    private function process($target, $path)
    {
        $this->line('Publishing '.$target.'...');
        if (!File::exists($path)) {
            $this->publish($target);
            $this->info('[✓] '.$target.' published.');
        } else {
            if ($this->shouldOverwrite($target)) {
                $this->line('Overwriting '.$target.'...');
                $this->publish($target,true);
            } else {
                $this->line('[-] Ignored, The existing '.$target.' was not overwritten');
            }
        }
    }

    private function shouldOverwrite($target)
    {
        return $this->confirm(
            $target.' already exists. Do you want to overwrite it?',
            false
        );
    }

    private function publish($tag, $forcePublish = false)
    {
        $params = [
            '--provider' => "Munafio\OurSMS\OursmsServiceProvider",
            '--tag' => 'oursms-'.$tag
        ];

        if ($forcePublish === true) {
            $params['--force'] = '';
        }

       $this->call('vendor:publish', $params);
    }
}
