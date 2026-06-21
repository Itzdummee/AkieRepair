<?php

return [
    /*
    |--------------------------------------------------------------------------
    | ToyyibPay Configuration
    |--------------------------------------------------------------------------
    */
    
    // API URI (Sandbox: https://dev.toyyibpay.com, Production: https://toyyibpay.com)
    'uri' => env('TOYYIBPAY_URI', 'https://dev.toyyibpay.com'),
    
    // Payment page URL
    'payment_url' => env('TOYYIBPAY_PAYMENT_URL', 'https://dev.toyyibpay.com'),
    
    // Your secret key from ToyyibPay
    'user_secret_key' => env('TOYYIBPAY_USER_SECRET_KEY'),
    
    // Your category code
    'category_code' => env('TOYYIBPAY_CATEGORY_CODE'),
    
    // Redirect URL after payment (optional, can be overridden per bill)
    'redirect_url' => env('TOYYIBPAY_REDIRECT_URL'),
];