<?php /*Template name: page des métiers du web*/ ?>
<?php
$currentPage = get_query_var('paged');
$jobs = new WP_Query(array('s' => $_GET['recherche'], 'post_type' => 'worker', 'posts_per_page' => 8, 'paged' => $currentPage));
?>

<?php get_header(); ?>
<div class="pageHeader jobs">
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
<div class="container">
    <div class="search__jobs">
        <form action="" class="search__jobs__form" method="get">
            <input type="search" value="<?= $_GET['recherche']; ?>" placeholder="Rechercher" class="search__jobs__form__input search-autocomplete" name="recherche">
            <button class="search__jobs__form__button"><span class="sr-only">Rechercher</span>
            </button>
        </form>
    </div>
    <section class="jobs">
        <h2 class="sr-only">Tous les métiers du web</h2>

        <ul class="persons">
            <?php while ($jobs->have_posts()) : $jobs->the_post(); ?>
                <li class="person">
                    <a href="<?= the_permalink(); ?>" class="person__link"><span class="sr-only">interview de <?= get_field('job__name'); ?> (<?= the_title(); ?>)</span></a>
                    <?php $img = get_field('job__img');
                        $size = 'thumb_285x350' ?>
                    <?= wp_get_attachment_image($img, $size); ?>
                    <div class="person__infos">
                        <span class="person__name"><?= get_field('job__name'); ?></span>
                        <span class="person__job"><?= the_title(); ?></span>
                    </div>
                </li>
            <?php endwhile; ?>
            <?php wp_reset_query(); ?>
        </ul>
    </section>
</div>
<div class="paginate paginate__jobs">
    <div class="paginate__clip">
        <?= paginate_links(array(
            'total' => $jobs->max_num_pages,
            'end_size' => 1,
            'mid_size' => 3,
            'prev_next' => false
        )); ?>
        <!-- <?php if ($jobs->have_posts()) : while ($jobs->have_posts()) : $jobs->the_post(); ?>
        <?php if ($_GET['recherche']) : ?>
        <p>vortre recherche : <?= $_GET['recherche']; ?></p>
        <?php endif; ?>
        <?php endwhile;
        else : ?>
        <p>Il n'y a pas de réponse a votre recherche</p>
        <p>vortre recherche : <?= $_GET['recherche']; ?></p>        
        <?php endif; ?> -->
        <?php wp_reset_query(); ?>
    </div>
</div>
<div class="container">
    <div class="redirection jobs">
        <p class="redirection__para">Vous chercher un emplois ou un stage ? Consultez notre page avec toutes les offres des agences</p>
        <div class="redirction__link">
            <a href="<?php the_permalink(14); ?>">Aller sur la page emplois</a>
        </div>
    </div>
    <section class="job__contact">
        <div class="job__contact__img"><img src="<?= assets('./dist/icons/man-user.svg'); ?>" alt=""></div>
        <div class="job__contact__content">
            <h2 class="job__contact__title">Votre profil&nbsp;?</h2>
            <p class="job__contact__explaination">Vous avez un métiers qui n'est pas encore repris sur cette page ? vous êtes dans le domaine du web ? Contactez-nous pour qu'on puisse se rencontrer </p>
            <form action="../functions/contactJob.php" method="POST">
                <div class="job__contact__form__email">
                    <label for="email">Votre email&nbsp;:</label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="job__contact__form__message">
                    <label for="message">Votre message&nbsp;:</label>
                    <textarea name="message" id="message" cols="30" rows="5"></textarea>
                </div>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </section>
</div>
</body>
<footer class="pageFooter jobs">

    <?php get_footer(); ?>