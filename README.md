# Relationships WordPress Plugin

## Development

### Local environment

The project uses [`@wordpress/env`](https://developer.wordpress.org/block-editor/reference-guides/packages/packages-env) to run a local WordPress environment. To get started, run the following commands:

```bash
npm install
npm run wp-env:start
npm run wp:rewrite
npm run composer install
```

The WordPress environment will be available at `http://localhost:8890`.

### I18n

We use i18n-midoru to make pots, uploads pots and download translations from Localise. It has one relevant file for configuration `i18n-midoru.json` in the root. This file has a list of projects, indexed by their name and with configurations for making pots, uploading pots and downloading translations. A generated file `i18n-midoru.lock` can also be found in the root after downloading translations. This file is used to poll Localise for new changes when trying to download translations again.

#### Make pots

Before making pots, make sure to build the assets first. To make the pots, run the following command:

```bash
composer run-script make-pots
```

To make pots for a specific project, add the name of the project (key string in the i18n-midoru.json) as an argument to the command.

#### Upload pots

To upload pots to Localise, run the following command:

```bash
composer run-script upload-pots
```

To upload pots for a specific project, add the name of the project (key string in the i18n-midoru.json) as an argument to the command.

#### Download translations

To download translations from Localise, run the following command:

```bash
composer run-script download-translations
```

To download translations for a specific project, add the name of the project (key string in the i18n-midoru.json) as an argument to the command.

#### New projects

Replace 'wp-relationships' to the new domain string in the `i18n-midoru.json` file.

Add new projects to `i18n-midoru.json` if needed.

Set/replace the environment variables `LOCALISE_{project_name}` for every project with the full access keys from Localise.
