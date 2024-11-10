<?php

use Kirby\Cms\Page;

Kirby::plugin('pechente/kirby-password-guard', [
    'templates' => [
        'password-guard' => __DIR__ . '/templates/password-guard.php',
    ],
    'snippets' => [
        'panel-icon' => __DIR__ . '/snippets/panel-icon.php',
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
