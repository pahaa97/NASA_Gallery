<?php

require_once(ABSPATH . 'wp-admin/includes/media.php');
require_once(ABSPATH . 'wp-admin/includes/file.php');
require_once(ABSPATH . 'wp-admin/includes/image.php');


function cron_nasa() {
    // удалим на всякий случай все такие же задачи cron, чтобы добавить новые с "чистого листа"
    wp_clear_scheduled_hook( 'my_everyday_event' );

    $today = date('Y-m-d');
    $date_start = strtotime($today . ' 09:00:00');

    get_everyday_post();
    // добавим новую cron задачу
    wp_schedule_event( $date_start, 'daily', 'my_everyday_event');
}

function get_everyday_post() {
    $post_nasa = new NASA();
    $post_wp = new Post();

    $post_content_wp = $post_wp->get_last_post();
    $post_content_nasa = $post_nasa->last_post();

    if ( $post_content_wp[0]->post_title != $post_content_nasa->date )
    {
        $post_id = $post_wp->add_post( $post_content_nasa->date, $post_content_nasa->url );
        return $post_id;
    }
}

