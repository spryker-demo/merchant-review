<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Validator;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;

interface MerchantReviewRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @throws \SprykerDemo\Shared\MerchantReview\Exception\RatingOutOfRangeException
     *
     * @return void
     */
    public function validate(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): void;
}
