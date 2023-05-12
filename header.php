<!DOCTYPE html>
<html>
    <?php
    global $post;
    global $wp_query;

    $canonical        = get_the_permalink();
    $blog_name        = get_bloginfo( 'name' );
    $blog_description = get_bloginfo( 'description' );
    $title            = "";
    $description      = get_the_excerpt();
    $type             = is_single() ? "article" : "website";
    $image_url        = is_single() ? get_the_post_thumbnail_url( $post, 'large' ) : "";
    $locale           = "pl-PL";
    $locale_slug      = "pl";
    $categories       = get_categories( array('hide_empty' => 0) );
    $other_index      = 0;
    $home_url         = home_url();
    $is_contact       = is_page(19);
    $is_about         = is_page(2);


    foreach($categories as $index => $category) {
        if($category->slug === 'inne') {
            $other_index = $index;
        }
    }

    $other = $categories[$other_index];
    unset($categories[$other_index]);
    array_push($categories, $other);

    global $ds_categories;
    $ds_categories = $categories;

    if(is_front_page()) {
        $title = get_the_title();
    } else if( is_category() && $wp_query->queried_object->name ) {
        $title = $wp_query->queried_object->name . " - " . $blog_name;
    } else {
        $title = get_the_title() . " - " . $blog_name;
    }
    ?>

    <head>
        <title><?php echo esc_html( $title ); ?></title>
        <link rel="canonical" href="<?php echo esc_attr( $canonical ); ?>">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <meta name="google-site-verification" content="kpkYwctDy2DB8b_Q_fvZ_flFJ0mSxlIaWaEwzak1R6U" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
        <meta property="twitter:title" content="<?php echo esc_attr( $title ); ?>">
        <meta property="og:url" content="<?php echo esc_attr( $canonical ) ?>">
        <meta property="twitter:url" content="<?php echo esc_attr( $canonical ) ?>">
        <meta name="keywords" content="">
        <meta property="og:site_name" content="Expla">
        <meta property="og:type" content="<?php echo $type; ?>">
        <meta http-equiv="Content-Language" content="<?php echo $locale_slug ?>">
        <meta property="og:locale" content="<?php echo esc_attr( $locale ) ?>">
        <?php if ( $image_url ) { ?>
            <meta property="og:image" content="<?php echo esc_attr( $image_url ); ?>">
            <meta property="twitter:image" content="<?php echo esc_attr( $image_url ); ?>">
            <meta property="og:image:alt" content="<?php echo esc_attr( $title ); ?>">
            <meta property="twitter:image:alt" content="<?php echo esc_attr( $title ); ?>">
        <?php } ?>
        <?php if ( $description) { ?>
            <meta name="description" content="<?php echo esc_attr( $description ); ?>">
            <meta property="og:description" content="<?php echo esc_attr( $description ); ?>">
            <meta property="twitter:description" content="<?php echo esc_attr( $description ); ?>">
        <?php } ?>
        <?php wp_head(); ?>
    </head>
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4XTMS09KMT"></script>
    <?php if(isset($_COOKIE["ds-cookies-consent"]) && $_COOKIE["ds-cookies-consent"] === 'given' ) { ?>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4XTMS09KMT');
        </script>
    <?php } ?>

    <body>
        <noscript class="no-javascript">
            Javascript jest wymagany, aby Definicja Sportu działała poprawnie. Włącz Javascript, jeśli chcesz korzystać z Definicji Sportu.
        </noscript>
            <header class="main-header">
                <div class="main-header__top">
                    <div class="container">
                        <button class="main-header__top__menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="menu">
                            <?php echo ds_inline_svg( 'menu' ); ?>
                        </button>
                        <a href="<?php echo home_url() ?>"><img class="main-header__top__logo" src="<?php echo ds_logo_url()?>" alt="Definicja sportu logo"></img></a>
                        <button class="main-header__top__search" type="button" id="trigger-search">
                            <?php echo ds_inline_svg( 'search' ); ?>
                        </button>
                    </div>
                </div>
                <div class="main-header__bottom">
                    <nav class="main-header__bottom__categories container">
                        <?php foreach( $categories as $category ) { ?>
                            <?php 
                                $is_current = false;
                                if(is_category() && $wp_query->queried_object->slug === $category->slug) $is_current = true;
                             ?>
                            <a href="<?php echo esc_attr( $home_url . "/kategoria/" . $category->slug ) ; ?>" <?php if($is_current) echo 'class="current"'?>><?php echo esc_html( $category->name ) ?></a>
                        <?php } ?>
                    </nav>
                </div>
                <div class="main-header__search container">
                    <form action="<?php echo home_url() . '/szukaj' ?>" method="get" class="main-header__search__form">
                        <label for="fraza">Szukaj</label>
                        <input type="text" name="fraza" id="fraza" placeholder="Szukaj">
                        <button type="submit">Szukaj</button>
                    </form>
                </div>
            </header>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="menu" aria-labelledby="menu">
                <div class="offcanvas-header">
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <?php foreach( $categories as $category ) { ?>
                        <?php 
                            $is_current = false;
                            if(is_category() && $wp_query->queried_object->slug === $category->slug) $is_current = true;
                        ?>
                        <a href="<?php echo esc_attr( $home_url . "/kategoria/" . $category->slug ); ?>" <?php if($is_current) echo 'class="current"'?>><?php echo esc_html( $category->name ) ?></a>
                    <?php } ?>
                    <a class="offcanvas-body-about <?php if($is_about) echo ' current'?>" href="<?php echo esc_attr( $home_url . "/o-nas" ); ?>">O nas</a>
                    <a href="<?php echo esc_attr( $home_url . "/kontakt" ); ?>" <?php if($is_contact) echo 'class="current"'?>>Kontakt</a>
                    <a class="offcanvas-body-facebook" href="https://www.facebook.com/profile.php?id=100090609693608" target="__blank">Znajdź nas na&nbsp;<?php echo ds_inline_svg('facebook'); ?></a>
                    <a class="offcanvas-body__logo" href="<?php echo home_url() ?>"><img src="<?php echo ds_logo_url()?>" alt="Definicja sportu logo"></img></a>
                </div>
            </div>
