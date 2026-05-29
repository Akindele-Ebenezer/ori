# Sea Service Testimonial & Vessel Tracker

A comprehensive maritime operations management system built with Laravel, designed for shipping companies to manage vessels, track crew availability, document sea service testimonials, and monitor generator equipment.

## Features

- **Vessel Management**: Complete vessel registry with IMO compliance data
- **Crew Tracking**: Employee database with rank-based filtering
- **Sea Service Testimonials**: PDF generation for crew service records
- **Availability Tracking**: Real-time status monitoring for vessels and generators
- **Operational History**: Audit trails and compliance checklists
- **Multi-User System**: Role-based access control
- **Data Import/Export**: Excel import and PDF report generation

## Documentation

Complete documentation is available in the `docs/` folder:

- [Setup Guide](docs/setup.md) - Installation and configuration
- [Database Design](docs/database.md) - Schema and relationships
- [API Reference](docs/api.md) - Routes and controllers
- [Frontend Guide](docs/frontend.md) - Views and components
- [Deployment](docs/deployment.md) - Production setup
- [Maintenance](docs/maintenance.md) - Code organization and best practices

## Quick Start

1. Clone the repository
2. Run `composer install`
3. Run `npm install && npm run build`
4. Configure your `.env` file
5. Run `php artisan migrate`
6. Start the server with `php artisan serve`

## Technology Stack

- **Backend**: Laravel 10.10, PHP 8.1+
- **Database**: MySQL
- **Frontend**: Blade templates, Vite, SASS/CSS
- **Desktop**: Electron 34.0
- **Libraries**: Maatwebsite Excel, FPDF, Guzzle, Axios

## License

This project is proprietary software developed for maritime operations management.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
