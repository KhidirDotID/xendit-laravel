<?php

namespace KhidirDotID\Xendit;

use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\Invoice;
use Xendit\Invoice\InvoiceApi;

class Xendit
{
    public function __construct()
    {
        self::registerXenditConfig();
    }

    public static function registerXenditConfig()
    {
        // Set your Xendit API Key
        Configuration::setXenditKey(config('xendit.api_key'));
    }

    /**
     * Set your Xendit API Key
     *
     * @static
     */
    public static function setXenditKey($apiKey)
    {
        Configuration::setXenditKey($apiKey);
    }

    /**
     * Create payment page, with this version returning full API response
     *
     * Example:
     *
     * ```php
     *   $data = [
     *       'external_id' => 'invoice-' . time(),
     *       'amount' => 10000,
     *   ];
     *   $paymentUrl = \Xendit::createInvoice($data);
     * ```
     *
     * @param  array $data Payment options
     * @throws \Exception curl error or xendit error
     */
    public static function createInvoice($data): Invoice
    {
        $createInvoiceRequest = new CreateInvoiceRequest($data);

        return (new InvoiceApi())->createInvoice($createInvoiceRequest);
    }

    /**
     * Get invoice by invoice id
     *
     * @param  string $invoiceId Invoice ID
     * @throws \Exception
     */
    public static function getInvoiceById($invoiceId): Invoice
    {
        return (new InvoiceApi())->getInvoiceById($invoiceId);
    }
}
