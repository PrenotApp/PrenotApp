import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                //js
                'resources/js/app.js',
                'resources/js/validations/bookingCreate.js',
                'resources/js/validations/categoryCreate.js',
                'resources/js/validations/rackBooking.js',
                'resources/js/validations/resetPassword.js',
                'resources/js/validations/schoolCreate.js',
                'resources/js/validations/timeCreate.js',
                'resources/js/validations/userLogin.js',
                'resources/js/validations/userRegistration.js',
                'resources/js/bookingsAvailable.js',
                'resources/js/bookingsFilters.js',
                'resources/js/bootstrap.js',
                'resources/js/passwordConfirmationToggle.js',
                'resources/js/passwordToggle.js',
                'resources/js/racksAvailable.js',
                //scss
                'resources/sass/main.scss',
                'resources/sass/_variables.scss',
                'resources/sass/approved/index.scss',
                'resources/sass/approved/trashed.scss',
                'resources/sass/bookings/index.scss',
                'resources/sass/bookings/create.scss',
                'resources/sass/categories/create.scss',
                'resources/sass/errors/style.scss',
                'resources/sass/hours/index.scss',
                'resources/sass/hours/edit.scss',
                'resources/sass/items/show.scss',
                'resources/sass/items/trashed.scss',
                'resources/sass/main/index.scss',
                'resources/sass/manager/index.scss',
                'resources/sass/manager/trashed.scss',
                'resources/sass/racks/booking.scss',
                'resources/sass/racks/create-edit.scss',
            ],
            refresh: true,
        }),
    ],
});
