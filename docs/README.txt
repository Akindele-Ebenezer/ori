# ORI Documentation

## Overview

This is a comprehensive maritime operations management system built with Laravel, designed for shipping companies to manage vessels, track crew availability, document sea service testimonials, and monitor generator equipment. The system supports both web and desktop (Electron) deployments.

### Key Features

- **Vessel Management**: Complete vessel registry with IMO compliance data
- **Crew Tracking**: Employee database with rank-based filtering
- **Sea Service Testimonials**: PDF generation for crew service records
- **Availability Tracking**: Real-time status monitoring for vessels and generators
- **Operational History**: Audit trails and compliance checklists
- **Multi-User System**: Role-based access control
- **Data Import/Export**: Excel import and PDF report generation

### Technology Stack

- **Backend**: Laravel 10.10, PHP 8.1+
- **Database**: MySQL
- **Frontend**: Blade templates, Vite, SASS/CSS
- **Desktop**: Electron 34.0
- **Libraries**: Maatwebsite Excel, FPDF, Guzzle, Axios

## Quick Start

See [Setup Guide](setup.md) for detailed installation instructions.

## Documentation Structure

- [Setup Guide](setup.md) - Installation and configuration
- [Database Design](database.md) - Schema and relationships
- [API Reference](api.md) - Routes and controllers
- [Frontend Guide](frontend.md) - Views and components
- [Deployment](deployment.md) - Production setup
- [Maintenance](maintenance.md) - Code organization and best practices

## Contributing

This documentation is maintained alongside the codebase. For code contributions, see the Laravel framework documentation and follow standard PHP/Laravel coding standards.

## NOTE

This project is proprietary software developed for maritime operations management.