# xendit-laravel
A Xendit Wrapper for Laravel

## Installation

1. Install the package
    ```bash
    composer require khidirdotid/xendit-laravel
    ```
2. Publish the config file
    ```bash
    php artisan vendor:publish --provider="KhidirDotID\Xendit\Providers\XenditServiceProvider"
    ```
3. Add the Facade to your `config/app.php` into `aliases` section
    ```php
    'Xendit' => KhidirDotID\Xendit\Facades\Xendit::class,
    ```
4. Add ENV data
    ```env
    XENDIT_API_KEY=
    ```

    or you can set it through the controller
    ```php
    \Xendit::setXenditKey('XENDIT_API_KEY');
    ```

## Usage

### Invoice

1. Get Redirection URL of a Payment Page
    ```php
    $data = [
        'external_id' => 'invoice-' . time(),
        'amount' => 10000
    ];

    try {
        // Get Payment Page URL
        $paymentUrl = \Xendit::createInvoice($data);

        // Redirect to Payment Page
        return redirect()->away($paymentUrl['invoice_url']);
    } catch (\Throwable $th) {
        throw $th;
    }
    ```

### Handle HTTP Notification

1. Create route to handle notifications
    ```php
    Route::match(['GET', 'POST'], 'xendit.ipn', [PaymentController::class, 'xenditIpn'])->name('xendit.ipn');
    ```
2. Create method in controller
    ```php
    public function xenditIpn(Request $request)
    {
        try {
            $response = \Xendit::getInvoiceById($request->invoice_id);

            if (in_array(strtolower($response['status']), ['paid', 'settled'])) {
                // TODO: Set payment status in merchant's database to 'success'
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    ```
3. Except verify CSRF token in `app/Http/Middleware/VerifyCsrfToken.php`
    ```php
    protected $except = [
        'xendit/ipn'
    ];
    ```
