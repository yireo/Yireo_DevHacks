# Yireo DevHacks
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