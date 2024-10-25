<!DOCTYPE html>
<html>
<head>
    <title><?= $page->title() ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        :root {
            --button-color: #D1E9A3;
            --button-color--hover: #CBE29E;
            --color--error: #F6B1B1;
        }

        * {
            box-sizing: border-box;
        }

        html {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
            font-size: 16px;
            height: 100%;
        }

        body {
            padding: 1.5rem;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #F0F0F0;
            height: 100%;
        }

        form {
            width: 22rem;
            max-width: 100%;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .05), 0 1px 2px 0 rgba(0, 0, 0, .025);
            overflow: hidden;
        }

        .fields {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            padding: 1.5rem;
        }

        h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        label {
            font-size: 0.875rem;
            font-weight: 500;
        }

        input[type='password'] {
            border: 1px solid #ccc;
            border-radius: 0.25rem;
            padding: 0.66rem 0.5rem;
            border:
        }

        button[type='submit'] {
            font: inherit;
            padding: 0.75rem;
            border-radius: 0.25rem;
            font-weight: 500;
            font-size: 0.875rem;
            appearance: none;
            border: 0;
            background: var(--button-color);

            &:hover {
                cursor: pointer;
                background: var(--button-color--hover);
            }
        }

        .info {
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            background: var(--color--error);
        }
    </style>
</head>
<body>
<form method="post" action="<?= $page->url() ?>">
    <?php if ($page->passwordIncorrect()->toBool()): ?>
        <div class="info">
            <?= kirby()->translation()->get('error.user.password.wrong') ?>
        </div>
    <?php endif ?>
    <div class="fields">
        <label for="password"><?= kirby()->translation()->get('password') ?></label>
        <input type="password" name="password" id="password" required>
        <input type="hidden" name="redirect" value="<?= $page->redirect() ?>">
        <button type="submit">
            <?= kirby()->translation()->get('lock.unlock') ?>
        </button>
    </div>
</form>
</body>
</html>
