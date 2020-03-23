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
    <div class="container">
        <section class="forum forum__homepage">
            <h2 class="forum__title">Découvrez notre forum</h2>
            <div class="forum__list">
                <?php $args = new WP_Query(array('post_type' => 'forum', 'posts_per_page' => 2, 'orderby' => 'rand')); ?>
                    <?php while ($args->have_posts()) : $args->the_post(); ?>
                        <article class="offer">
                            <div class="offer__img"><?= get_avatar(get_the_author_id()); ?></div>
                            <div class="offer__all">
                                <h3 class="offer__title"><?php the_title(); ?></h3>
                                <div class="offer__infos">
                                    <span class="offer__company"><?= get_the_author(); ?></span><span class="offer__date">Le <?= get_the_date(); ?></span><span class="offer__comments"><?= $number = get_comments_number(get_the_ID()) ?> <?= $number > 1 ? 'Réponses' : 'Réponse'; ?></span>
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
                                    <p>
                                        <?= get_field('forum__resume') ?>
                                    </p>
                                </div>
                            </div>
                            <a href="<?= the_permalink(); ?>" class="offer__link"></a>
                        </article>
                    <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </div>
            <a href="<?= the_permalink(17); ?>" class="highlighted__link">Voir tous les sujets</a>
        </section>
    </div>
    <div class="container">
        <section class="other other__homepage">
            <h2 class="other__title">Découvrez les métiers du web</h2>
            <div class="other__pics">
                <?php $args = new WP_Query(array('post_type' => 'worker', 'posts_per_page' => 4, 'orderby' => 'rand')); ?>
                <ul class="persons">
                    <?php while ($args->have_posts()) : $args->the_post(); ?>
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
                <a href="<?= the_permalink(19); ?>" class="highlighted__link">Voir tous les métiers</a>
            </div>
        </section>
    </div>
    
    <div class="container">
        <section class="forum forum__homepage">
            <h2 class="forum__title">Découvrez nos tutoriels</h2>
            <div class="forum__list">
                <?php $args = new WP_Query(array('post_type' => 'tutos', 'posts_per_page' => 2, 'orderby' => 'rand')); ?>
                    <?php while ($args->have_posts()) : $args->the_post(); ?>
                        <article class="offer">
                            <div class="offer__img"><?= get_avatar(get_the_author_id()); ?></div>
                            <div class="offer__all">
                                <h3 class="offer__title"><?php the_title(); ?></h3>
                                <div class="offer__infos">
                                    <span class="offer__company"><?= get_the_author(); ?></span><span class="offer__date">Le <?= get_the_date(); ?></span><span class="offer__comments"><?= $number = get_comments_number(get_the_ID()) ?> <?= $number > 1 ? 'Réponses' : 'Réponse'; ?></span>
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
                                    <p>
                                        <?= get_field('forum__resume') ?>
                                    </p>
                                </div>
                            </div>
                            <a href="<?= the_permalink(); ?>" class="offer__link"></a>
                        </article>
                    <?php endwhile; ?>
                <?php wp_reset_query(); ?>
            </div>
            <a href="<?= the_permalink(21); ?>" class="highlighted__link">Voir tous les tutos</a>
        </section>
    </div>
</div>

</body>
<footer class="pageFooter homepage">

    <?php get_footer(); ?>