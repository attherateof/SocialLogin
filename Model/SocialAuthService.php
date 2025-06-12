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

use MageStack\SocialLogin\Api\SocialAuthServiceInterface;
use MageStack\SocialLogin\Api\SocialAuthStateManagerInterface;
use MageStack\SocialLogin\Api\OAuthProviderInterface;
use MageStack\SocialLogin\Api\CustomerResolverInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use RuntimeException;

/**
 * Social auth service class for validating request and resolving customer
 *
 * @class SocialAuthService
 * @namespace MageStack\SocialLogin\Model
 */
class SocialAuthService implements SocialAuthServiceInterface
{
    /**
     * @param CustomerResolverInterface $socialAuth
     * @param SocialAuthStateManagerInterface $authState
     */
    public function __construct(
        private readonly CustomerResolverInterface $socialAuth,
        private readonly SocialAuthStateManagerInterface $authState
    ) {
    }

    /**
     * @inheritDoc
     */
    public function isValidRequest(string $code, string $state): bool
    {
        $storedState = $this->authState->getState();
        $this->authState->forgetState();

        return $code !== '' && $state !== '' && $state === $storedState;
    }

    /**
     * @inheritDoc
     */
    public function resolveCustomer(OAuthProviderInterface $provider, string $code): CustomerInterface
    {
        $token = $provider->getAccessToken($code);
        $userInfo = $provider->getUserInfo($token);
        if (empty($userInfo['email'])) {
            throw new RuntimeException('Failed to fetch user info or missing email.');
        }

        $customer = $this->socialAuth->getCustomer($userInfo['email']);

        if ($this->authState->isRegister()) {
            $customer = $this->socialAuth->createCustomer($userInfo);
        }

        /**
         * must be foreget by now, otherwise if auth fails
         * and customer switch from login to register or vice versa,
         * it may create some descripency. To avoid that foregt
         * the session store velue here
         */
        $this->authState->forgetIsRegister();

        return $customer;
    }
}
