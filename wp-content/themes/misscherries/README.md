# Seed Theme

## Requirements

- node/npm
- composer

## Basic Configuration

- Change `Theme Name`, `Description` and `Text Domain`, with your theme configuration on `style.css`.
- Change name of defined vars on `inc/config/definitions.php` replacing `SEED` with your theme name. Also, replace the value of `SEED_THEME_NAME` with your theme slug.
- Change name of defined vars on `inc/config/_enqueue.config.php` replacing `SEED` with your theme name.
- Copy `.env-example` and rename it as `.env`. Modify the value of  `DEVELOPMENT_URL` var with the site url of your WordPress.
- If you download this theme through a git repository, remove the `.git` folder

Execute the following command:

```sh
npm install
```

## Developing task

To develop with the theme you only need to launch the following task.

```sh
npm start
```

## Build Theme

For production you need to build the theme:

```sh
npm run build
```

This will create a `dist` folder to upload. within the theme. The folder src doesn't need to be uploaded.
