# Yireo DevHacks
Magento 2 module with development hacks

## Skip template path validation
The core checks whether PHTML templates are in the path of the Magento core. When using the `composer` feature `path` to symlink a local repository to Magento, while the path is outside of Magento, this throws an exception. This module simply skips the entire logic. Bam.