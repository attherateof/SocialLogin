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
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\InputException;
use Magento\Framework\Exception\State\InputMismatchException;

/**
 * Interface for Customer Resolver
 *
 * @interface CustomerResolverInterface
 * @namespace MageStack\SocialLogin\Api
 *
 * @api
 */
interface CustomerResolverInterface
{
    /**
     * Load customer by email
     *
     * @param string $email
     *
     * @return CustomerInterface
     *
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getCustomer(string $email): CustomerInterface;

    /**
     * Create a new customer
     *
     * @param string[] $userInfo
     *
     * @return CustomerInterface
     *
     * @throws InputException
     * @throws InputMismatchException
     * @throws LocalizedException
     */
    public function createCustomer(array $userInfo): CustomerInterface;
}
