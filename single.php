<?php get_header(); ?>
<?php
    global $wp_query;
?>

<main class="single">
    <div class="single__post">
        <?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post(); 

                    $ds_see_more_query_args = [
                        'post_type'      => 'post',
                        'post__not_in'   => array($post->ID),
                        'posts_per_page' => 3,
                    ];
                    $ds_see_more_query = new WP_Query($ds_see_more_query_args );

                    $cats_html     = ds_get_post_categories($post->ID);
                    $tags_html     = ds_get_post_tags($post->ID);
                    $caption_html  = ds_get_caption(get_post_thumbnail_id());
                    $time_ago      = ds_get_time_ago();
                    $author_name   = get_the_author_meta('display_name');
                    ?>

                    <div class="single__post__image container">
                        <div class="single__post__image-wrapper">
                            <?php the_post_thumbnail('big') ?>
                        </div>
                        <?php if( $caption_html ) { ?>
                            <div class="single__post__image__caption">
                                <?php echo $caption_html ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="single__post__content container">
                        <header class="single-header">
                            <?php if($author_name || $time_ago) { ?>
                                <div class="single-header__meta">
                                    <?php if($author_name) { ?>
                                        <span class="single-header__meta__author"><?php echo $author_name; ?></span>
                                    <?php } ?>
                                    <?php if($time_ago) { ?>
                                        <span class="single-header__meta__time-ago time-ago"><?php echo $time_ago; ?></span>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                            <h1 class="single-header__title"><?php the_title() ?></h1>
                            <?php if($cats_html) { ?>
                                <div class="single-header__categories post-categories">
                                    <?php echo $cats_html ?>
                                </div>
                            <?php } ?>
                        </header>
                        <div class="single__post__content__text post-content">
                            <?php the_content() ?>
                        </div>
                        <?php if($tags_html) { ?>
                        <div class="single__post__content__tags">
                            <h6>Tagi</h6>
                            <?php echo $tags_html ?>
                        </div>
                        <?php } ?>
                        <div class="single__post__content__share">
                            <?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
                        </div>
                        <div class="single__post__content__comments">
                            <h6>Komentarze</h6>
                            <?php echo do_shortcode('[wpdiscuz_comments]'); ?>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <span class="no-content">Brak artykułów</span>
            <?php }  
        ?>
    </div>
    <?php if(isset($ds_see_more_query)) { ?>
            <?php if ( $ds_see_more_query->have_posts() ) { ?>
            <div class="single__see-more container">
                <h2 class="single__see-more__title">Zobacz też</h2>
                <div class="posts-grid row gx-sm-4 gx-lg-5">
                <?php while ( $ds_see_more_query->have_posts() ) {
                    $ds_see_more_query->the_post(); 
                    ?>
                    <?php get_template_part('template-parts/post', '', array('post' => $post, 'thumbnail-size' => 'medium', 'wrapper-class' => 'col-12 col-sm-6 col-md-4 mb-4 mb-sm-5')) ?>
                <?php } ?>
                </div>
            </div>
            <?php } ?>
    <?php } ?>
</main>

<?php get_footer(); ?>