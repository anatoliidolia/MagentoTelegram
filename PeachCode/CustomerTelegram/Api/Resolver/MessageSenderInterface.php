<?php

namespace PeachCode\CustomerTelegram\Api\Resolver;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Sales\Model\Order;

interface MessageSenderInterface{

    /**
     * @param Order $order
     * @param CustomerInterface $customer
     * @return void
     */
    public function send(Order $order,CustomerInterface $customer): void;
}
