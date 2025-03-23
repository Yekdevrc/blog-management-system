<?php

return [
    App\Providers\AppServiceProvider::class,
    RealRashid\SweetAlert\SweetAlertServiceProvider::class,

    // Register the SweetAlert alias manually
    class_alias(RealRashid\SweetAlert\Facades\Alert::class, 'Alert'),
];
