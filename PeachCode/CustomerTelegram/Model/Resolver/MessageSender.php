<?php
declare(strict_types=1);

namespace PeachCode\CustomerTelegram\Model\Resolver;

use Exception;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Sales\Model\Order;
use PeachCode\CustomerTelegram\Api\ConfigInterface;
use PeachCode\CustomerTelegram\Api\Resolver\MessageSenderInterface;
use PeachCode\CustomerTelegram\Api\Resolver\PrepareMessageInterface;
use Psr\Log\LoggerInterface;

class MessageSender implements MessageSenderInterface{

    /**
     * @param PrepareMessageInterface $prepareMessage
     * @param ConfigInterface $config
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly PrepareMessageInterface $prepareMessage,
        private readonly ConfigInterface $config,
        private readonly LoggerInterface $logger
    ){}

    /**
     * Send message
     *
     * @param Order $order
     * @param CustomerInterface $customer
     * @return void
     */
    public function send(Order $order, CustomerInterface $customer): void{

        $customerChatCheck = $customer->getCustomAttribute(ConfigInterface::XML_TELEGRAM_CHAT_ID);

        $chatValue = $customerChatCheck ? $customerChatCheck->getValue() : 0;

        $customerName = $customer->getFirstname();

        $items = $order->getAllVisibleItems();

        $apiToken = $this->config->getTelegramApiToken();

        $data = $this->prepareMessage->resolve($items, $chatValue, $order, $customerName);

        try {
            file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
        } catch (Exception $e) {
            $this->logger->critical("Telegram connection is wrong. " . $e->getMessage());
        }
    }
}
