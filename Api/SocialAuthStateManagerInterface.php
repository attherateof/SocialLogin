<?php

/**
 * Copyright © 2025 MageStack. All rights reserved.
 * See COPYING.txt for license details.
 *
 * DISCLAIMER
 * Do not make any kind of changes to this file if you
 * wish to upgrade this extension to newer versions in the future.
 *
 * @category  MageStack
 * @package   MageStack_SocialLogin
 * @author    Amit Biswas <amit.biswas.webdeveloper@gmail.com>
 * @copyright 2025 MageStack
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/attherateof/SocialLogin
 */

declare(strict_types=1);

namespace MageStack\SocialLogin\Api;

/**
 * Interface for managing social auth state across requests.
 *
 * @class SocialAuthStateManagerInterface
 * @namespace MageStack\SocialLogin\Api
 *
 * @api
 */
interface SocialAuthStateManagerInterface
{
    // -----------------------------------------
    // Identifier
    // -----------------------------------------

    /**
     * Set a unique identifier for the auth state (e.g., provider name).
     *
     * @param string $identifier
     * @return self
     */
    public function setIdentifier(string $identifier): self;

    /**
     * Get the previously set identifier.
     *
     * @throws \LogicException If identifier is not set.
     * @return string
     */
    public function getIdentifier(): string;

    // -----------------------------------------
    // State Token
    // -----------------------------------------

    /**
     * Generate and set a new state token.
     *
     * @return self
     */
    public function setState(): self;

    /**
     * Retrieve the stored state token.
     *
     * @throws \LogicException If state is not set.
     * @return string
     */
    public function getState(): string;

    /**
     * Clear the stored state token.
     *
     * @return void
     */
    public function forgetState(): void;

    // -----------------------------------------
    // Registration Request Flag
    // -----------------------------------------

    /**
     * Mark the request as a registration attempt.
     *
     * @return self
     */
    public function setAsRegisterRequest(): self;

    /**
     * Check if the request was marked for registration.
     *
     * @return bool
     */
    public function isRegister(): bool;

    /**
     * Clear the registration request flag.
     *
     * @return void
     */
    public function forgetIsRegister(): void;

    // -----------------------------------------
    // Checkout Context Flag
    // -----------------------------------------

    /**
     * Mark the request as originating from the checkout page.
     *
     * @return self
     */
    public function setAsCheckoutRequest(): self;

    /**
     * Check if the request was initiated during checkout.
     *
     * @return bool
     */
    public function isAtCheckout(): bool;

    /**
     * Clear the checkout context flag.
     *
     * @return void
     */
    public function forgetIsAtCheckout(): void;
}
