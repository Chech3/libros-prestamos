<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class ServeAndDev extends Command
{
    protected $signature = 'serve:dev';
    protected $description = 'Run php artisan serve and npm run dev';

    public function handle()
    {
        // $this->info('Starting Laravel development server...');
        
        $process = new Process(['php', 'artisan', 'serve']);
        $process->start();
        
        if (!$process->isRunning()) {
            $this->error('Failed to start Laravel development server.');
            return;
        }

        
        $npmProcess = new Process(['npm', 'run', 'dev']);
        $npmProcess->start();

        if (!$npmProcess->isRunning()) {
            $this->error('Failed to start npm run dev.');
        } else {
            $this->info('Ahora abre esto en el navegador: http://localhost:8000');

            while ($process->isRunning() || $npmProcess->isRunning()) {
                sleep(1);
            }
        }

        $process->stop();
        $npmProcess->stop();
    }
}