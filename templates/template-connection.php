<?php /*Template name: page de connexion*/ ?>
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
<body class="connection">
<header class="header--connection">
    <a class="header__logo" href="<?= get_home_url();?>">
        <?php $logo = get_field('logo__dark', 'options'); ?>
        <?= wp_get_attachment_image( $logo, "full" ); ?>
    </a>
</header>
<section class="forms">
    <div>
        <h1 class="forms__title">Connexion</h1>
        <form action="<?= admin_url('admin-post.php') ;?>" method="POST" class="js-form-login">
            <input type="hidden" name="action" value="post_login">
            <div class="form__field">
                <label for="nameConnection" class="form__field__label">Email&nbsp;:</label>
                <div class="form__field__input">
                    <input type="text" id="nameConnection" name="name" placeholder="Entrez votre nom d‘utilisateur ou votre email ici">
                </div>
            </div>
            <div class="form__field">
                <label for="passwordConnection" class="form__field__label">Mot de passe&nbsp;:</label>
                <div class="form__field__input">
                    <input type="password" id="passwordConnection" name="password" placeholder="Entrez votre mot de passe ici">
                </div>
            </div>
            <div class="form__action">
                <button type="submit" name="submit" class="form__action__submit">Connexion</button>
                <a href="" class="form__action__forgot links">Mot de passe oublié</a>
            </div>
            <?php wp_nonce_field( 'ajax-login-nonce', 'securityConnection' ); ?>
        </form>
    </div>
    <div>
        <h1 class="forms__title">Inscription</h1>
        <form action="" method="POST">
            <div class="form__field">
                <label for="emailInscription" class="form__field__label">Email&nbsp;:</label>
                <div class="form__field__input">
                    <input type="text" id="emailInscription" name="email" placeholder="Entrez votre email ici">
                </div>
            </div>
            <div class="form__field">
                <label for="nameInscription" class="form__field__label">Nom d'utilisateur&nbsp;:</label>
                <div class="form__field__input">
                    <input type="text" id="nameInscription" name="name" placeholder="Entrez votre nom d‘utilisateur ici">
                </div>
            </div>
            <div class="form__field">
                <label for="passwordINscription" class="form__field__label">Mot de passe&nbsp;:</label>
                <div class="form__field__input">
                    <input type="password" id="passwordInscription" name="password" placeholder="Entrez votre mot de passe ici">
                </div>
            </div>
            <div class="form__field">
                <label for="passwordConfirm" class="form__field__label">Confirmation du mot de passe&nbsp;:</label>
                <div class="form__field__input">
                    <input type="password" id="passwordConfirm" name="passwordConfirm" placeholder="Confirmez votre mot de passe ici">
                </div>
            </div>
            <div class="form__action">
                <button type="submit" name="submit" class="form__action__submit">Inscription</button>
            </div>
        </form>
    </div>
</section>
<footer class="pageFooter connexion">
<?php get_footer(); ?> 