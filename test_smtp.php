<?php
require_once __DIR__ . '/app/Core/Env.php';
\App\Core\Env::load(__DIR__ . '/.env');
require_once __DIR__ . '/app/Services/MailService.php';

echo "Sending...\n";
$res = \App\Services\MailService::send('test@example.com', 'Test Subject', 'Test Message');
var_dump($res);
echo "Done.\n";
