<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= assets('./dist/app.css'); ?>">
    <title>Webartisan</title>
</head>
<body>

<header class="header">
    <a class="header__logo" href="<?= get_home_url();?>">
        <?php $logo = get_field('logo__dark', 'options'); ?>
        <?= wp_get_attachment_image( $logo, "full" ); ?>
    </a>
    <div class="header__nav">
        <?php wp_nav_menu(); ?>
        <a class="header__connexion" href="<?= wp_login_url( $redirect ); ?> ">Connexion</a>
    </div>
</header>
