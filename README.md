# Me Earning

Me Earning is a Laravel referral-earning platform with plan activation, manual JazzCash/EasyPaisa deposits, withdrawals, referral commissions, and an admin area.

## Requirements

- PHP 8.3 or newer with Laravel's required extensions
- Composer
- MySQL
- Node.js and npm

## Local Setup

1. Install PHP dependencies and create the environment file:

   ```powershell
   composer install
   if (-not (Test-Path .env)) { Copy-Item .env.example .env }
   ```

2. Configure `.env` for your local MySQL database. Set private admin credentials before seeding:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=uzairproject
   DB_USERNAME=root
   DB_PASSWORD=
   ADMIN_EMAIL=your-admin@example.com
   ADMIN_PASSWORD=use-a-unique-strong-password
   ```

3. Initialize the application:

   ```powershell
   php artisan key:generate
   php artisan migrate
   php artisan db:seed
   npm install
   npm run build
   ```

The seeder creates the starter Premium plan. It creates an admin only when `ADMIN_EMAIL` and `ADMIN_PASSWORD` are set. Never commit `.env` or real credentials.

## Web Server

Set the virtual host and production web server document root to this project's `public/` directory. Do not serve the repository root: it contains application source, dependencies, environment examples, and Git metadata. Disable directory listing.

## Fixes In This Checkout

- Deposit submissions must match the selected plan price; payment transaction IDs cannot be reused for the same payment method.
- Withdrawal deductions and admin decisions are transactional. Rejection restores the amount and fee and can only happen once.
- Deposit approval is atomic and one-time. The Rs 20 direct-referral bonus is paid after the referred user's first approved plan.
- User email verification now uses Laravel's verification contract; login attempts are rate-limited.
- Contact submissions are emailed to `CONTACT_FORM_RECIPIENT`; WhatsApp links use the shared `WHATSAPP_NUMBER` setting.
- The seeder is repeatable and contains no fixed admin password. `composer run setup` seeds the starter plan.
- Feature tests cover deposit validation, duplicate payment references, withdrawal refunds, referral bonuses, contact mail, and verification mail.

## Remaining Checks

- The payment-reference index migration has been applied to the local `uzairproject` database. On another database, run `php artisan migrate`; resolve any duplicate `(method, transaction_id)` values before adding the unique index. Do not drop the database to work around this.
- Confirm `WHATSAPP_NUMBER` is the correct business number and `CONTACT_FORM_RECIPIENT` is monitored.
- Configure a real SMTP/mail provider for deployment. The example environment uses the `log` mailer, which writes messages to Laravel logs instead of delivering them.
- If this database was seeded by an older version, rotate or remove any admin account that still uses the former default password.
- Test a real deposit approval, withdrawal approval/rejection, signup verification link, contact email, and admin login in the target environment.
- The checks below passed locally after these fixes. Run them again after later changes.

## Checks

```powershell
php artisan test
php artisan view:cache
npm run build
```
