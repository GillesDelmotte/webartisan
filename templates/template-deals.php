<?php /*Template name: page des offres d'emplois*/ ?>
<?php
if (!is_user_logged_in()) {
    $disabled = true;
} else {
    $disabled = false;
}
?>
<?php get_header(); ?>
<div class="pageHeader deals">
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
    <section class="offers">
        <h2 class="sr-only">Toutes les offres d'emplois</h2>
        <?php $currentPage = get_query_var('paged');
        $offers = new WP_Query(array('post_type' => 'jobs', 'posts_per_page' => 3, 'paged' => $currentPage)); ?>
        <?php while ($offers->have_posts()) : $offers->the_post(); ?>
            <article class="offer">
                <div class="offer__img"><?= get_avatar(get_the_author_id()); ?></div>
                <div class="offer__all">
                    <h2 class="offer__title"><?php the_title(); ?></h2>
                    <div class="offer__infos">
                        <span class="offer__company"><?= get_field('offer__name') ?></span><span class="offer__location"><?= get_field('offer__location'); ?></span><span class="offer__date">Le <?= get_the_date(); ?></span>
                    </div>
                    <ul class="offer__tags">
                        <?php $tags = get_the_tags(get_the_ID()); ?>
                        <?php foreach ($tags as $tag) : ?>
                            <li class="tag <?= $tag->slug; ?>">
                                <?= $tag->name; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class=" offer__content wysiwyg">
                        <?= get_field('offer__content'); ?>
                    </div>
                    <div class="offer__infos">
                        <span class="offer__email"><a href="mailto:<?= get_field('offer__email') ?>"><?= get_field('offer__email') ?></a></span><span class="offer__phone"><?= get_field('offer__phone'); ?>
                    </div>
                </div>
                <div class="offer__type">
                    <p><?= get_field('offer__type'); ?></p>
                </div>
                <?php if (get_field("offer__link")) : ?>
                    <a href="<?= get_field("offer__link"); ?>" class="offer__link"></a>
                <?php endif; ?>

            </article>
        <?php endwhile; ?>
        <?php wp_reset_query(); ?>
    </section>
</div>
<div class="paginate emplois">
    <div class="paginate__clip">
        <?= paginate_links(array(
            'total' => $offers->max_num_pages,
            'end_size' => 1,
            'mid_size' => 3,
            'prev_next' => false
        )); ?>
    </div>
</div>
<div class="container">
    <section class="newOffer">
        <h2 class="newOffer__title">Publier une offre d‘emplois</h2>
        <p class="newOffer__explanation">
            Vous pouvez mettre ou ne pas mettre de description et de lien vers une offre externe au site, mais il en faut au moins un des deux.
        </p>
        <form action="<?= admin_url('admin-post.php'); ?>" method="post" class="newOffer__form">
            <input type="hidden" name="action" value="post_newOffer">
            <div class="form__field type">
                <input class="radio__input" type="radio" id="stage" name="type" value="stage" <?= $disabled ? "disabled" : ""; ?>><label for="stage" class="type__label">Stage</label>
                <input class="radio__input" type="radio" id="emplois" name="type" value="emplois" checked="checked" <?= $disabled ? "disabled" : ""; ?>><label for="emplois" class="type__label">Emplois</label>
            </div>
            <div class="form__field name">
                <label for="name" class="form__field__label">Nom de l'entreprise*&nbsp;:</label>
                <div class="form__field__input">
                    <input required type="text" id="name" name="name" placeholder="Le nom de votre entreprise ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field title">
                <label required for="title" class="form__field__label">Titre de l'annonce*&nbsp;:</label>
                <div class="form__field__input">
                    <input type="text" id="title" name="title" placeholder="Le titre de l'annonce ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field city">
                <label for="city" class="form__field__label">ville*&nbsp;:</label>
                <div class="form__field__input">
                    <input required type="text" id="city" name="city" placeholder="Votre ville ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field email">
                <label for="email" class="form__field__label">Email de contact*&nbsp;:</label>
                <div class="form__field__input">
                    <input required type="text" id="email" name="email" placeholder="Votre email de contact ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field tel">
                <label for="tel" class="form__field__label">Telephone*&nbsp;:</label>
                <div class="form__field__input">
                    <input required type="text" id="tel" name="tel" placeholder="Votre numéro ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field desc">
                <label for="desc" class="form__field__label">Description&nbsp;:</label>
                <div class="form__field__input">
                    <textarea name="desc" id="desc" <?= $disabled ? "disabled" : ""; ?>></textarea>
                </div>
            </div>
            <div class="form__field link">
                <label for="link" class="form__field__label">Lien vers l'annonce&nbsp;:</label>
                <div class="form__field__input">
                    <input type="text" id="link" name="link" placeholder="Votre lien ici" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <div class="form__field tags">
                <label for="tags" class="form__field__label">Tags*&nbsp;:</label>
                <div class="form__field__input">
                    <input required type="text" id="tags" name="tags" placeholder="Css,Html,Javascript" <?= $disabled ? "disabled" : ""; ?>>
                </div>
            </div>
            <input type="submit" value="créer l'annonce" class="form__submit" <?= $disabled ? "disabled" : ""; ?>>
        </form>
        <?php if ($disabled) : ?>
            <div class="disabled">
                <p>Vous devez être connecté pour pouvoir faire une offre</p>
                <a class="disabled__connection" href="<?= the_permalink(106); ?>">Me connecter</a>
            </div>
        <?php endif; ?>
    </section>
</div>
</body>
<footer class="pageFooter deals">

    <?php get_footer(); ?>