<?php 
/* Template Name: Contact Template */ 
?>

<?php get_header(); ?>
<main class="contact container">
    <h1 class="contact__title">Kontakt</h1>
    <div class="contact__content">
        <div class="contact__content__form">
            <?php echo do_shortcode('[wpforms id="11"]'); ?>
        </div>
        <div class="contact__content__text post-content">
            <?php if ( have_posts() ) {
                while ( have_posts() ) {
                    the_post(); ?>
                    <?php the_content() ?>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
</main>
<?php get_footer(); ?>
