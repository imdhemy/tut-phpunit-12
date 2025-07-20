<?php

declare(strict_types=1);

namespace Tests\Tax;

use Imdhemy\Acme\Tax\CreateInvoicePayload;
use Imdhemy\Acme\Tax\RequestFactory;
use Imdhemy\Acme\Tax\ValueObject\Credential;
use Imdhemy\Acme\Tax\ValueObject\Invoice;
use Imdhemy\Acme\Tax\ValueObject\InvoiceHeader;
use Imdhemy\Acme\Tax\ValueObject\InvoiceLineItem;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use function json_encode;

final class RequestFactoryTest extends TestCase
{
    #[Test]
    public function create_invoice_request(): void
    {
        $credential = new Credential(username: 'username', password: 'password', taxNumber: '300000000000003');
        $invoiceHeader = new InvoiceHeader(transactionDate: '2025-05-23', poNumber: 20250523001, totalTax: 190);
        $invoiceLineItem = new InvoiceLineItem(
            serviceMain: 101,
            serviceTypeCode: '122321',
            productName: 'testitem',
            quantity: 2,
            serviceValue: 500,
            vatAmount: 25.123,
            vatPercent: 15,
            discount: 0
        );
        $invoice = new Invoice($invoiceHeader, [$invoiceLineItem]);
        $payload = new CreateInvoicePayload($credential, $invoice);
        $sut = new RequestFactory();

        $actual = $sut->createInvoiceRequest($payload);

        $this->assertSame('POST', $actual->getMethod());
        $this->assertSame(
            'https://portal.smart-code.app/sc/workspace/finance/invoices?taxNumber=300000000000003&username=username',
            (string)$actual->getUri(),
        );
        $this->assertContains('application/json', $actual->getHeaders()['Content-Type']);
        $this->assertSame(json_encode([
            'invoice_mast' => [
                'TRNS_DATE' => '2025-05-23',
                'PO_NUMBER' => 20250523001,
                'TOTAL_TAX' => 190.0,
            ],
            'invoice_det' => [
                [
                    'SERVICE_MAIN' => 101,
                    'SERVICE_TYPE_CODE' => '122321',
                    'PRODUCT_NAME' => 'testitem',
                    'QTY' => 2,
                    'SERVICE_VALUE' => 500,
                    'VAT_AMOUNT' => 25.123,
                    'VAT_PERCENT' => 15,
                    'DISC' => 0,
                ],
            ],
        ], JSON_THROW_ON_ERROR), (string)$actual->getBody());
    }
}
