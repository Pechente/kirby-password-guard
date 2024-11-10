<?php

use Kirby\Cms\Page;

function panelIcon($name): string|false
{
    $panelIcons = svg('kirby/panel/dist/img/icons.svg');

    if ($panelIcons) {
        if (preg_match('/<symbol[^>]*id="icon-' . $name . '"[^>]*viewBox="(.*?)"[^>]*>(.*?)<\/symbol>/s', $panelIcons, $matches)) {

            if (preg_match('/<use href="#icon-(.*?)"[^>]*?>/s', $matches[2], $use)) {
                return icon($use[1]);
            }


            return '<svg class="k-icon" data-type="' . $name . '" xmlns="http://www.w3.org/2000/svg" viewBox="' . $matches[1] . '">' . $matches[2] . '</svg>';
        }
    }

    return false;
}

Kirby::plugin('pechente/kirby-password-guard', [
    'templates' => [
        'password-guard' => __DIR__ . '/templates/password-guard.php',
    ],
    'routes' => [
        [
            'pattern' => 'password-guard',
            'language' => '*',
            'method' => 'POST',
            'action' => function () {
                $password = get('password');
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $session = kirby()->session();
                $session->set('kirby-password-guard.password-hash', $hashedPassword);

                $redirect = get('redirect');

                kirby()->response()->redirect($redirect);
            }
        ],
        [
            'pattern' => option('pechente.kirby-password-guard.pattern', '(:all)'),
            'method' => 'GET',
            'action' => function (string $uid) {
                if (
                    option('pechente.kirby-password-guard.enabled') === false ||
                    !option('pechente.kirby-password-guard.password') ||
                    kirby()->user()
                ) {
                    $this->next();
                }
                $passwordIncorrect = false;
                // check session for password
                $session = kirby()->session();
                $hash = $session->get('kirby-password-guard.password-hash');
                $password = option('pechente.kirby-password-guard.password');

                // Display the page if the password is correct
                if ($hash) {
                    if (password_verify($password, $hash)) {
                        $this->next();
                    } else {
                        $passwordIncorrect = true;
                        kirby()->session()->remove('kirby-password-guard.password-hash');
                    }
                }

                // Render the Password Entry Page if it's not correct
                $passwordPage = new Page([
                    'slug' => 'password-guard',
                    'template' => 'password-guard',
                    'content' => [
                        'title' => 'Password Guard',
                        'redirect' => url($uid),
                        'passwordIncorrect' => $passwordIncorrect
                    ]
                ]);

                return $passwordPage->render();
            }
        ]
    ],
]);
