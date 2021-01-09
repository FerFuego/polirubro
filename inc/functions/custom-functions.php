<?php

function normalize_title() {
    return ucfirst(str_replace(['/','nuevo','.php'], ['','',''], $_SERVER['REQUEST_URI']));
}

?>