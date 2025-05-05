<?php if(!function_exists ('isSelected')){
  function isSelected($page){
    $current_page = basename($_SERVER['PHP_SELF'], ".php");
    if ($current_page == 'add') {
      $current_page = 'tasks';
    }

    if ($current_page == $page) {
        return "active";
    } else {
        return '';
    }
  }
}