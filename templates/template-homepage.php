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
<!-- <section class="homepage__actu">
    <h2 class="homepage__actu__title">Article à la une</h2>
    <article class="homepage__actu__article">
        <h3 class="homepage__actu__article__title"></h3>
    </article>
</section> -->
</body>
<footer class="pageFooter homepage">
    
<?php get_footer(); ?> 
