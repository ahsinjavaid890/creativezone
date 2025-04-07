<?php

// app/helpers.php

if (! function_exists('date_format')) {
    function date_format_custom($date) {
        return \App\Helpers\Cmf::date_format($date);
    }
}
?>