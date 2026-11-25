# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.2.0] - 25 November 2026
### Added
- Skip HTML minification of PHTML templates during static content deployment (only in developer mode)

### Changed
- Require PHP 8.2 up to 8.5; PHP 8.1 and older are no longer supported
- Declare the missing dependencies on Magento_Deploy and Magento_Store
- README now warns that this module is for development only and lists the core files that the copy command overwrites

### Fixed
- Blocks without a template file no longer throw an exception outside developer mode
- jQuery Migrate warnings are no longer silently muted on every frontend page
- PHP 8.4 deprecation warnings about implicitly nullable parameters in the copied filesystem driver

## [0.1.3] - 22 October 2025
### Fixed
- Add hacked copy of File
- Remove old hacks
- Add dev keyword
- Make exception on empty templates more readable
- Symfony 6 compliance
- Add new override
- Remove integration test CLI
- Add very simple live test

## [0.1.2] - 2021-05-13
### Fixed
- Fix new path validator by using "hack files"

## [0.1.1] - 2020-07-29
### Fixed
- Fixed 2.4 compatibility

## [0.1.0] - 2019-04-28
### Added
- Toggle TESTS_CLEANUP in integration tests configuration

## [0.0.1] - 2019-03
### Added
- Skip template path validation
