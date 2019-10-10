<?php /*Template name: page d'accueil*/ ?>
<?php get_header(); ?> 
<div class="pageHeader homepage">
    <div class="pageHeader__clip">
        <h1 class="pageHeader__title">
            <?= get_bloginfo( $show = 'name' ); ?>
        </h1>
        <p class="pageHeader__content">
            <?= get_field('header__description'); ?>
        </p>
    </div>
</div>
</body>
<footer class="pageFooter homepage">
    
<?php get_footer(); ?> 
