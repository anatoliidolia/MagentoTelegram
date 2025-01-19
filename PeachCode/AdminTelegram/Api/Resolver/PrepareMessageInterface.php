<?php
declare(strict_types=1);

namespace PeachCode\AdminTelegram\Api\Resolver;

use Magento\Quote\Model\Quote\Item;

interface PrepareMessageInterface{

    /**
     * @param Item $items []
     * @param string $customerName
     * @param float $finalPrice
     * @param string $chatId
     * @return array
     */
    public function resolve(Item $items, string $customerName, float $finalPrice, string $chatId): array;
}
