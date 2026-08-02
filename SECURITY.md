# Security Policy

## Supported Versions

| Version | Supported |
|---------|-----------|
| 2.x     | ✅         |
| 1.x     | ❌         |

## Reporting a Vulnerability

If you discover a security vulnerability, please report it responsibly:

1. **Do NOT** open a public GitHub issue
2. Email: security@psb-online.test
3. Include steps to reproduce
4. Allow 48 hours for initial response

## Security Measures

- bcrypt password hashing
- CSRF protection on all forms
- SQL injection prevention via Eloquent ORM
- XSS prevention via Blade auto-escaping
- Login rate limiting (5 attempts/minute)
- Session fixation protection
- Audit logging for admin actions