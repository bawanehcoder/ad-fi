<?php
if (!function_exists('getDayNames')) {
    function getDayNames($date)
    {
        return \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:m:s', $date)->format('l');
    }
}
