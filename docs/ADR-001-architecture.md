# ADR 001: Architecture Decision

## Context
Rebuilding a procedural PHP school registration system into a modern, maintainable application.

## Options Considered
- Microservices
- Laravel Modular Monolith
- Serverless

## Decision
**Laravel Modular Monolith**

## Reasons
- Single team
- Single database
- Proven framework
- Appropriate complexity for scale

## Trade-offs
Cannot independently scale components, but unnecessary at this scale.