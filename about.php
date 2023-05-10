<?php 
/* Template Name: About Template */ 
?>

<?php get_header(); ?>
<main class="about container">
    <h1 class="about__title">O nas</h1>
    <div class="about__text post-content">
        <?php if ( have_posts() ) {
            while ( have_posts() ) {
                the_post(); ?>
                <?php the_content() ?>
            <?php } ?>
        <?php } ?>
    </div>
</main>
<?php get_footer(); ?>