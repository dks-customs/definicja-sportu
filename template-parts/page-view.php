<?php 
    $view = ds_get_view();
?>

<div class="page-view">
    <button id="grid-view" <?php if($view === "grid") echo 'class="selected"'?>><?php echo ds_inline_svg('grid-view'); ?></button>
    <button id="list-view" <?php if($view === "list") echo 'class="selected"'?>><?php echo ds_inline_svg('list-view'); ?></button>
</div>