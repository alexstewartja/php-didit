# PHP Didit

[![Latest Stable Version](http://poser.pugx.org/alexstewartja/php-didit/v)](https://packagist.org/packages/alexstewartja/php-didit)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/alexstewartja/php-didit/run-tests.yml)
[![Total Downloads](http://poser.pugx.org/alexstewartja/php-didit/downloads)](https://packagist.org/packages/alexstewartja/php-didit)
[![License](http://poser.pugx.org/alexstewartja/php-didit/license)](https://packagist.org/packages/alexstewartja/php-didit)
[![PHP Version Require](http://poser.pugx.org/alexstewartja/php-didit/require/php)](https://packagist.org/packages/alexstewartja/php-didit)
[![Buy Me A Coffee](https://img.shields.io/badge/Buy_Me-A_Coffee-orange)](https://buymeacoffee.com/alexstewartja)

PHP SDK for [Didit](https://didit.me/business)'s identity verification (KYC) and authentication (CIAM) solutions

## Features

- :white_check_mark: [Verification](https://docs.didit.me/identity-verification/full-flow)
- :hourglass_flowing_sand: [Auth](https://docs.didit.me/auth-and-data/sign-in-api-reference/full-flow)
- :hourglass_flowing_sand: [Data](https://docs.didit.me/auth-and-data/data-api-reference/full-flow)

## Installation

You can install the package via composer:

```bash
composer require alexstewartja/php-didit
```

## Usage

### Get Access Token

Supply
the [Client ID and Client Secret](https://docs.didit.me/identity-verification/quick-start#configure-verification-settings)
of your application, from the Didit console:

```php
// Replace these example credentials with your own...
$client_id = 'AcL8JK38FqNPmx20qrd3-b';
$client_secret = 'QuajPJsV0sKiQ3M33fd4RK2rVofEmHXLolKW_ZeyeNL';

$token_info = Didit::getAccessToken($client_id, $client_secret);
$access_token = $token_info->getAccessToken();
// Store your access token securely...
```

### Create a Verification Session

After obtaining a valid client access token, you can then create a new verification session:

```php
$access_token = 'eyJhbGciOiAiUlMyNTYiLCAidHlwIjogIkpXVCJ9...'; // Retrieved from secure storage
$vendor_data = 'c4afad98-e044-4a5f-b68f-5ffaaaefe6a0'; // Commonly, a unique id/uuid of the user in your application
$callback = 'https://verify.didit.me/'; // URL to redirect your user after they complete verification
$features = VerificationFeatures::OCR_FACE; // Optional verification features to enable

$session = Didit::createVerificationSession($access_token, $vendor_data, $callback);
$session_id = $session->getSessionId();
// Store your session ID for future reference, commonly as part of your user record...
$session_url = $session->getSessionUrl();
// Redirect your user to the verification URL...
```

### Retrieve a Verification Session

Retrieve the results of a verification session by supplying its `session_id`:

```php
$access_token = 'eyJhbGciOiAiUlMyNTYiLCAidHlwIjogIkpXVCJ9...'; // Retrieved from secure storage
$session_id = 'e8933296-fa3b-4a7a-9c99-b132d34b19fc'; // Retrieved from user record

$session = Didit::getVerificationSession($access_token, $session_id);
```

### Update a Verification Session Status

You may approve or decline a verification, by updating its status to `Approved` or `Declined` respectively:

```php
$access_token = 'eyJhbGciOiAiUlMyNTYiLCAidHlwIjogIkpXVCJ9...'; // Retrieved from secure storage
$session_id = 'e8933296-fa3b-4a7a-9c99-b132d34b19fc'; // Retrieved from user record
$new_status = VerificationStatus::DECLINED;
$comment = 'User is from a country that is no longer supported'; // Optional comment/reason for review

$declined = Didit::updateVerificationSessionStatus($access_token, $session_id, $new_status, $comment);
if ($declined) {
    // Status update was successful...
}
```

### Generate a Verification PDF Report

You can generate a PDF for sessions that are either `In Review`, `Declined` or `Approved`:

```php
$access_token = 'eyJhbGciOiAiUlMyNTYiLCAidHlwIjogIkpXVCJ9...'; // Retrieved from secure storage
$session_id = 'e8933296-fa3b-4a7a-9c99-b132d34b19fc'; // Retrieved from user record
$save_to = './session_pdf_downloads/session.pdf'; // Optional file path to store generated PDF

$generated = Didit::generateVerificationSessionPdf($access_token, $session_id, $save_to);
if ($generated) {
    // PDF generated and stored successfully...
}
```

> :information_source: If no `$save_to` path is supplied, an instance of `Psr\Http\Message\StreamInterface`
> will be returned, allowing for further processing.

## Testing

1. Navigate to the `tests/assets` directory and copy `credentials.json.example` to `credentials.json`:
    ```bash
    cp tests/assets/credentials.json.example tests/assets/credentials.json
    ```
2. Open `tests/assets/credentials.json`. Enter
   your [Client ID and Client Secret](https://docs.didit.me/identity-verification/quick-start#configure-verification-settings)
   into the `client_id` and
   `client_secret` fields, respectively.

3. Run the test suite:
    ```bash
    composer test
    ```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

A [Lando](https://lando.dev/) file is included in the repo to get up and running quickly:

```bash
lando start
```

Please see [CONTRIBUTING](CONTRIBUTING.md) for more details.

## Security

If you discover any security related issues, please
email [didit@alexstewartja.com](mailto:didit@alexstewartja.com?Subject=PHP%20Didit) instead of
using the issue tracker.

## Credits

- [Alex Stewart](https://github.com/alexstewartja)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
