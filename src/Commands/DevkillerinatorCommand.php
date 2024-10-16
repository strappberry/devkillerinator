<?php

namespace Strappberry\Devkillerinator\Commands;

use Illuminate\Console\Command;

class DevkillerinatorCommand extends Command
{
    public $signature = 'devkillerinator';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
