<?php /*Template name: page d'accueil*/ ?>
<?php get_header(); ?>
<div class="pageHeader homepage">
    <div class="pageHeader__clip">
        <div class="container">
            <h1 class="pageHeader__title">
                <?= get_bloginfo($show = 'name'); ?>
            </h1>
            <p class="pageHeader__content">
                <?= get_field('header__description'); ?>
            </p>
        </div>
    </div>
    <div class="container">
        <section class="highlighted">
            <h2 class="highlighted__title">Article à la une</h2>
            <?php
            $post = get_field('article', 'options');
            setup_postdata($post);
            ?>
            <article class="highlighted__article">
                <?php
                $img = get_field('actu__img');
                $size = 'thumb_690x300'
                ?>
                <?= wp_get_attachment_image($img, $size); ?>
                <div class="highlighted__article__content">
                    <h3 class="highlighted__article__title">
                        <a href="<?= the_permalink(); ?>"><?= the_title(); ?></a>
                    </h3>
                    <div class="highlighted__article__infos">
                        <span class="article__date">Le <?= get_the_date(); ?></span><span class="article__author"><?= get_author_name(); ?></span>
                    </div>
                    <p class="highlighted__article__resume"><?= get_field('actu__resume'); ?></p>
                    <ul class="highlighted__article__tags">
                        <?php $tags = get_the_tags(get_the_ID()); ?>
                        <?php foreach ($tags as $tag) : ?>
                            <li class="tag <?= $tag->slug; ?>">
                                <?= $tag->name; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </article>
            <a href="<?= the_permalink(12); ?>" class="highlighted__link">Voir tous les articles</a>
        </section>
    </div>
</div>

</body>
<footer class="pageFooter homepage">

    <?php get_footer(); ?>