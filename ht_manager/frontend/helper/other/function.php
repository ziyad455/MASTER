<?php
  function isSelected($page){
    $current_page = basename($_SERVER['PHP_SELF'], ".php");


    if ($current_page == $page) {
        return "active text-white";
    } else {
        return 'text-gray-600';
    }
  }