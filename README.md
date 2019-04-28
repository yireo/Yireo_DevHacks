# Yireo DevHacks
Magento 2 module with development hacks, that came in handy for myself.

## Installation
Use the following commands to install:

    composer config repositories.yireo-devhacks vcs git@github.com:yireo/Yireo_DevHacks.git
    composer require yireo-training/magento2-devhacks:dev-master

Enable this module:

    ./bin/magento module:enable Yireo_DevHacks
    ./bin/magento setup:upgrade

## Skip template path validation
The core checks whether PHTML templates are in the path of the Magento core. When using the `composer` feature `path` to symlink a local repository to Magento, while the path is outside of Magento, this throws an exception. This module simply skips the entire logic. No configuration needed. Bam.

## Toggle TESTS_CLEANUP in integration tests configuration
When running integration tests, you probably want to frequently toggle the constant `TESTS_CLEANUP` from `disabled` to `enabled` to `disabled`. The following command-line easily allows for this (assuming the file is actually `dev/tests/integration/phpunit.xml` cause you shouldn't modify the `*.dist` version):

    bin/magento yireo_devhacks:toggle_testscleanup
    
It is toggled. Bam.