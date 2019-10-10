<?php /*Template name: page du forum*/ ?>
<?php get_header(); ?> 
<div class="pageHeader forum">
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
<footer class="pageFooter forum">
    
<?php get_footer(); ?> 