<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class ApplicationName extends Component
{
    public $appName = "";
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
        $this->appName = env('APP_NAME');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $appName = DB::table('website_settings')->where(['name' => 'website'])->first();
        if (isset($appName)) {
            # code...
            if (isset(json_decode($appName->setting_value)->application_name)) {
                # code...
                $this->appName = json_decode($appName->setting_value)->application_name;
            }
        }
        return view('components.application-name');
    }
}
