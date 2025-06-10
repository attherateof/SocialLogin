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

use MageStack\SocialLogin\Api\CustomerResolverInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class CustomerResolver implements CustomerResolverInterface
{
    /**
     * @param CustomerInterfaceFactory $customerFactory
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        private readonly CustomerInterfaceFactory $customerFactory,
        private readonly CustomerRepositoryInterface $customerRepository
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getCustomer(string $email): ?CustomerInterface
    {
        try {
            return $this->customerRepository->get($email);
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    /**
     * @inheritDoc
     */
    public function createCustomer(array $userInfo): CustomerInterface
    {
        /** @var CustomerInterface $customer */
        $customer = $this->customerFactory->create();
        $customer->setEmail($userInfo['email']);
        $customer->setFirstname($userInfo['first_name']);
        $customer->setLastname($userInfo['last_name']);
        // TODO: Set random password 
        // TBD: Need to decide whether to send email to user mentioning to reset his/her password

        return $this->customerRepository->save($customer);
    }
}
