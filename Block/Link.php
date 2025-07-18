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

namespace MageStack\SocialLogin\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use MageStack\SocialLogin\Model\CompositeSocialLinkBuilder;

/**
 * This block class is responsible for providing social auth link
 *
 * @class Link
 * @namespace MageStack\SocialLogin\Block
 */
class Link extends Template
{
    /**
     * Constructor
     *
     * @param CompositeSocialLinkBuilder $compositeSocialLinkBuilder
     * @param Context $context
     * @param array $data
     * @phpstan-param array<string|int, mixed> $data
     */
    public function __construct(
        private readonly CompositeSocialLinkBuilder $compositeSocialLinkBuilder,
        Context $context,
        array $data = [],
    ) {
        parent::__construct($context, $data);
    }

    public function getLoginLinks(): array
    {
        return $this->compositeSocialLinkBuilder->setIsForLogin(true)->getAuthProviders();
    }

    public function getRegisterLinks(): array
    {
        return $this->compositeSocialLinkBuilder->setIsForRegister(true)->getAuthProviders();
    }

    public function labelFormatter(string $label): string
    {
        return ucfirst(strtolower($label));
    }
}
