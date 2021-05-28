<?php
declare(strict_types=1);

namespace ScandiPWA\SocialShareGraphQl\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
/**
 * @package ScandiPWA\SocialShareGraphQl\Helper
 */
class DataProvider
{
    const SOCIALSHARE_CONFIG = 'socialshare/general/';

    const SOCIALSHARE = 'socialshare/';

    const ENABLE = 'enable';

    const ROUNDED = 'rounded';

    const SIZE = 'size';

    const HOME_PAGE = 'homepage';

    const CATEGORY_PAGE = 'categorypage';

    const PRODUCT_PAGE = 'productpage';

    const COUNTER = 'enable_counter';

    const SUFFIX = 'suffix';

    const APP_ID = 'app_id';

    const FB_MSG = 'facebook_messenger';

    const EMAIL = 'email';

    const PROVIDERS = [
        'facebook',
        'facebook_messenger',
        'telegram',
        'whatsapp',
        'linkedin',
        'email',
    ];

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * DataProvider constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return array
     */
    public function getSocialShareConfig() {

        return [
            'enabled' => $this->getConfig(self::SOCIALSHARE_CONFIG. self::ENABLE),
            'rounded' => $this->getConfig(self::SOCIALSHARE_CONFIG. self::ROUNDED),
            'size' => $this->getConfig(self::SOCIALSHARE_CONFIG. self::SIZE),
            'categoryPage' => $this->getConfig(self::SOCIALSHARE_CONFIG. self::CATEGORY_PAGE),
            'productPage' => $this->getConfig(self::SOCIALSHARE_CONFIG. self::PRODUCT_PAGE),
            'homePage' => $this->getConfig(self::SOCIALSHARE_CONFIG. self::HOME_PAGE)
        ];
    }

    /**
     * @return array
     */
    public function getSocialShareProviders() {
        $result = [];

        foreach (self::PROVIDERS as $provider) {
            $data = [];

            switch ($provider) {
                case self::FB_MSG:
                    $data = $this->getFacebookMessengerData();
                    break;
                case self::EMAIL:
                    $data = $this->getEmailData();
                    break;
                default:
                    $data = $this->getData($provider);
            }

            if($data) {
                array_push($result, $data);
            }
        }

        return $result;
    }

    /**
     * @return array|false
     */
    protected function getFacebookMessengerData() {
        $enabled = $this->getProviderConfig(self::FB_MSG, self::ENABLE);

        if($enabled) {
            return [
                'id' => self::FB_MSG,
                'additional' => $this->getProviderConfig(self::FB_MSG, self::APP_ID)
            ];
        }

        return false;
    }

    /**
     * @param $provider
     * @return array|false
     */
    protected function getData($provider) {
        $enabled = $this->getProviderConfig($provider, self::ENABLE);

        if($enabled) {
            return [
                'id' => $provider,
                'counter' => $this->getProviderConfig($provider, self::COUNTER)
            ];
        }

        return false;
    }

    /**
     * @return array|false
     */
    protected function getEmailData() {
        $enabled = $this->getProviderConfig(self::EMAIL, self::ENABLE);

        if($enabled) {
            return [
                'id' => self::EMAIL,
                'additional' => $this->getProviderConfig(self::EMAIL, self::SUFFIX)
            ];
        }

        return false;
    }

    /**
     * @param $path
     * @return mixed
     */
    protected function getConfig($path) {
         return $this->scopeConfig->getValue($path);
    }

    /**
     * @param $provider
     * @param $config
     * @return mixed
     */
    protected function getProviderConfig($provider, $config) {
        return $this->scopeConfig->getValue(self::SOCIALSHARE. $provider. '/'. $config);
    }
}
