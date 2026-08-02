# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [2.0.0] - 2026-08-02

### Added
- Complete Laravel 11 rebuild from procedural PHP
- Admin authentication with bcrypt and rate limiting
- Public student registration with form validation
- Registration status checking by number
- Admin dashboard with enrollment statistics
- CRUD operations for student registrations
- Audit logging for all admin actions
- Database migrations with foreign keys and indexes
- PHPUnit feature tests (11 tests)
- Docker Compose setup (PHP-FPM + Nginx + MySQL)
- GitHub Actions CI pipeline
- Health check endpoint
- Architecture Decision Records (ADR-001)
- ERD documentation

### Security
- Replaced MD5 password hashing with bcrypt
- Eliminated all SQL injection vectors via Eloquent ORM
- Added CSRF protection on all forms
- Implemented login rate limiting (5 attempts per minute)
- Added input validation via Form Request classes
- Session fixation protection via regeneration

### Removed
- Legacy procedural PHP files (deprecated, still in repo)

## [1.0.0] - 2020-04-21

### Added
- Initial procedural PHP implementation
- Basic CRUD with raw MySQL queries
- Simple login system