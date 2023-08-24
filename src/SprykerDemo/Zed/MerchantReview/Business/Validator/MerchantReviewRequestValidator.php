<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Validator;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use SprykerDemo\Shared\MerchantReview\Exception\RatingOutOfRangeException;
use SprykerDemo\Shared\MerchantReview\MerchantReviewConfig;

class MerchantReviewRequestValidator implements MerchantReviewRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @throws \SprykerDemo\Shared\MerchantReview\Exception\RatingOutOfRangeException
     *
     * @return void
     */
    public function validate(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): void
    {
        $rating = $merchantReviewRequestTransfer->getRating();
        if ($rating < MerchantReviewConfig::MERCHANT_REVIEW_MINIMUM_RATING || $rating > MerchantReviewConfig::MERCHANT_REVIEW_MAXIMUM_RATING) {
            throw new RatingOutOfRangeException(sprintf(
                'Rating must be between %d and %d.',
                MerchantReviewConfig::MERCHANT_REVIEW_MINIMUM_RATING,
                MerchantReviewConfig::MERCHANT_REVIEW_MAXIMUM_RATING,
            ));
        }
    }
}
