<?php
declare(strict_types=1);

namespace PeachCode\AdminTelegram\Model\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;
use PeachCode\AdminTelegram\Api\ConfigInterface;

class Data implements ConfigInterface {

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ){}

    /**
     * Get API Token
     *
     * @return string
     */
    public function getTelegramApiToken(): string
    {
        return $this->scopeConfig->getValue(ConfigInterface::XML_TELEGRAM_API_TOKEN, ScopeInterface::SCOPE_WEBSITE);
    }

    /**
     * Get chat ID
     *
     * @return string
     */
    public function getTelegramChatId(): string
    {
        return $this->scopeConfig->getValue(ConfigInterface::XML_TELEGRAM_CHAT_ID, ScopeInterface::SCOPE_WEBSITE);
    }

    /**
     * Check is module enabled
     *
     * @return bool
     */
    public function isTelegramIntegrationEnabled(): bool
    {
       return $this->scopeConfig->isSetFlag(ConfigInterface::XML_IS_ENABLE, ScopeInterface::SCOPE_WEBSITE);
    }

    /**
     * Check is module enabled
     *
     * @return string
     */
    public function getTelegramTemplateText(): string
    {
        return $this->scopeConfig->getValue(ConfigInterface::XML_GET_TEMPLATE, ScopeInterface::SCOPE_WEBSITE);
    }
}
