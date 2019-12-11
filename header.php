<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= get_field("meta__description"); ?>">
    <meta name="keywords" content="<?= get_field("meta__keywords"); ?>">
    <link rel="stylesheet" href="<?= assets('./dist/app.css'); ?>">
    <title><?php the_title(); ?> - Webartisan</title>
    <?php wp_head(); ?>
</head>

<body>
    <header class="header container">
        <a class="header__logo" href="<?= get_home_url(); ?>">
            <?php $logo = get_field('logo__white', 'options'); ?>
            <?= wp_get_attachment_image($logo, "full"); ?>
        </a>
        <div class="burger">
            <input type="checkbox" name="burger" id="burger" class="burger__check">
            <label for="burger">
                <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                    <line fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" x1="88" y1="21.5" x2="37" y2="21.5" />
                    <line fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" x1="88" y1="45.5" x2="12" y2="45.5" />
                    <line fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" x1="88" y1="67.5" x2="37" y2="67.5" />
                </svg>
            </label>
            <div class="burger__nav">
            <a class="header__logo" href="<?= get_home_url(); ?>">
                <?php $logo = get_field('logo__dark', 'options'); ?>
                <?= wp_get_attachment_image($logo, "full"); ?>
            </a>
            <form id="" method="get" class="burger__search" action="<?= home_url('/'); ?>">
                <label class="search__label" for="search">
                    <span class="sr-only">Rechercher</span>
                </label>
                <input type="search" class="search-field" name="s" id="s" placeholder="Rechercher" value="<?php the_search_query(); ?>">
                <button type="submit" class="sr-only">Rechercher</button>
            </form>
            <label for="burger" class="burger">
                <svg version="1.1" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                    <line fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" x1="88" y1="21.5" x2="37" y2="21.5" />
                    <line fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" x1="88" y1="45.5" x2="12" y2="45.5" />
                    <line fill="none" stroke="#000000" stroke-width="5" stroke-linecap="round" stroke-miterlimit="10" x1="88" y1="67.5" x2="37" y2="67.5" />
                </svg>
            </label>
                <?php wp_nav_menu(array('menu' => 'main')); ?>
                <?php if (!is_user_logged_in()) : ?>
                    <a class="burger__connexion" href="<?= the_permalink(106); ?>">Connexion</a>
                <?php else : ?>
                    <a class="burger__connexion" href="<?= wp_logout_url(get_permalink($post->ID)); ?>">Déconnexion</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="header__nav" role="navigation">
            <?php wp_nav_menu(array('menu' => 'main')); ?>
            <div class="header__search">
                <label for="search__button">
                    <img src="<?= assets('./dist/icons/search.svg'); ?>" alt="" class="search__icon">
                </label>
                <input type="checkbox" name="search__button" id="search__button" class="sr-only search__input">
                <form id="searchform" method="get" action="<?= home_url('/'); ?>">
                    <label class="search__label" for="search">
                        <span class="sr-only">Rechercher</span>
                    </label>
                    <input type="search" class="search-field" name="s" id="s" placeholder="Rechercher" value="<?php the_search_query(); ?>">
                    <button type="submit" class="sr-only">Rechercher</button>
                </form>
            </div>
            <?php if (!is_user_logged_in()) : ?>
                <a class="header__connexion" href="<?= the_permalink(106); ?>">Connexion</a>
            <?php else : ?>
                <a class="header__connexion" href="<?= wp_logout_url(get_permalink($post->ID)); ?>">Déconnexion</a>
            <?php endif; ?>
        </div>
    </header>

    