<?php

require_once('nasacron.php');
require_once('shortcodes.php');

function my_wp_head_css(){
    echo '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>';
    echo '<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>';
    echo '<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>';
    echo '<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>';
}

function nasagallery_setup_post_types()
{
    register_post_type( 'post-nasa-gallery', array(
            'labels'             => array(
                'name'               => 'Посты NASA', // Основное название типа записи
                'singular_name'      => 'Пост Nasa', // отдельное название записи типа Book
                'add_new'            => 'Добавить новый',
                'add_new_item'       => 'Добавить новый пост',
                'edit_item'          => 'Редактировать пост',
                'new_item'           => 'Новый пост NASA',
                'view_item'          => 'Посмотреть пост NASA',
                'search_items'       => 'Найти пост NASA',
                'not_found'          => 'Постов NASA не найдено',
                'parent_item_colon'  => '',
                'menu_name'          => 'NASA'
            ),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => true,
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array('title','editor','author','thumbnail','excerpt','comments')
        )
    );
}

function nasagallery_install()
{
    nasagallery_setup_post_types();
    cron_nasa();

    flush_rewrite_rules();

    $post = new Post();
    $post->start();
}

function nasagallery_deactivation()
{
    flush_rewrite_rules();
    wp_clear_scheduled_hook( 'my_everyday_event' );
}


