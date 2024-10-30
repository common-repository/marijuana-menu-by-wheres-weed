<div class="wrap">
    <h2>Wheres Weed Menu</h2>
    <form method="post" action="options.php"> 
        <?php @settings_fields('ww_menu-group'); ?>
        <?php @do_settings_fields('ww_menu-group'); ?>

        <?php do_settings_sections('ww_menu'); ?>

        <?php @submit_button(); ?>
    </form>
</div>