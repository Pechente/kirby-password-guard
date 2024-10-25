# Kirby Password Guard

**Kirby Password Guard** is a simple password protection for your [Kirby](https://getkirby.com/) website. It allows you
to
set a password that needs to be entered in order to access the site. This can be useful for staging sites to prevent
unwanted access. Logged in users can access the site normally but any guest will run into the password entry page.

![kirby-password-guard](https://github.com/user-attachments/assets/2e4596a7-56a9-4084-8b5c-4c3358e4f34c)

****

## Installation

### Download

Download and copy this repository to `/site/plugins/kirby-password-guard`.

### Git submodule

```
git submodule add https://github.com/pechente/kirby-password-guard.git site/plugins/kirby-password-guard
```

### Composer

```
composer require pechente/kirby-password-guard
```

## Setup

### Configuration

Add the following lines to your config.php:

```php
return [
    'rene-henrich.kirby-password-guard' => [
        'enabled' => true, // Optional - default is true
        'password' => 'password', // Required - The password used to access the site
        'pattern' => '(:all)', // Optional - The pattern to protect. By default, all pages are protected. Check the Kirby documentation for more information.
    ]
];
```

### Template

You can overwrite the template for the password form by creating the file `site/templates/password-guard.php`. Here's a
minimal example of this file needs to include:

```php
<!DOCTYPE html>
<html>
<head>
    <title><?= $page->title() ?></title>
</head>
<body>
<form method="post" action="<?= $page->url() ?>">
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <input type="hidden" name="redirect" value="<?= $page->redirect() ?>">
    <button type="submit">Submit</button>
    <?php if ($page->passwordIncorrect()->toBool()): ?>
        <div class="info">Wrong Password</div>
    <?php endif ?>
</form>
</body>
</html>
```

Please keep in mind that you should avoid adding code from your website like the stylesheets or header / footer since it
might defeat the purpose of the password protection.
