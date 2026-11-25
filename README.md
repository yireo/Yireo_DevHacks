# Yireo DevHacks

<!-- badges.specs.start -->
<div class="github-specs-badges">

![Magento version](https://img.shields.io/badge/Magento-2.4.6%20%7C%202.4.9-orange)
![PHP version](https://img.shields.io/badge/PHP-8.2%E2%80%938.5-777BB4)
![License](https://img.shields.io/badge/License-OSL--3.0-blue)
![Latest Version](https://img.shields.io/packagist/v/yireo/magento2-devhacks)

</div>
<!-- badges.specs.end -->

Magento 2 module with development hacks, that came in handy for myself.

## Warning: development only
Never install this module in production, or on any publicly reachable environment. It deliberately disables security checks of the Magento core.

The command `bin/magento yireo_devhacks:copy_hacks` overwrites the following core files in `vendor/magento/framework` with the files in `Copy/`:

- `Filesystem/Directory/PathValidator.php`: path validation is disabled, so directory objects no longer block path traversal;
- `View/Element/Template/File/Validator.php`: any file on disk is accepted as a template;
- `Filesystem/Driver/File.php`: any path starting with `/data/git/yireo` is returned as absolute path without validation. This file is a frozen copy of the core driver and replaces newer core versions (including security fixes).

These overwrites stay in place after the module is disabled or removed. Restore the original core files with:

    composer reinstall magento/framework

Consider the core alternatives first:
- `bin/magento config:set dev/template/allow_symlink 1` to allow templates outside of the Magento root;
- `bin/magento setup:static-content:deploy --no-html-minify` to skip HTML minification.

The other hacks of this module (skipping HTML minification and throwing an exception for blocks without a template file) are only active in developer mode.

## Installation
Use the following commands to install:

    composer require yireo/magento2-devhacks:@dev --dev

Enable this module:

    ./bin/magento module:enable Yireo_DevHacks
    ./bin/magento setup:upgrade

## Skip template path validation
The core checks whether PHTML templates are in the path of the Magento core. When using the `composer` feature `path` to symlink a local repository to Magento, while the path is outside of Magento, this throws an exception. This module simply skips the entire logic. No configuration needed. Bam.

## Toggle TESTS_CLEANUP in integration tests configuration
Moved to separate Yireo_IntegrationTestHelper module instead.
## Current status

<!-- badges.test.start -->
<div class="github-pipeline-badges">

![Static Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/static-tests.yml?label=static-tests)
![Unit Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/unit-tests.yml?label=unit-tests)
![Integration Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/integration-tests.yml?label=integration-tests)
![Playwright](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/playwright.yml?label=playwright)
![DI Compilation](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/compile.yml?label=compile)

</div>
<!-- badges.test.end -->
