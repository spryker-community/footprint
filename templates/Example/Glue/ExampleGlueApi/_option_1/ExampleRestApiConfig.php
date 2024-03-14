<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */


namespace ExampleGlueApiConfig\_choice1\_false;

use Spryker\Glue\CartsRestApi\CartsRestApiConfig as SprykerCartsRestApiConfig;

class ExampleRestApiConfig extends SprykerCartsRestApiConfig
{
    /**
     * @var bool
     */
    protected const ALLOWED_CART_ITEM_EAGER_RELATIONSHIP = false;

    /**
     * @var bool
     */
    protected const ALLOWED_GUEST_CART_ITEM_EAGER_RELATIONSHIP = false;
}
