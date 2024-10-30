<?php
$scriptName   = dirname($_SERVER['SCRIPT_NAME']);
$requestUri   = str_replace($scriptName, '/', $_SERVER['REQUEST_URI']);
$requestUri   = strtok($requestUri, '?');

$adminRoutes = [];

$clientRoutes = [];

$commonRoute = [
    '/'               => route('common', '/received-faxes'),
    '/received-faxes' => route('common', '/received-faxes'),
    '/received-faxes-viewer' => route('common', '/received-faxes-viewer'),
    '/sent-faxes' => route('common', '/sent-faxes'),
    '/sent-faxes-viewer' => route('common', '/sent-faxes-viewer'),
    '/uploads'         => route('common', '/uploads'),
    '/edit'         => route('common', '/edit'),
    '/edit-sent'         => route('common', '/edit-sent'),
    '/upload_bulk'  => route('common', '/upload_bulk'),
];

if (array_key_exists($requestUri, $adminRoutes)) {
    require_once $adminRoutes[$requestUri];
} else if (array_key_exists($requestUri, $clientRoutes)) {
    require_once $clientRoutes[$requestUri];
} else if (array_key_exists($requestUri, $commonRoute)) {
    require_once $commonRoute[$requestUri];
} else {
    http_response_code(404);
    echo '<h2 style="text-align: center; margin-top: 30px;">404 Page Not Found</h2>';
}

function route($option, $param)
{
    return 'pages' . DS . $option . $param . '.php';
}
