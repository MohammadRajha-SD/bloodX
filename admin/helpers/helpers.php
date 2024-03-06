<?php
    function asset($path) {
        if(!isset($path)){
            return LAYOUT_PATH;
        }

        return LAYOUT_PATH . $path;
    }

    function setActive($paths) {
        if (is_array($paths)) {
            foreach ($paths as $path) {
                if ($_SERVER['PHP_SELF'] == $path) {
                    return 'active';
                }
            }
        }
    }
