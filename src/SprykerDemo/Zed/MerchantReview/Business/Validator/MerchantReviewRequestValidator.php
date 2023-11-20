<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Validator;

use Generated\Shared\Transfer\MerchantReviewErrorTransfer;
use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewResponseTransfer;
use SprykerDemo\Shared\MerchantReview\MerchantReviewConfig;

class MerchantReviewRequestValidator implements MerchantReviewRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function validate(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewResponseTransfer
    {
        $merchantReviewResponseTransfer = (new MerchantReviewResponseTransfer())->setIsSuccess(true);
        $rating = $merchantReviewRequestTransfer->getRating();

        if ($rating < MerchantReviewConfig::MERCHANT_REVIEW_MINIMUM_RATING || $rating > MerchantReviewConfig::MERCHANT_REVIEW_MAXIMUM_RATING) {
            $merchantReviewResponseTransfer->setIsSuccess(false)
                ->addError((new MerchantReviewErrorTransfer())->setMessage(sprintf(
                    'Rating must be between %d and %d.',
                    MerchantReviewConfig::MERCHANT_REVIEW_MINIMUM_RATING,
                    MerchantReviewConfig::MERCHANT_REVIEW_MAXIMUM_RATING,
                )));
        }

        return $merchantReviewResponseTransfer;
    }
}
