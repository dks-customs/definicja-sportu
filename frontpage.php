<?php 
/* Template Name: Frontpage Template */ 
?>

<?php
$paged  = get_query_var("page");

if(!$paged || $paged < 1) $paged = 1;

$ds_frontpage_query_args = [
    'paged'          => ($paged < 1) ? 1 : $paged,
    'post_type'      => 'post',
    'posts_per_page' => 14,
];

$query = new WP_Query($ds_frontpage_query_args);


if($paged === 1) {
    $hero_post = $query->posts[0];

    if($query->found_posts > 1) {
        if($query->found_posts > 1) {
            $subhero_posts      = [$query->posts[1]];
            $subhero_posts_ids  = [$query->posts[1]->ID];    
        } 
        
        if ($query->found_posts > 2) {
            $subhero_posts      = [$query->posts[1], $query->posts[2]];
            $subhero_posts_ids  = [$query->posts[1]->ID, $query->posts[2]->ID];    
        }
        
        if ($query->found_posts > 3) {
            $subhero_posts      = [$query->posts[1], $query->posts[2], $query->posts[3]];
            $subhero_posts_ids  = [$query->posts[1]->ID, $query->posts[2]->ID, $query->posts[3]->ID];    
        }
    }
}
?>

<?php
    global $wp_query;
    global $post;
?>

<?php get_header(); ?>
<main class="container homepage">
    <?php if(isset($hero_post)) { ?>
        <div class="homepage__hero">
            <?php get_template_part('template-parts/post', '', array('post' => $hero_post, 'thumbnail-size' => 'big', 'title-tag-size' => 'h1')) ?>
        </div>
    <?php } ?>
    <?php if(isset($subhero_posts)) { ?>
        <div class="homepage__subhero-posts row gx-md-3">
        <?php foreach ($subhero_posts as $subhero_post) { ?>
            <?php 
            $post = $subhero_post;
            ?>
            <?php get_template_part('template-parts/post', '', array('post' => $post, 'thumbnail-size' => 'medium', 'wrapper-class' => 'col-12 col-md-4')) ?>
        <?php } ?>        
        </div>
        <?php } ?>        
        
    <?php if($query->found_posts > 4) { ?>
    <div class="homepage__feed">
        <?php if ( have_posts() && $paged === 1) {
                while ( have_posts() ) {
                    the_post(); ?>
                    <div class="homepage__feed__about">
                        <h3>O nas</h3>
                        <?php the_content() ?>
                        <a href="<?php echo esc_attr(get_page_link(get_page_by_path("o-nas")))?>">Czytaj więcej&nbsp;&rarr;</a>
                        <a href="https://www.facebook.com/profile.php?id=100090609693608" target="__blank">Znajdź nas na&nbsp;<?php echo ds_inline_svg('facebook'); ?>&nbsp;&rarr;</a>                    
                    </div>
            <?php } ?>
        <?php } ?>
        <div class="homepage__feed__posts posts-list">
            <h1 class="homepage__feed__posts__title">Najnowsze<?php if(isset($query->query['paged']) && $query->query['paged'] > 1) { ?><span>&nbsp;-&nbsp;Strona <?php echo $query->query['paged'] ?></span><?php }?></h1>
            <?php 
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post(); 
                        global $post;
                
                        if(isset($hero_post) && $post->ID === $hero_post->ID) {
                            continue;
                        } else if (isset($subhero_posts) && in_array($post->ID, $subhero_posts_ids)){
                            continue;
                        } else { 
                            ?>
                            <?php get_template_part('template-parts/post', '', array('post' => $post, 'thumbnail-size' => 'medium', 'wrapper-class' => "mb-4 mb-sm-5")) ?>
                        <?php } ?>
                    <?php } ?>
                <?php } else { ?>
                    <span class="no-content">Brak artykułów</span>
                <?php }  
            ?>
            <?php if($query->max_num_pages > 1) { ?>
                <div class="homepage__feed__posts__pagination pagination mb-sm-5">
                    <?php 
                        $big = 999999999;
                        echo paginate_links(array(
                            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                            'prev_text' => "<",
                            'next_text' => ">",
                            'current'   => $paged,
                            'total'     => $query->max_num_pages,
                            'format' => '?paged=%#%',
                        ));
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</main>
<?php get_footer(); ?>