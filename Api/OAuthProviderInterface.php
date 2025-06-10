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

/**
 * Interface for OAuth Provider
 *
 * @interface OAuthProviderInterface
 * @namespace MageStack\SocialLogin\Api
 *
 * @api
 */
interface OAuthProviderInterface
{
    /**
     * Get authorization url
     *
     * @return string
     */
    public function getAuthorizationUrl(): string;

    /**
     * Get callback url
     *
     * @return string
     */
    public function getCallbackUrl(): string;

    /**
     * Get scope
     *
     * @return string
     */
    public function getScope(): string;

    /**
     * Get login redirect url
     *
     * @return string
     */
    public function getLoginRedirectUrl(): string;

    /**
     * Get register redirect url
     *
     * @return string
     */
    public function getRegisterRedirectUrl(): string;

    /**
     * Get access token
     *
     * @param string $code
     *
     * @return null|string
     */
    public function getAccessToken(string $code): ?string;

    /**
     * Get user information
     *
     * @param string $accessToken
     * @return string[]
     */
    public function getUserInfo(string $accessToken): array;
}
