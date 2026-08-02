# Contributing to PSB Online v2

Thank you for considering contributing!

## Development Setup

1. Clone the repository
2. Copy `.env.example` to `.env`
3. Run `composer install`
4. Run `php artisan key:generate`
5. Run `php artisan migrate --seed`
6. Run `php artisan serve`

## Docker Setup

```bash
docker-compose up -d
docker-compose exec app php artisan migrate --seed
```

## Code Standards

- Follow PSR-12 coding standard
- Run `./vendor/bin/pint` before committing
- All new features must include tests
- All tests must pass: `php artisan test`

## Pull Request Process

1. Create a feature branch from `main`
2. Write tests for new functionality
3. Ensure all tests pass
4. Update documentation if needed
5. Submit PR with clear description

## Commit Messages

Follow [Conventional Commits](https://www.conventionalcommits.org/):
- `feat:` New features
- `fix:` Bug fixes
- `docs:` Documentation
- `refactor:` Code refactoring
- `test:` Adding tests
- `chore:` Maintenance