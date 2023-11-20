<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Validator;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewResponseTransfer;

interface MerchantReviewRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function validate(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewResponseTransfer;
}
