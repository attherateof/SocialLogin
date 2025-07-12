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

define([
    'uiComponent',
    'Magento_Customer/js/model/customer'
], function (Component, customer) {
    'use strict';

    var checkoutConfig = window.checkoutConfig;

    return Component.extend({
        defaults: {
            template: 'MageStack_SocialLogin/social-login'
        },

        isCustomerLoginRequired: checkoutConfig.isCustomerLoginRequired,
        socials: checkoutConfig.social,

        canShow: function () {
            return !customer.isLoggedIn();
        },

        getActiveSocials: function () {
            var socials = this.socials || {};
            // Step 1: Get all social provider keys
            var socialKeys = Object.keys(socials);
            // Step 2: Filter keys where the provider is active
            var activeSocialKeys = socialKeys.filter(function (key) {
                return socials[key].is_enabled;
            });
            // Step 3: Map the active keys to a structured array
            return activeSocialKeys.map(function (key) {
                return {
                    code: key,
                    label: key.charAt(0).toUpperCase() + key.slice(1),
                    redirect_url: socials[key].url.login
                };
            });
        }
    });
});

