<?php /*Template name: page des offres d'emplois*/ ?>
<?php get_header(); ?> 
<div class="pageHeader deals">
    <div class="pageHeader__clip">
        <h1 class="pageHeader__title">
            <?= the_title(); ?>
        </h1>
        <p class="pageHeader__content">
            <?= get_field('header__description'); ?>
        </p>
    </div>
</div>
</body>
<footer class="pageFooter deals">
    
<?php get_footer(); ?> 