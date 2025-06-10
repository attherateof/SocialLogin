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

namespace MageStack\SocialLogin\Api;

use Magento\Customer\Api\Data\CustomerInterface;

/**
 * Interface for Social Authentication Service
 *
 * @interface SocialAuthServiceInterface
 * @namespace MageStack\SocialLogin\Api
 *
 * @api
 */
interface SocialAuthServiceInterface
{
    /**
     * Validate request
     *
     * @param string $code
     * @param string $state
     *
     * @return bool
     */
    public function isValidRequest(string $code, string $state): bool;

    /**
     * Summary of resolveCustomer
     *
     * @param OAuthProviderInterface $provider
     * @param string $code
     *
     * @throws \RuntimeException
     *
     * @return CustomerInterface|null
     */
    public function resolveCustomer(OAuthProviderInterface $provider, string $code): ?CustomerInterface;
}
