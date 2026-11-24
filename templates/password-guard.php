<?php $nonce = option('pechente.kirby-password-guard.nonce', true) ? $kirby->nonce() : null; ?>
<!DOCTYPE html>
<html lang="<?= $kirby->language()?->code() ?>">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $page->title() ?></title>

  <style<?= $nonce ? ' nonce="' . $nonce . '"' : '' ?>>
    <?php F::load($kirby->root('kirby') . '/panel/dist/css/style.min.css'); ?>
    .k-login-button-full { width: 100%; }
    .k-login {
      --dialog-color-back: light-dark(var(--color-white), var(--color-gray-950));
      --dialog-shadow: none;
    }
    .k-login-form {
      display: block;
      padding: 0;
      background: none;
      border-radius: 0;
    }
    .k-login-buttons {
      --button-padding: var(--spacing-3);
      display: flex;
      margin-top: var(--spacing-6);
    }
  </style>
</head>
<body>
  <main class="k-panel k-panel-outside">
    <div class="k-dialog k-login k-login-dialog">
      <?php if($page->passwordIncorrect()->toBool()): ?>
      <div data-theme="error" class="k-notification k-login-alert">
        <p><?= t('error.user.password.wrong') ?></p>
        <button type="button" class="k-button k-login-alert-close">
          <span class="k-button-icon">
            <?= snippet('panel-icon', ['name' => 'cancel']) ?>
          </span>
        </button>
      </div>
      <?php endif ?>
      <div class="k-dialog-body">
        <form class="k-login-form" method="post" action="<?= $page->url() ?>">
          <div class="k-login-fields">
            <div class="k-field-header">
              <label for="password" class="k-label" title="<?= t('password') ?>">
                <span class="k-label-text"><?= t('password') ?></span>
              </label>
            </div>
            <div class="k-input">
              <span class="k-input-element">
                <input type="password" name="password" id="password" class="k-password-input k-string-input" autofocus required>
                <input type="hidden" name="redirect" value="<?= $page->redirect() ?>">
              </span>
              <span class="k-input-icon">
                <?= snippet('panel-icon', ['name' => 'key']) ?>
              </span>
            </div>
          </div>
          <div class="k-login-buttons">
            <button data-has-text="true" data-size="lg" data-theme="positive" data-variant="filled" type="submit" class="k-button k-login-button k-login-button-full">
              <span class="k-button-icon">
               <?= snippet('panel-icon', ['name' => 'unlock']) ?>
              </span>
              <span class="k-button-text"><?= t('lock.unlock') ?></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>

  <script<?= $nonce ? ' nonce="' . $nonce . '"' : '' ?>>
    document.addEventListener('DOMContentLoaded', function () {
      // Cancel button to remove error alert
      const icon = document.querySelector('.k-login-alert-close');
      const alert = document.querySelector('.k-login-alert');
      icon?.addEventListener('click', () => alert?.remove());
    });

    // Password label to focus on input
    (function () {
      const input = document.getElementById('password');
      const focusInput = () => input?.focus({ preventScroll: true });
      focusInput();
      window.addEventListener('pageshow', focusInput);
    })();
  </script>
</body>
</html>
