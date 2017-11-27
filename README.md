# Laravel PayFort
- * This package is not a official package from PayFort just my develop *
- it's a laravel package for [PayFort](https://www.payfort.com) Integration

# 1- Installation
1. Require the package using composer:

    ```
    composer require ahyadessam/payfort
    ```

2. Add the service provider to the `providers` in `config/app.php`:

    ```php
    Payfort\PayfortServiceProvider::class,

    ```

3. Add alias provider to the `aliases` in `config/app.php`:

    ```php
    'PayFort' => Payfort\PayFortFacade::class,

    ```

4. Publish the public assets:

    ```
    php artisan vendor:publish
    ```

5. Configure your `PayFort` account data in `config/payfort.php`:

# 2- Content Methods
- `RedirectionPay` : Go to payment page.
- `SADAD` : Got to SADAD page.
- `statusMsg` : Return what status number mean.

# Parameters is needed
You can lookup `PayFort Documentations` on this URL [PayFort Documentations](https://docs.payfort.com)

# Example for payment page
```php
use PayFort;

$requestParams = array(
  'merchant_reference' => '11',
  'amount' => '1000',
  'currency' => 'SAR',
  'customer_email' => 'test@payfort.com',
  'order_description' => 'iPhone 6-S',
  'return_url'    => url('test_r')
);
PayFort::SADAD($requestParams);
```

# 3- Return URL Configuration
 You must add return URL route to `app/Http/Middleware/VerifyCsrfToken.php` to allow to it receive POST without token

# 4- Contact
for any question you can contact with me on twitter [@AhyadEssam](https://twitter.com/AhyadEssam), thanks
