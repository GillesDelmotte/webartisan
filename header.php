<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?= get_field("meta__description");?>">
    <meta name="keywords" content="<?= get_field("meta__keywords");?>">
    <link rel="stylesheet" href="<?= assets('./dist/app.css'); ?>">
    <title><?php the_title(); ?> - Webartisan</title>
</head>
<body>

<header class="header">
    <a class="header__logo" href="<?= get_home_url();?>">
        <?php $logo = get_field('logo__white', 'options'); ?>
        <?= wp_get_attachment_image( $logo, "full" ); ?>
    </a>
    <div class="header__nav" role="navigation">
        <?php wp_nav_menu(); ?>
        <?php if(!is_user_logged_in()): ?>
            <a class="header__connexion" href="<?= the_permalink(106); ?>">Connexion</a>
        <?php else: ?>
            <a class="header__connexion" href="<?= wp_logout_url( get_permalink($post->ID) ); ?>">Déconnexion</a>
        <?php endif; ?>
    </div>
</header>
