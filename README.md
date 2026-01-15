# CompServe

<div align="center">

**A modern freelancing platform connecting computer technicians with clients**

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![Docker](https://img.shields.io/badge/Docker-ready-blue.svg)](https://www.docker.com)

</div>

## 📋 Overview

CompServe is a specialized freelancing platform designed to bridge the gap between skilled computer technicians and clients seeking technical services. Whether you're a technician looking for gigs or a client needing IT support, CompServe provides a streamlined marketplace for computer service contracts.

### Key Features

- **Technician Profiles**: Showcase skills, certifications, and previous work
- **Service Marketplace**: Browse and post computer service opportunities
- **Contract Management**: Handle agreements and project timelines efficiently
- **Secure Payments**: Manage transactions safely within the platform
- **Rating System**: Build reputation through client feedback

## 🚀 Getting Started

### Prerequisites

Before you begin, ensure you have the following installed:

- [Docker](https://www.docker.com/get-started) and Docker Compose
- [Composer](https://getcomposer.org/) (v2.0 or higher)
- [PHP](https://www.php.net/) (v8.1 or higher)
- [Node.js](https://nodejs.org/) (v18 or higher) and npm

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/ReinX24/CompServe.git
   cd CompServe
   ```

2. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   Edit the `.env` file with your database credentials and application settings.

3. **Build and start Docker containers**
   ```bash
   docker compose up -d
   ```

4. **Install dependencies**
   ```bash
   cd CompServe
   composer install
   npm install
   ```

5. **Generate application key**
   ```bash
   php artisan key:generate
   ```

6. **Run database migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database (optional)**
   ```bash
   php artisan db:seed
   ```

8. **Start the development server**
   ```bash
   composer run dev
   ```

The application should now be running at `http://localhost:8000`

## 🛠️ Technology Stack

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: MySQL/PostgreSQL
- **Containerization**: Docker & Docker Compose
- **Package Management**: Composer, NPM

## 📁 Project Structure

```
CompServe/
├── app/                    # Application core files
├── config/                 # Configuration files
├── database/              # Migrations, seeders, factories
├── public/                # Public assets
├── resources/             # Views, raw assets
├── routes/                # Application routes
├── storage/               # Application storage
├── tests/                 # Automated tests
├── docker-compose.yml     # Docker configuration
└── .env.example          # Environment template
```

## 🧪 Testing

Run the test suite:

```bash
php artisan test
```

For specific test types:
```bash
php artisan test --testsuite=Feature
php artisan test --testsuite=Unit
```

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

Please ensure your code follows PSR-12 coding standards and includes appropriate tests.

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 👥 Authors

- **ReinX24** - *Initial work* - [GitHub Profile](https://github.com/ReinX24)

## 📧 Support

For support, email [your-email@example.com] or open an issue in the GitHub repository.

## 🗺️ Roadmap

- [ ] Real-time chat between technicians and clients
- [ ] Advanced search and filtering
- [ ] Mobile application
- [ ] Integration with payment gateways
- [ ] Multi-language support
- [ ] Service subscription plans

## 🙏 Acknowledgments

- Laravel community for excellent documentation
- All contributors who help improve CompServe
- Open source packages that make this project possible

---

<div align="center">
Made with ❤️ by the CompServe Team
</div>