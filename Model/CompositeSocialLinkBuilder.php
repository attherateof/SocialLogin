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

namespace MageStack\SocialLogin\Model;

use MageStack\SocialLogin\Api\OAuthProviderInterface;
use MageStack\SocialLogin\Api\ConfigInterface;


/**
 * Provides all available social auth link 
 *
 * @class CompositeSocialLinkBuilder
 * @namespace MageStack\SocialLogin\Model
 */
class CompositeSocialLinkBuilder
{
    private bool $isForCheckout = false;
    private bool $isForLogin = false;
    private bool $isForRegister = false;

    /**
     * @param array<string, array{oAuthProvider: OAuthProviderInterface, config: ConfigInterface}> $socialProviders
     */
    public function __construct(
        private readonly array $socialProviders = []
    ) {
    }

    public function setIsForCheckout(bool $value): self
    {
        $this->isForCheckout = $value;
        return $this;
    }

    public function setIsForLogin(bool $value): self
    {
        $this->isForLogin = $value;
        return $this;
    }

    public function setIsForRegister(bool $value): self
    {
        $this->isForRegister = $value;
        return $this;
    }

    public function getAuthProviders(): array
    {
        $result = [];

        foreach ($this->socialProviders as $providerType => $config) {
            if (
                !isset($config['oAuthProvider'], $config['config']) ||
                !$config['oAuthProvider'] instanceof OAuthProviderInterface ||
                !$config['config'] instanceof ConfigInterface
            ) {
                continue;
            }

            /** @var OAuthProviderInterface $provider */
            $provider = $config['oAuthProvider'];
            $result[$providerType]['is_enabled'] = $config['config']->isEnabled();

            if ($this->isForLogin) {
                $result[$providerType]['url']['login'] = $this->isForCheckout
                    ? $provider->getCheckoutLoginRedirectUrl()
                    : $provider->getLoginRedirectUrl();
            }

            if ($this->isForRegister) {
                $result[$providerType]['url']['register'] = $this->isForCheckout
                    ? $provider->getCheckoutRegisterRedirectUrl()
                    : $provider->getRegisterRedirectUrl();
            }
        }

        return $result;
    }
}
