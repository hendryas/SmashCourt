<?php

if (!function_exists('checkPageExist')) {
    function checkPageExist(string $page_name)
    {
        $file = APPPATH . 'views/pages/' . $page_name . '.php';
        if (file_exists($file)) {
            return 'pages/' . $page_name;
        }
        return 'pages/welcome_page';
    }
}
