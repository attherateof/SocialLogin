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
 * Interface for manageing state
 *
 * @interface SocialAuthStateManagerInterface
 * @namespace MageStack\SocialLogin\Api
 *
 * @api
 */
interface SocialAuthStateManagerInterface
{
    /**
     * Set Identifier
     *
     * @param string $identifier
     * @return SocialAuthStateManagerInterface
     */
    public function setIdentifier(string $identifier): SocialAuthStateManagerInterface;

    /**
     * Get Identifier
     *
     * @throws \LogicException
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * Set state
     *
     * @return SocialAuthStateManagerInterface
     */
    public function setState(): SocialAuthStateManagerInterface;

    /**
     * Get State
     *
     * @throws \LogicException
     * @return string
     */
    public function getState(): string;

    /**
     * Delete state
     *
     * @return void
     */
    public function forgetState(): void;

    /**
     * Set is request for registration
     *
     * @param bool $isRegister
     * @return SocialAuthStateManagerInterface
     */
    public function setIsRegister(bool $isRegister): SocialAuthStateManagerInterface;

    /**
     * Check is request for register
     *
     * @return bool
     */
    public function isRegister(): bool;

    /**
     * Delete data for is register
     *
     * @return void
     */
    public function forgetIsRegister(): void;
}
