<?php
declare(strict_types=1);

namespace PeachCode\CustomerTelegram\Model\Resolver;

use Magento\Sales\Model\Order;
use PeachCode\CustomerTelegram\Api\ConfigInterface;
use PeachCode\CustomerTelegram\Api\Resolver\PrepareMessageInterface;

class PrepareMessage implements PrepareMessageInterface {

    /**
     * @param ConfigInterface $config
     */
    public function __construct(
        private readonly ConfigInterface $config
    ){}

    /**
     * @param array $items
     * @param string $chatValue
     * @param Order $order
     * @param string $customerName
     * @return array
     */
    public function resolve(array $items, string $chatValue, Order $order, string $customerName): array
    {
        $itemsData = '';

        $textTemplate = $this->config->getTelegramTemplate();
        $itemsTextTemplate = $this->config->getTelegramItemsTemplate();

        foreach ($items as $item) {
            if ($item->getData()) {
                $itemText = str_replace(
                    ['{name}','{price}'],
                    [
                        $item->getName(),
                        $item->getPrice()
                    ],
                    $itemsTextTemplate
                );
                $itemsData .= $itemText . "\n";
            }
        }

        $messageText = str_replace(
            ['{customer_name}','{incrementId}','{status}'],
            [
                $customerName,
                $order->getIncrementId(),
                $order->getStatus()
            ],
            $textTemplate
        );

        return [
            'chat_id' => $chatValue,
            'text'    => $messageText.$itemsData
        ];
    }
}
