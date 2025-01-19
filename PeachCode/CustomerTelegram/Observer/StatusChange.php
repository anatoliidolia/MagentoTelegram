<?php
declare(strict_types=1);

namespace PeachCode\CustomerTelegram\Observer;

use Exception;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Sales\Model\Order;
use PeachCode\CustomerTelegram\Api\Resolver\MessageSenderInterface;
use PeachCode\CustomerTelegram\Api\ConfigInterface;

/**
 * Observer to send order status to customer
 */
class StatusChange implements ObserverInterface
{

    /**
     * @param MessageSenderInterface $messageSender
     * @param ConfigInterface $config
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        private readonly MessageSenderInterface      $messageSender,
        private readonly ConfigInterface             $config,
        private readonly CustomerRepositoryInterface $customerRepository
    ){}

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer): void
    {
        $order = $observer->getEvent()->getOrder();
        if ($this->config->getTelegramModuleStatus() && $order instanceof Order) {
            try {
                $customer = $this->customerRepository->getById($order->getCustomerId());
                $this->messageSender->send($order, $customer);
            } catch (Exception $e) {
                return;
            }
        }
    }
}
