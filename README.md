# Mail API Client (PHP)

A simple PHP class for sending emails (with optional attachments) through an API endpoint.  
Designed under the namespace `com\iceithq`.

---

## Installation

1. Make sure you have [Composer](https://getcomposer.org/) installed.
2. In your project, add this package to your `composer.json` autoload section:

```json
"autoload": {
  "psr-4": {
    "com\\iceithq\\": "src/"
  }
}

3. Run:

```bash
composer dump-autoload
```

4. Require Composer’s autoloader in your project:

```php
require __DIR__ . '/vendor/autoload.php';
```

## Usage

Basic Example

```php
<?php

use com\iceithq\Mail;

$mail = new Mail("https://api.example.com");

$response = $mail->to("recipient@example.com")
                 ->attach("/path/to/file1.pdf")
                 ->attach(["/path/to/file2.jpg", "/path/to/file3.png"]) // multiple attachments
                 ->send("Test Subject", "This is the body of the message.");

echo $response;
```

## API
```__construct($api_url = '')```

Create a new mail instance.
* ```$api_url``` – The base API endpoint (e.g. https://api.example.com).

```to($to)```

Set the recipient email address.
* ```$to``` – Recipient’s email (string).

```attach($filePath)```

Attach a file or multiple files to the email.
* ```$filePath``` – Either a string (single file path) or an array of file paths.

```send($subject, $body)```

Send the email request to the configured API.
* ```$subject``` – Email subject (string).
* ```$body``` – Email body (string).
* Returns – The raw API response.

## Notes
* By default, Authorization: Bearer is included in the request header.
* Replace $apiKey inside the class with your real API key or extend the class to pass it dynamically.
* Payload is sent as multipart/form-data so file uploads work correctly.
* Error handling is minimal right now. You may want to expand it for production use.

## License

MIT