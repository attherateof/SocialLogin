# Mage2 Module: Mage Stack Social Login
MageStack_SocialLogin is a Magento 2 module designed to streamline the integration between Magento and Logstash. It enables developers and administrators to easily view and filter logs from OpenSearch (via Logstash) directly within the Magento admin panel.

## Requirements
- Magento 2.4.8
- PHP 8.4
- MageStack Core module
    ``composer require mage-stack/module-core``

## Module version
- 1.0.0

## Main Functionalities
- Provide reusable services for verious social login

## Installation
1. **Install the module via Composer**:
    To install this module, run the following command in your Magento root directory:
    - ``composer require mage-stack/module-social-login``
2. **Enable the module:**
    After installation, enable the module by running:
   - ``php bin/magento module:enable MageStack_SocialLogin``
3. **Apply database updates:**
    Run the setup upgrade command to apply any database changes:
    - ``php bin/magento setup:upgrade``
4. **Flush the Magento cache:**
    Finally, flush the cache:
   -  ``php bin/magento cache:flush``

## Usage
This module provides a resuable logics for verius social logins. So implemetning them can be faster and easier.

## Supported Social login
- [Google Login](https://github.com/attherateof/GoogleLogin)

## Upcoming support
- Facebook login
- Instagram
- X
- GitHub
- LinkedIn
- Apple ID

## Contributing
If you would like to contribute to this module, feel free to fork the repository and create a pull request. Please make sure to follow the coding standards of Magento 2.

## Reporting Issues
If you encounter any issues or need support, please create an issue on the GitHub Issues page. We will review and address your concerns as soon as possible.

## License
This module is licensed under the MIT License.

## Support
If you find this module useful, consider supporting me By giving this module a star on github
