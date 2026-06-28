import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/welcome.css',
                'resources/css/customer-cafe-selection.css',
                'resources/css/customer-cart.css',
                'resources/css/customer-login.css',
                'resources/css/customer-menu.css',
                'resources/css/customer-register.css',
                'resources/css/manage-menu.css',
                'resources/css/order-history.css',
                'resources/css/order-status.css',
                'resources/css/owner-dashboard.css',
                'resources/css/owner-login.css',
                'resources/css/owner-menu-create.css',
                'resources/css/owner-menu-edit.css',
                'resources/css/owner-register.css',
                'resources/css/owner-select.css',
                'resources/css/receipt.css',
                'resources/css/admin-dashboard.css',
                'resources/css/admin-report.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});