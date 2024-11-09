<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title><?= $page->title() ?></title>
    
  <link rel="stylesheet" href="<?= $kirby->url('media') . '/panel/' . $kirby->versionHash() . '/css/style.min.css' ?>">
</head>
<body>
  <div class="k-panel k-panel-outside">
    <div class="k-dialog k-login k-login-dialog">
      <?php if($page->passwordIncorrect()->toBool()): ?>
      <div data-theme="error" class="k-notification k-login-alert">
        <p><?= t('error.user.password.wrong') ?></p>
        <button type="button" class="k-button k-login-alert-close">
          <span class="k-button-icon">
            <svg class="k-icon" viewBox="0 0 24 24">
              <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM12 10.5858L14.8284 7.75736L16.2426 9.17157L13.4142 12L16.2426 14.8284L14.8284 16.2426L12 13.4142L9.17157 16.2426L7.75736 14.8284L10.5858 12L7.75736 9.17157L9.17157 7.75736L12 10.5858Z"></path>
            </svg>
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
                <svg class="k-icon" viewBox="0 0 24 24">
                  <path d="M10.7577 11.8279L18.6066 3.979L20.0208 5.39322L18.6066 6.80743L21.0815 9.28231L19.6673 10.6965L17.1924 8.22164L15.7782 9.63586L17.8995 11.7572L16.4853 13.1714L14.364 11.0501L12.1719 13.2421C13.4581 15.1835 13.246 17.8249 11.5355 19.5354C9.58291 21.488 6.41709 21.488 4.46447 19.5354C2.51184 17.5827 2.51184 14.4169 4.46447 12.4643C6.17493 10.7538 8.81633 10.5417 10.7577 11.8279ZM10.1213 18.1211C11.2929 16.9496 11.2929 15.0501 10.1213 13.8785C8.94975 12.7069 7.05025 12.7069 5.87868 13.8785C4.70711 15.0501 4.70711 16.9496 5.87868 18.1211C7.05025 19.2927 8.94975 19.2927 10.1213 18.1211Z"></path>
                </svg>
              </span>
            </div>
          </div>
          <div class="k-login-buttons">
            <button data-has-text="true" data-size="lg" data-theme="positive" data-variant="filled" type="submit" class="k-button k-login-button" style="width: 100%">
              <span class="k-button-icon">
                <svg class="k-icon" viewBox="0 0 24 24">
                  <path d="M7 10H20C20.5523 10 21 10.4477 21 11V21C21 21.5523 20.5523 22 20 22H4C3.44772 22 3 21.5523 3 21V11C3 10.4477 3.44772 10 4 10H5V9C5 5.13401 8.13401 2 12 2C14.7405 2 17.1131 3.5748 18.2624 5.86882L16.4731 6.76344C15.6522 5.12486 13.9575 4 12 4C9.23858 4 7 6.23858 7 9V10ZM5 12V20H19V12H5ZM10 15H14V17H10V15Z"></path>
                </svg>
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
