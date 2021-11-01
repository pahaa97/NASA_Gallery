<?php

class Post
{

    public function start()
    {
        // Если постов нет, загружаем посты
        $published_posts_nasa = wp_count_posts('post-nasa-gallery')->publish;
        if ( $published_posts_nasa == 0 )
        {
            $nasa = new NASA();
            $last_five_posts_nasa = $nasa->get_last_five_post();
            foreach ($last_five_posts_nasa as $post)
            {
                $this->add_post($post);
            }
        }
    }

    public function get_last_post()
    {
        $params = array(
            'post_type'         => 'post-nasa-gallery',
            'posts_per_page'    => 1,
            'orderby'           => 'date',
            'order'             => 'DESC',
            'post_status'       => 'publish'
        );

        return get_posts( $params );;
    }


    public function get_last_posts()
    {
        $params = array(
            'post_type'   => 'post-nasa-gallery',
            'posts_per_page' => 5
        );
        $recent_posts_array = get_posts( $params );?>
        <div class="nasa_gallery">
    <?php
        foreach( $recent_posts_array as $recent_post_single )
        {
            ?>
            <div>
                <a href="<?php echo get_permalink( $recent_post_single ) ?>"> <?php echo $recent_post_single->post_title ?> </a>
                <?php echo get_the_post_thumbnail( $recent_post_single, 'medium' ); ?>
            </div>
            <?php
        }
        ?>
        </div>
        <style>
            .nasa_gallery div img {
                max-height: 300px;
                max-width: 500px;
                object-fit: cover;
            }
        </style>
            <script>
                jQuery(document).ready(function(){
                    jQuery('.nasa_gallery').slick();
                });
            </script>
        <?php
    }

    public function add_post($post)
    {
        $post_data = array(
            'post_title'    => $post->date,
            'post_content'  => $post->title . "\n" . $post->explanation,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'post-nasa-gallery'
        );

        // Вставляем запись в базу данных
        $post_id = wp_insert_post( $post_data );
        $media_id = media_sideload_image( $post->url, $post_id, null, 'id');
        set_post_thumbnail( $post_id, $media_id );
        return $post_id;
    }

}