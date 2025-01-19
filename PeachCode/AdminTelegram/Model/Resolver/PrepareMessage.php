<?php
declare(strict_types=1);

namespace PeachCode\AdminTelegram\Model\Resolver;

use PeachCode\AdminTelegram\Api\ConfigInterface;
use PeachCode\AdminTelegram\Api\Resolver\PrepareMessageInterface;

class PrepareMessage implements PrepareMessageInterface{

    /**
     * @param ConfigInterface $config
     */
    public function __construct(
        private readonly ConfigInterface $config,
    ){}

    /**
     * @param $items
     * @param $customerName
     * @param $finalPrice
     * @param $chatId
     * @return array
     */
    public function resolve($items, $customerName, $finalPrice, $chatId): array
    {
        $itemsData = '';

        $textTemplate = $this->config->getTelegramTemplateText();

        foreach ($items as $item) {
            if ($item->getData()) {
                $itemText = str_replace(
                    ['{name}','{quantity}','{price}'],
                    [
                        $item->getName(),
                        $item->getQty() ?? 1,
                        $item->getPrice()
                    ],
                    $textTemplate
                );
                $itemsData .= $itemText . "\n";
            }
        }

        $messageText = str_replace(
            ['{customer_name}','{final_price}'],
            [
                $customerName,
                $finalPrice
            ],
            $itemsData
        );

        return [
            'chat_id' => $chatId,
            'text'    => $messageText
        ];
    }
}
