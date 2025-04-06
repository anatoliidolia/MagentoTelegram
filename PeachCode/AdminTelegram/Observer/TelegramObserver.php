<?php
declare(strict_types=1);

namespace PeachCode\AdminTelegram\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Sales\Model\Order;
use PeachCode\AdminTelegram\Api\ConfigInterface;
use PeachCode\AdminTelegram\Api\Resolver\DataSenderInterface;

/**
 * Event for send data to Telegram Bot
 */
class TelegramObserver implements ObserverInterface
{
    /**
     * @param ConfigInterface $config
     * @param DataSenderInterface $dataSender
     */
    public function __construct(
        private readonly ConfigInterface $config,
        private readonly DataSenderInterface $dataSender
    ) {}

    /**
     * Execute for send message to the bot
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer): void
    {
        $order = $observer->getData('order');

        if ($this->config->isTelegramIntegrationEnabled() && $order instanceof Order) {
            $this->dataSender->resolve($order);
        }
    }
}
