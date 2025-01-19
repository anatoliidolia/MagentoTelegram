<?php
declare(strict_types=1);

namespace PeachCode\AdminTelegram\Api\Resolver;

use Magento\Sales\Model\Order;

interface DataSenderInterface{

    /**
     * @param Order $order
     * @return string|bool
     */
    public function resolve(Order $order ): string|bool;
}
