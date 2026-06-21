<?php

require __DIR__ . '/vendor/autoload.php';

$app = require __DIR__ . '/bootstrap/app.php';

$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Http;

$response = Http::withHeaders([
    'api-key' => getenv('BREVO_API_KEY'),
])->post('https://api.brevo.com/v3/smtp/email', [
    'sender' => [
        'name' => 'AkieRepair',
        'email' => 'zamriyahya03@gmail.com'
    ],
    'to' => [
        ['email' => 'your_test_email@gmail.com']
    ],
    'subject' => 'Test Email',
    'htmlContent' => '<h1>Email Works 🚀</h1>'
]);

print_r($response->json());
