# Yireo DevHacks

<!-- badges.specs.start -->
![Magento version](https://img.shields.io/badge/Magento-2.4.6%20%7C%202.4.9-orange)
![PHP version](https://img.shields.io/badge/PHP-8.2%E2%80%938.5-777BB4)
![License](https://img.shields.io/badge/License-OSL--3.0-blue)
![Latest Version](https://img.shields.io/packagist/v/yireo/magento2-devhacks)
<!-- badges.specs.end -->

Magento 2 module with development hacks, that came in handy for myself.

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
![Static Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/static-tests.yml?label=static-tests)
![Unit Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/unit-tests.yml?label=unit-tests)
![Integration Tests](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/integration-tests.yml?label=integration-tests)
![Playwright](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/playwright.yml?label=playwright)
![DI Compilation](https://img.shields.io/github/actions/workflow/status/yireo/Yireo_DevHacks/compile.yml?label=compile)
<!-- badges.test.end -->
