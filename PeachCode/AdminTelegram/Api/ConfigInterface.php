<?php
declare(strict_types=1);

namespace PeachCode\AdminTelegram\Api;

interface ConfigInterface{

    public const XML_IS_ENABLE = 'telegram_admin_links/general/telegram_integration';

    public const XML_GET_TEMPLATE = 'telegram_admin_links/general/telegram_template';

    public const XML_TELEGRAM_API_TOKEN = 'telegram_admin_links/general/telegram_api_token';

    public const XML_TELEGRAM_CHAT_ID = 'telegram_admin_links/general/telegram_chat_id';

    /**
     * @return string
     */
    public function getTelegramApiToken(): string;

    /**
     * @return string
     */
    public function getTelegramChatId(): string;

    /**
     * @return string
     */
    public function getTelegramTemplateText(): string;

    /**
     * @return bool
     */
    public function isTelegramIntegrationEnabled(): bool;
}
