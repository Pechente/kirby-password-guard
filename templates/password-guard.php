<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $page->title() ?></title>

  <style><?php F::load($kirby->root('kirby') . '/panel/dist/css/style.min.css'); ?></style>
</head>
<body>
  <div class="k-panel k-panel-outside">
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
            <header class="k-field-header">
              <label class="k-label" title="<?= t('password') ?>">
                <span class="k-label-text"><?= t('password') ?></span>
              </label>
            </header>
            <div class="k-input">
              <span class="k-input-element">
                <input type="password" name="password" id="password" class="k-text-input" autofocus required>
                <input type="hidden" name="redirect" value="<?= $page->redirect() ?>">
              </span>
              <span class="k-input-icon">
                <?= snippet('panel-icon', ['name' => 'key']) ?>
              </span>
            </div>
          </div>
          <div class="k-login-buttons">
            <button data-has-text="true" data-size="lg" data-theme="positive" data-variant="filled" type="submit" class="k-button k-login-button" style="width: 100%">
              <span class="k-button-icon">
               <?= snippet('panel-icon', ['name' => 'unlock']) ?>
              </span>
              <span class="k-button-text"><?= t('lock.unlock') ?></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Cancel button to remove error alert
      const icon = document.querySelector('.k-login-alert-close');
      const alert = document.querySelector('.k-login-alert');
      icon?.addEventListener('click', () => alert?.remove());

      // Password label to focus on input
      const label = document.querySelector('.k-label');
      const input = document.querySelector('.k-text-input');
      label?.addEventListener('click', () => input?.focus());
    });
  </script>
</body>
</html>
