<?php
declare(strict_types=1);

namespace PeachCode\CustomerTelegram\Api\Resolver;

use Magento\Sales\Model\Order;

interface PrepareMessageInterface{

    /**
     * @param array $items
     * @param string $chatValue
     * @param Order $order
     * @param string $customerName
     * @return array
     */
    public function resolve(array $items, string $chatValue, Order $order, string $customerName): array;
}
