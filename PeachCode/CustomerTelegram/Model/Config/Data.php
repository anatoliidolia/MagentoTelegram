<?php
declare(strict_types=1);

namespace PeachCode\CustomerTelegram\Model\Config;

use Magento\Store\Model\ScopeInterface;
use PeachCode\CustomerTelegram\Api\ConfigInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Data implements ConfigInterface {

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private readonly ScopeConfigInterface $scopeConfig
    ){}

    /**
     * Get Telegram API Token
     *
     * @return string
     */
    public function getTelegramApiToken(): string
    {
        return $this->scopeConfig->getValue(ConfigInterface::XML_TELEGRAM_API_TOKEN, ScopeInterface::SCOPE_WEBSITE);
    }

    /**
     * Check module status
     *
     * @return bool
     */
    public function getTelegramModuleStatus(): bool
    {
        return $this->scopeConfig->isSetFlag(ConfigInterface::XML_IS_ENABLE, ScopeInterface::SCOPE_WEBSITE);
    }

    /**
     * Get Telegram Template
     *
     * @return string
     */
    public function getTelegramTemplate(): string
    {
        return $this->scopeConfig->getValue(ConfigInterface::XML_TELEGRAM_TEMPLATE, ScopeInterface::SCOPE_WEBSITE);
    }

    /**
     * Get Telegram Template
     *
     * @return string
     */
    public function getTelegramItemsTemplate(): string
    {
        return $this->scopeConfig->getValue(ConfigInterface::XML_TELEGRAM_ITEMS_TEMPLATE, ScopeInterface::SCOPE_WEBSITE);
    }
}
