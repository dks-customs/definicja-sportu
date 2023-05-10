<?php 
/* Template Name: Search Template */ 
?>

<?php
$phrase = get_query_var("fraza");
$paged  = get_query_var("paged");
$view   = ds_get_view();
if(!$paged || $paged < 1) $paged = 1;

$search_query_args = [
    'paged'     => ($paged < 1) ? 1 : $paged,
    'post_type' => 'post',
    's'         => $phrase,
];

$ds_search_query = new WP_Query($search_query_args);

if($paged > $ds_search_query->max_num_pages) {
    $paged = 1;
    $search_query_args['paged'] = $paged;
    $ds_search_query = new WP_Query($search_query_args);
}
?>

<?php get_header(); ?>
    <main class="container">
        <div class="page-heading">
            <h1 class="search__title">Wyniki wyszukiwania<?php echo $phrase ? " dla frazy " . "<span class='search__title__phrase'>" . $phrase . "</span>": "" ?><?php if(isset($ds_search_query->query['paged']) && $ds_search_query->query['paged'] > 1) { ?><span>&nbsp;-&nbsp;Strona <?php echo $ds_search_query->query['paged'] ?></span><?php }?></h1>
            <?php get_template_part('template-parts/page-view'); ?>
        </div>
        <div class="<?php if($view === 'grid') {echo 'posts-grid row gx-sm-4 gx-lg-5';} else { echo 'posts-list';}?>" id="archive-posts">
            <?php 
                if ( $ds_search_query->have_posts() ) {
                    while ( $ds_search_query->have_posts() ) {
                        $ds_search_query->the_post(); ?>
                        <?php get_template_part('template-parts/post', '', array('post' => $post, 'thumbnail-size' => 'medium', 'wrapper-class' => 'col-12 col-sm-6 col-md-4 mb-4 mb-sm-5')) ?>
                    <?php } ?>
                <?php } else { ?>
                    <span class="no-content">Brak artykułów</span>
                <?php }  
            ?>
        </div>
        <?php if($ds_search_query->max_num_pages > 1) { ?>
            <div class="pagination mb-4 mb-sm-5">
                <?php 
                    echo paginate_links(array(
                        'total'     => $ds_search_query->max_num_pages,
                        'current'   => $paged,
                        'prev_text' => "<",
                        'next_text' => ">"
                    ));
                ?>
            </div>
        <?php } ?>
    </main>
<?php get_footer(); ?>