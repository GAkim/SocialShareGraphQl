<?php

declare(strict_types=1);

namespace ScandiPWA\SocialShareGraphQl\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use ScandiPWA\SocialShareGraphQl\Helper\DataProvider;

/**
 * @package ScandiPWA\SocialShareGraphQl\Model\Resolver
 */
class SocialShare implements ResolverInterface
{
    /**
     * @var DataProvider
     */
    protected $dataProvider;

    /**
     * SocialShare constructor.
     * @param DataProvider $dataProvider
     */
    public function __construct(
        DataProvider $dataProvider
    ) {
        $this->dataProvider = $dataProvider;
    }
    /**
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return string[]
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $result = [
            'socialShareConfig' => $this->dataProvider->getSocialShareConfig(),
            'providers' => $this->dataProvider->getSocialShareProviders()
        ];

        return $result;
    }
}

