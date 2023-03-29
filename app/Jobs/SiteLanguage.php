<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Stichoza\GoogleTranslate\GoogleTranslate;
use App;
use File;

class SiteLanguage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $lang;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($lang)
    {
        $this->lang = $lang;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (\request()->ip() == "::1") {
            $path = App::langPath().'\\'.$this->lang;
            $filepath = $path . '\\sentence.php';
        } else {
            $path = App::langPath().'/'.$this->lang;
            $filepath = $path . '/sentence.php';
        }
        if (!File::exists($path)) {
            $tr = new GoogleTranslate($this->lang);
            $words = [];
            foreach (trans('sentence') as $key => $sentence) {
                $text = $tr->translate($sentence);
                $words += [$key => $text];
            }

            File::makeDirectory($path, 0777, true, true);

            $exported = var_export($words, TRUE);
            file_put_contents($filepath, '<?php return ' . $exported . ' ?>');
        }
    }
}
