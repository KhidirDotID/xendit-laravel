<?php

namespace KhidirDotID\Xendit\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void setXenditKey(string $apiKey)
 * @method static \Xendit\Invoice\Invoice createInvoice(array $data)
 * @method static \Xendit\Invoice\Invoice getInvoiceById(string $invoiceId)
 */
class Xendit extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'xendit';
    }
}
