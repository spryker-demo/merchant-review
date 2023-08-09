<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Shared\MerchantReview;

use Spryker\Shared\Kernel\AbstractBundleConfig;

class MerchantReviewConfig extends AbstractBundleConfig
{
    /**
     * Specification:
     * - Represents the available maximum rating value.
     *
     * @api
     *
     * @var int
     */
    public const MERCHANT_REVIEW_MAXIMUM_RATING = 5;

    /**
     * Specification:
     * - Represents the available minimum rating value.
     *
     * @api
     *
     * @var int
     */
    public const MERCHANT_REVIEW_MINIMUM_RATING = 1;

    /**
     * Specification:
     * - Retrieves the available maximum rating value
     *
     * @api
     *
     * @return int
     */
    public function getMaximumRating(): int
    {
        return static::MERCHANT_REVIEW_MAXIMUM_RATING;
    }
}
