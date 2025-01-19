<?php

namespace PeachCode\CustomerTelegram\Api;

interface ConfigInterface {

    public const XML_IS_ENABLE = 'telegram_customer_links/general/telegram_integration';

    public const XML_TELEGRAM_API_TOKEN = 'telegram_customer_links/general/telegram_api_token';

    public const XML_TELEGRAM_TEMPLATE = 'telegram_customer_links/general/telegram_template';

    public const XML_TELEGRAM_ITEMS_TEMPLATE = 'telegram_customer_links/general/telegram_items_template';

    public const XML_TELEGRAM_CHAT_ID = 'telegram_chat_id';

    /**
     * @return string
     */
    public function getTelegramApiToken(): string;

    /**
     * @return string
     */
    public function getTelegramTemplate(): string;

    /**
     * @return string
     */
    public function getTelegramItemsTemplate(): string;

    /**
     * @return bool
     */
    public function getTelegramModuleStatus(): bool;
}
