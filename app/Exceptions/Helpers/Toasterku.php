<?php

namespace App\Exceptions\Helpers;

class Toasterku

{

    public static function config()
    {
        return    [
            "closeButton" => false,
            "debug" => false,
            "newestOnTop" => false,
            "progressBar" => true,
            "positionClass" => "toast-top-right",
            "preventDuplicates" => false,
            "onclick" => null,
            "showDuration" => "200",
            "hideDuration" => "1000",
            "timeOut" => "2000",
            "extendedTimeOut" => "1000",
            "showEasing" => "swing",
            "hideEasing" => "linear",
            "showMethod" => "fadeIn",
            "hideMethod" => "fadeOut"
        ];
    }
}
