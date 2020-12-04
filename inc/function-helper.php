<?php
/**
 * @package cuvita
 * 
 * HELPER FUNCTIONS
 */

/**
 * Creates a Seperator in the admin menu
 */
function add_admin_menu_separator($position) {
    global $menu;
    $index = 0;
    foreach($menu as $offset => $section) {
        if (substr($section[2],0,9)=='separator') {
            $index++;
        }
        if ($offset>=$position) {
            $menu[$position] = array('','read',"separator{$index}",'','wp-menu-separator');
            break;
        }
    }
    ksort( $menu );
}

/**
 * Font Awesome Kit Setup
 * 
 * This will add your Font Awesome Kit to the front-end, the admin back-end,
 * and the login screen area.
 */
if (! function_exists('fa_custom_setup_kit') ) {
    function fa_custom_setup_kit($kit_url = '') {
        foreach ( [ 'wp_enqueue_scripts', 'admin_enqueue_scripts', 'login_enqueue_scripts' ] as $action ) {
            add_action(
            $action,
            function () use ( $kit_url ) {
                wp_enqueue_script( 'font-awesome-kit', $kit_url, [], null );
            }
            );
        }
    }
}
fa_custom_setup_kit('https://kit.fontawesome.com/090a2853aa.js');


/**
 * Change date format to month/year for CV output
 */
function formatDateToMonthYear($datestr) {
    setlocale(LC_TIME, array('da_DA.UTF-8','da_DA@euro','da_DA','danish'));
    $time = strtotime($datestr);
    $formatted = date('M Y', $time);
    return $formatted;
}

/**
 * FPDF Show correct characters
 */
function html_utf8($utf){ 
    $utf = iconv('UTF-8', 'ISO-8859-1',$utf);
    $utf = htmlspecialchars_decode($utf,ENT_QUOTES);
    return $utf;
}

/**
 * Sort Education and work by date
 */
function sortCvByNewest($cvArr) {
    $sortedArr = array();
    $currentArr = array();
    $nonCurrentArr = array();
    foreach ($cvArr as $key => $value) {
        isset($value['current']) && $value['current'] == 1 ? array_push($currentArr, $value) : array_push($nonCurrentArr, $value);
    }


    if(count($currentArr)>0) {
        usort($currentArr, function($item1, $item2) {
            $ts1 = strtotime($item1['startdate']);
            $ts2 = strtotime($item2['startdate']);
            return $ts2 - $ts1;
        });

        foreach ($currentArr as $key => $value) {
            array_push($sortedArr, $value);
        }
    }    

    if(count($nonCurrentArr)>0) {
        usort($nonCurrentArr, function($item1, $item2) {
            $ts1 = strtotime($item1['enddate']);
            $ts2 = strtotime($item2['enddate']);
            return $ts2 - $ts1;
        });

        foreach ($nonCurrentArr as $key => $value) {
            array_push($sortedArr, $value);
        }
    }
    return $sortedArr;
}

/**
 * Get other section with id
 */
function get_other_section($id) {
    $value = get_option('cuvita_other');
    if (!empty($value)) {
        $index = array_search($id, array_column($value, 'id'));
        return $value[$index];
    }
}