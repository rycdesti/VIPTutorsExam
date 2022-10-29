<?php

function build_url_param()
{
    $query = request()->query();
    foreach($query as $param => $value) {
        if (!$value) {
            unset($query[$param]);
        }
    }

    return $query;
}
