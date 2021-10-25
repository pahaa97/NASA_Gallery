<?php

include_once(__DIR__.'../models/Post.php');

function nasa_gallery_func()
{
    $post = new Post();
    $post->get_last_posts();
}




