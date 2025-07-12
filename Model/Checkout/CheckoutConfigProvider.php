<?php

/**
 * Copyright © 2025 MageStack. All rights reserved.
 * See COPYING.txt for license details.
 *
 * DISCLAIMER
 *
 * Do not make any kind of changes to this file if you
 * wish to upgrade this extension to newer version in the future.
 *
 * @category  MageStack
 * @package   MageStack_SocialLogin
 * @author    Amit Biswas <amit.biswas.webdeveloper@gmail.com>
 * @copyright 2025 MageStack
 * @license   https://opensource.org/licenses/MIT  MIT License
 * @link      https://github.com/attherateof/SocialLogin
 */

declare(strict_types=1);

namespace MageStack\SocialLogin\Model\Checkout;

use Magento\Checkout\Model\ConfigProviderInterface;
use MageStack\SocialLogin\Model\CompositeSocialLinkBuilder;

/**
 * Expose social auth information to checkout config
 *
 * @class CheckoutConfigProvider
 * @namespace MageStack\SocialLogin\Model\Checkout
 */
class CheckoutConfigProvider implements ConfigProviderInterface
{
    /**
     * Constructor
     * 
     * @param array<string,<string,OAuthProviderInterface|ConfigInterface>> $socialProviders
     */
    public function __construct(
        private readonly CompositeSocialLinkBuilder $compositeSocialLinkBuilder
    ) {
    }

    /**
     * @inheritdoc
     *
     * @phpstan-ignore-next-line
     */
    public function getConfig(): array
    {
        return [
            'social' => $this->compositeSocialLinkBuilder->setIsForCheckout(true)
                ->setIsForLogin(true)
                ->setIsForRegister(true)
                ->getAuthProviders()
        ];
    }
}
