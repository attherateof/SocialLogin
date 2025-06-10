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

use MageStack\SocialLogin\Api\SocialAuthStateManagerInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Framework\App\CacheInterface;
use LogicException;

/**
 * Manage state for social auth
 * to ensure authenticity of the resonse
 *
 * @class SocialAuthStateManager
 * @namespace MageStack\SocialLogin\Model
 */
class SocialAuthStateManager implements SocialAuthStateManagerInterface
{
    /**
     * Cache prefixes
     */
    private const STATE_CACHE_PREFIX = 'social_oauth_state_';
    private const IS_REGISTER_CACHE_PREFIX = 'social_oauth_is_register_';

    /**
     * Cache TTL
     */
    private const CACHE_TTL = 600; // 10 minutes

    /**
     * Unique identifier
     *
     * @var string|null
     */
    private ?string $identifier = null;

    /**
     * @param CacheInterface $cache
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        private readonly CacheInterface $cache,
        private readonly EncryptorInterface $encryptor
    ) {
    }

    /**
     * @inheritDoc
     */
    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier(): string
    {
        if ($this->identifier === null) {
            throw new LogicException('Identifier is not set. Call setIdentifier() first.');
        }

        return (string) $this->identifier;
    }

    /**
     * @inheritDoc
     */
    public function setState(): self
    {
        $identifier = $this->getIdentifier();
        $random = rand(100, 1000);
        $now = time();
        $state = $this->encryptor->getHash(
            $random . $now,
            true
        );

        // Cache: identifier → state
        $this->cache->save(
            $state,
            self::STATE_CACHE_PREFIX . $identifier,
            [],
            self::CACHE_TTL
        );

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getState(): string
    {
        $identifier = $this->getIdentifier();
        $state = $this->cache->load(self::STATE_CACHE_PREFIX . $identifier);
        if (!$state) {
            throw new LogicException('State must be present for OAuth 2');
        }

        return $state;
    }

    /**
     * @inheritDoc
     */
    public function forgetState(): void
    {
        $identifier = $this->getIdentifier();
        $this->cache->remove(self::STATE_CACHE_PREFIX . $identifier);
    }

    /**
     * @inheritDoc
     */
    public function setIsRegister(bool $isRegister): self
    {
        $identifier = $this->getIdentifier();

        $this->cache->save(
            (string) (int) $isRegister,
            self::IS_REGISTER_CACHE_PREFIX . $identifier,
            [],
            self::CACHE_TTL
        );

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function isRegister(): bool
    {
        $identifier = $this->getIdentifier();

        $value = $this->cache->load(self::IS_REGISTER_CACHE_PREFIX . $identifier);

        return $value ? (bool) (int) $value : false;
    }

    /**
     * @inheritDoc
     */
    public function forgetIsRegister(): void
    {
        $identifier = $this->getIdentifier();

        $this->cache->remove(self::IS_REGISTER_CACHE_PREFIX . $identifier);
    }
}
