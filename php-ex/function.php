<?php
if (!function_exists('isselected')) {
    function isselected($page) {
        return basename($_SERVER['PHP_SELF']) === $page;
    }
}
?>
