<?php /*Template name: page mdn*/ ?>
<?php get_header(); ?>
<div class="pageHeader mdn">
    <div class="pageHeader__clip">
        <div class="container">
            <h1 class="pageHeader__title">
                <?= the_title(); ?>
            </h1>
            <p class="pageHeader__content">
                <?= get_field('header__description'); ?>
            </p>
        </div>
    </div>
</div>

</body>
<footer class="pageFooter mdn">

    <?php get_footer(); ?>
