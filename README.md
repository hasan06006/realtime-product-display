Laravel Project Documentation: Realtime Product Display App with Real-Time Updates using Pusher
#STEP-1
###Create a New Laravel Project
composer create-project --prefer-dist laravel/laravel realtime-product-display
Navigate to the Project Folder

#STEP-2
cd realtime-product-display

#STEP-3
###Install Required Packages

composer require pusher/pusher-php-server guzzlehttp/guzzle
Configure .env for Pusher
Add Pusher credentials to .env:

PUSHER_APP_ID=your-id
PUSHER_APP_KEY=your-key
PUSHER_APP_SECRET=your-secret
PUSHER_APP_CLUSTER=your-cluster
Set Up Pusher in broadcasting.php
Update config/broadcasting.php with Pusher details.

#STEP-4
###Create Product Model and Migration


php artisan make:model Product -m
Update the migration for name, description, price.

#STEP-5
###Create Product Controller (Fetch products from Fake Store API and store in the database. Use event(new ProductUpdated()); to broadcast updates.)
php artisan make:controller ProductController

#STEP-6
###Create Event for Broadcasting

php artisan make:event ProductUpdated
Broadcast product updates via Pusher.

#STEP-7
###Create Blade View (Display products and listen for real-time updates using Pusher in the Blade view.)

#STEP-8
###Define Routes (In routes/web.php)


Route::get('/products', [ProductController::class, 'index']);
Route::get('/fetch-products', [ProductController::class, 'fetchProducts']);
Start Laravel Server

#STEP-9
php artisan serve
Access at
http://localhost:8000/products
