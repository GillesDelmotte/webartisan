<?php /*Template name: page mdn*/ ?>
<?php
    $taxonomy = 'categorymdn';
    $tax_terms = get_terms($taxonomy, array('hide_empty' => true));
?>
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
<div class="container">
    <div class="mdn__nav">
        <ul class="mdn__nav__list">
            <?php foreach ($tax_terms as $tax_term):?>
                        <li class="mdn__nav__list__item"><a href="#<?= $tax_term->slug;?>"><?= $tax_term->name;?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <div class="categories">
        <?php foreach($tax_terms as $tax_term): ?>
            <?php $mdn = new WP_Query([
                'post_type'=>'mdn',
                'order'=>'DESC',
                'order_by'=>'title',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categorymdn',
                        'field'    => 'slug',
                        'terms'    => $tax_term->slug,
                        'order'=>'DESC',
                        'order_by'=>'title',
                    ),
                ),
            ]);?>
            <?php if ($mdn->have_posts()): ?> 
                <div class="category" id="<?= $tax_term->slug;?>">
                <h2 class="category__title"><?= $tax_term->slug;?></h2>
                    <?php while($mdn->have_posts()): $mdn->the_post();?>
                    <div class="category__term" >
                        <h3 class="term__title">
                            <?php if(get_field('mdn__link')):?>
                                <a href="<?= get_field('mdn__link'); ?>">
                                    <?php the_title();?> 
                                </a>
                            <?php else: ?>
                                <?php the_title();?> 
                            <?php endif; ?>
                        </h3>
                        <p class="term__desc">
                            <?= get_field('mdn__desc'); ?>
                        </p>
                    </div>
                    <?php endwhile;  ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
</body>
<footer class="pageFooter mdn">

    <?php get_footer(); ?>
