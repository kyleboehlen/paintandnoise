<?php

namespace App\Console\Commands\Assets;

use Illuminate\Console\Command;
use Storage;

class DeleteTestDir extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assets:delete-test-dir';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes the test directories in assets/audio and assets/images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Delete test audio/images
        return
            Storage::disk('audio')->deleteDirectory('test') &&
            Storage::disk('images')->deleteDirectory('test') &&
            Storage::deleteDirectory(config('media.path') . config('profilepictures.sub_dir') . 'test');
    }
}
