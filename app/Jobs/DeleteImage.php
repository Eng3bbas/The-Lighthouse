<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Storage;

class DeleteImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    private  $fileName;

    /**
     * Create a new job instance.
     *
     * @param string|array $fileName
     */
    public function __construct( $fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info("images/image deleted : " . is_array($this->fileName) ? implode(",",$this->fileName) : $this->fileName);
        Storage::delete($this->fileName);
    }
}
