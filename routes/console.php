<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment('Engineering Excellence!');
})->purpose('Display an inspiring quote');
