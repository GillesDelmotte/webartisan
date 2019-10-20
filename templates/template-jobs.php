<?php /*Template name: page des métiers du web*/ ?>
<?php
    $currentPage = get_query_var('paged');
    $jobs = new WP_Query(array('s'=>$_GET['recherche'], 'post_type' => 'worker', 'posts_per_page' => 8, 'paged' => $currentPage)); 
?>

<?php get_header(); ?> 
<div class="pageHeader jobs">
    <div class="pageHeader__clip">
        <h1 class="pageHeader__title">
            <?= the_title(); ?>
        </h1>
        <p class="pageHeader__content">
            <?= get_field('header__description'); ?>
        </p>
    </div>
</div>
<div class="search__jobs">
    <form action="" class="search__jobs__form" method="get">
        <input type="search" placeholder="Rechercher" class="search__jobs__form__input" name="recherche"> <button class="search__jobs__form__button"><span class="sr-only">validez</span><?php require get_template_directory().'/dist/icons/correct.svg';?></button>
    </form>
</div>
<section class="jobs">
    <h2 class="sr-only">Tous les métiers du web</h2>
    <ul class="persons">
        <?php while($jobs->have_posts()) : $jobs->the_post(); ?>
        <li class="person">
            <a href="<?= the_permalink(); ?>" class="person__link"><span class="sr-only">interview de <?= get_field('job__name');?> (<?= the_title();?>)</span></a>
            <?php $img = get_field('job__img'); $size = 'thumb_285x350' ?>
            <?= wp_get_attachment_image( $img, $size ); ?>
            <div class="person__infos">
                <span class="person__name"><?= get_field('job__name');?></span>
                <span class="person__job"><?= the_title();?></span>
            </div>
        </li>
        <?php endwhile;?>
        <?php wp_reset_query(); ?>   
    </ul>
</section>
<div class="paginate paginate__jobs">
    <div class="paginate__clip">
        <?= paginate_links(array(
            'total' => $jobs->max_num_pages,
            'end_size' => 1,
            'mid_size' => 3,
            'prev_next' => false
        )); ?> 
        <?php if($jobs->have_posts()) : while($jobs->have_posts()) : $jobs->the_post(); ?>
        
        <?php endwhile; else:?>
        <p>Il n'y a pas de réponse a votre recherche</p>
        <?php endif; ?>
        <?php wp_reset_query(); ?> 
    </div>
</div>
<div class="redirection">
    <p class="redirection__para">Vous chercher un emplois ou un stage ? Consultez notre page avec toutes les offres des agences</p>
    <div class="redirction__link">
        <a href="">Aller sur la page emplois</a>
        <a href="">Aller sur la page stage</a>
    </div>
</div>
</body>
<footer class="pageFooter jobs">
    
<?php get_footer(); ?> 