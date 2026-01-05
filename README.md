# Inventoria - Inventory Management System

Inventoria is a comprehensive inventory management system built with Laravel and Filament. It provides businesses with powerful tools to manage their inventory across multiple locations, track sales and purchases, generate reports, and streamline operations.

## Features

### 🏪 Multi-Location Support
- Manage inventory across multiple warehouses and stores
- Transfer products between locations
- Location-specific stock tracking

### 📦 Product Management
- Comprehensive product catalog with categories and brands
- Product variants and attributes
- Image management for products
- Barcode and SKU support

### 💰 Sales & Purchase Management
- Point of Sale (POS) system
- Sales orders and invoices
- Purchase orders and receipts
- Return management for sales and purchases

### 👥 User Management
- Role-based access control
- User permissions and teams
- Customer and supplier management

### 📊 Reporting & Analytics
- Real-time inventory reports
- Sales and purchase analytics
- Profit and loss statements
- Custom report generation

### 🔄 Stock Management
- Automatic stock updates
- Low stock alerts
- Stock adjustments and counts
- Batch and expiry tracking

### 🛠️ Additional Features
- Manufacturing and production tracking
- Expense management
- Quotation system
- Courier and shipping management
- Multi-currency support

## Technology Stack

- **Framework:** Laravel 11
- **Admin Panel:** Filament 3
- **Database:** MySQL
- **Frontend:** Tailwind CSS, Alpine.js
- **Authentication:** Laravel Breeze

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or compatible database
- XAMPP or similar web server

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/ekenmapeter/Inventoria.git
   cd inventoria
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```
   Configure your database and other settings in `.env`

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the Database (Optional)**
   ```bash
   php artisan db:seed
   ```

8. **Build Assets**
   ```bash
   npm run build
   ```

9. **Start the Development Server**
   ```bash
   php artisan serve
   ```

## Usage

### Admin Panel
Access the admin panel at `/admin` to manage:
- Products and inventory
- Sales and purchases
- Users and permissions
- Reports and analytics

### API Endpoints
The application provides REST API endpoints for integration with other systems.

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support and questions, please open an issue on GitHub or contact the development team.

## Acknowledgments

- Laravel Framework
- Filament Admin Panel
- All contributors and the open-source community
