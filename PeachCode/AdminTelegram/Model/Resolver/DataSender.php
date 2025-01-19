<?php
declare(strict_types=1);

namespace PeachCode\AdminTelegram\Model\Resolver;

use Exception;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Model\QuoteRepository;
use Magento\Sales\Model\Order;
use PeachCode\AdminTelegram\Api\ConfigInterface;
use PeachCode\AdminTelegram\Api\Resolver\DataSenderInterface;
use PeachCode\AdminTelegram\Api\Resolver\PrepareMessageInterface;
use Psr\Log\LoggerInterface;

class DataSender implements DataSenderInterface{

    /**
     * @param PrepareMessageInterface $prepareMessage
     * @param ConfigInterface $config
     * @param QuoteRepository $quoteRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        private readonly PrepareMessageInterface $prepareMessage,
        private readonly ConfigInterface $config,
        private readonly QuoteRepository $quoteRepository,
        private readonly LoggerInterface $logger
    ) {}

    /**
     * Prepare data before sending
     *
     * @param Order $order
     * @return string|bool
     * @throws NoSuchEntityException
     */
    public function resolve(Order $order): string|bool
    {
        $quote = $this->quoteRepository->get($order->getQuoteId());

        $allItems = $quote->getAllVisibleItems();

        $apiToken = $this->config->getTelegramApiToken();
        $chatId = $this->config->getTelegramChatId();

        $data = $this->prepareMessage->resolve(
            $allItems,
            $quote->getCustomerFirstname(),
            $quote->getBaseSubtotal(), $chatId
        );

        try {
            return file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
        } catch (Exception $e) {
            $this->logger->critical("Telegram connection is wrong. " . $e->getMessage());
        }

        return false;
    }
}
