<?php get_header(); ?>
<?php
    global $wp_query;
    $view = ds_get_view();
?>
<main class="container tag">
    <div class="page-heading">
        <h1 class="tag__title">#<?php single_tag_title(); ?><?php if(isset($wp_query->query['paged']) && $wp_query->query['paged'] > 1) { ?><span>&nbsp;-&nbsp;Strona <?php echo $wp_query->query['paged'] ?></span><?php }?></h1>
        <?php get_template_part('template-parts/page-view'); ?>
    </div>
    <div class="<?php if($view === 'grid') {echo 'posts-grid row gx-sm-4 gx-lg-5';} else { echo 'posts-list';}?>" id="archive-posts">
        <?php 
            if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post(); 
                    ?>
                    <?php get_template_part('template-parts/post', '', array('post' => $post, 'thumbnail-size' => 'medium', 'wrapper-class' => 'col-12 col-sm-6 col-md-4 mb-4 mb-sm-5')) ?>
                <?php } ?>
            <?php } else { ?>
                <span class="no-content">Brak artykułów</span>
            <?php }  
        ?>
    </div>
    
    <?php if($wp_query->max_num_pages > 1) { ?>
        <div class="pagination mb-4 mb-sm-5">
            <?php 
                echo paginate_links(array(
                    'prev_text' => "<",
                    'next_text' => ">"
                ));
            ?>
        </div>
    <?php } ?>
</main>
<?php get_footer(); ?>