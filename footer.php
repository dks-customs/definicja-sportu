<?php 
global $ds_categories;
$year_from = 2023;
$year_to   = date("Y"); 
$year      = 0;

if($year_from == $year_to) {
    $year = $year_from;
} else {
    $year = $year_from . " - " . $year_to;
}
?>
       <footer class="main-footer">
            <a href="<?php echo home_url() ?>"><img class="main-footer__logo" src="<?php echo ds_logo_url()?>" alt="Definicja sportu logo"></img></a>
            <div class="main-footer__links">
                <a href="<?php echo get_page_link(get_page_by_path("o-nas")) ?>">O nas</a>&nbsp;
                <a href="<?php echo get_page_link(get_page_by_path("kontakt")) ?>">Kontakt</a>
            </div>
            <a href="<?php echo esc_attr("https://www.facebook.com/profile.php?id=100090609693608"); ?>" class="main-footer__social" target="__blank">
                Znajdź nas na&nbsp;<?php echo ds_inline_svg("facebook"); ?>
            </a>
            <div class="main-footer__legal">Definicja Sportu © <?php echo $year ?></div>
        </footer>
        <div class="pop-header" id="pop-header">
            <div class="container">
                <button class="pop-header__menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu" aria-controls="menu">
                    <?php echo ds_inline_svg( 'menu' ); ?>
                </button>
                <a href="<?php echo home_url() ?>"><img class="pop-header__logo" src="<?php echo ds_logo_url()?>" alt="Definicja sportu logo"></img></a>
                <div class="pop-header__categories">
                    <?php foreach( $ds_categories as $category ) { ?>
                        <?php 
                            $is_current = false;
                            if(is_category() && $wp_query->queried_object->slug === $category->slug) $is_current = true;
                            ?>
                        <a href="<?php echo esc_attr( $home_url . "/kategoria/" . $category->slug ) ; ?>" <?php if($is_current) echo 'class="current"'?>><?php echo esc_html( $category->name ) ?></a>
                    <?php } ?>
                </div>
                <button class="pop-header__trigger-search" type="button" id="trigger-pop-search">
                    <?php echo ds_inline_svg( 'search' ); ?>
                </button>
            </div>
            <div class="container pop-header__search">
                <form action="<?php echo home_url() . '/szukaj' ?>" method="get" class="pop-header__search__form" id="pop-header-search-form">
                    <label for="fraza">Szukaj</label>
                    <input type="text" name="fraza" id="fraza" placeholder="Szukaj">
                    <button type="submit">Szukaj</button>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
        <?php if(!isset($_COOKIE["ds-cookies-consent"]) || !in_array($_COOKIE["ds-cookies-consent"], ['given', 'declined'])) { ?>
            <div class="cookies-consent" id="cookies-consent">
                <div class="cookies-consent-container container">
                    <p class="cookies-consent__title">Informacja o plikach cookies na tej witrynie</p>
                    <div class="cookies-consent__content">
                        <p class="cookies-consent__content__desc">
                            Wykorzystujemy cookies do śledzenia liczby i danych o odwiedzających naszą stronę w Google Analytics. Jeśli nie chcesz udostępnić nam tych informacji i dalej korzystać ze strony kliknij "Nie zgadzam się". Jeśli kiedykolwiek zechcesz zmienić zdanie, wyczyść pliki cookies w przeglądarce lub dla tej strony a ten komunikat z możliwością wyboru pojawi się ponownie.
                        </p>
                        <div class="cookies-consent__content__buttons">
                            <button id="decline-cookies-consent">Nie zgadzam się</button>
                            <button id="give-cookies-consent">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </body>
</html>
<?php wp_footer(); ?>
