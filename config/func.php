<?php
/**
 * Astashenkov
**/

/**
 * Function for debug
 *
 * @param  mixed $message
 * 
 * @return void
 */
function fn_print_r($message)
{
    if (!empty($message)) {
        echo '<div class="container"><pre>';
        print_r($message);
        echo '</pre></div>';
    }
}

/**
 * Function for debug
 *
 * @param  mixed $message
 * 
 * @return void
 */
function fn_print_die($message)
{
    if (!empty($message)) {
        fn_print_r($message);
        die();
    }
}