<?php
    $post           = $args['post'];
    $thumbnail_size = $args["thumbnail-size"];
    $wrapper_class  = isset($args['wrapper-class']) ? $args['wrapper-class'] : ""; 
    $title_tag_size = isset($args['title-tag-size']) ? $args['title-tag-size'] : "h2";
    $cats_html      = ds_get_post_categories($post->ID);
    $time_ago       = ds_get_time_ago();
?>

<div class="post-wrapper<?php if($wrapper_class) echo " " . $wrapper_class ?>">
    <div class="post">
        <a class="post__image" href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail($thumbnail_size) ?>
        </a>
        <div class="post__text">
            <<?php echo $title_tag_size; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></<?php echo $title_tag_size; ?>>
            <?php the_excerpt() ?>
            <?php if($time_ago) { ?>
                <span class="time-ago"><?php echo $time_ago ?></span>
            <?php } ?>
            <?php if($cats_html) { ?>
                <div class="post-categories">
                    <?php echo $cats_html ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>