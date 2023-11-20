<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Creator;

use Generated\Shared\Transfer\MerchantReviewErrorTransfer;
use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewResponseTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use SprykerDemo\Zed\MerchantReview\Business\Mapper\MerchantReviewRequestMapperInterface;
use SprykerDemo\Zed\MerchantReview\Business\Validator\MerchantReviewRequestValidatorInterface;
use SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface;
use Throwable;

class MerchantReviewCreator implements MerchantReviewCreatorInterface
{
    /**
     * @var string
     */
    protected const ERROR_MERCHANT_REVIEW_IS_NOT_CREATED = 'Merchant review is not created.';

    /**
     * @var \SprykerDemo\Zed\MerchantReview\Business\Validator\MerchantReviewRequestValidatorInterface
     */
    protected MerchantReviewRequestValidatorInterface $merchantReviewRequestValidator;

    /**
     * @var \SprykerDemo\Zed\MerchantReview\Business\Mapper\MerchantReviewRequestMapperInterface
     */
    protected MerchantReviewRequestMapperInterface $merchantReviewRequestMapper;

    /**
     * @var \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface
     */
    protected MerchantReviewEntityManagerInterface $merchantReviewEntityManager;

    /**
     * @param \SprykerDemo\Zed\MerchantReview\Business\Validator\MerchantReviewRequestValidatorInterface $merchantReviewRequestValidator
     * @param \SprykerDemo\Zed\MerchantReview\Business\Mapper\MerchantReviewRequestMapperInterface $merchantReviewRequestMapper
     * @param \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface $merchantReviewEntityManager
     */
    public function __construct(
        MerchantReviewRequestValidatorInterface $merchantReviewRequestValidator,
        MerchantReviewRequestMapperInterface $merchantReviewRequestMapper,
        MerchantReviewEntityManagerInterface $merchantReviewEntityManager
    ) {
        $this->merchantReviewRequestValidator = $merchantReviewRequestValidator;
        $this->merchantReviewRequestMapper = $merchantReviewRequestMapper;
        $this->merchantReviewEntityManager = $merchantReviewEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function createMerchantReview(MerchantReviewRequestTransfer $merchantReviewRequestTransfer): MerchantReviewResponseTransfer
    {
        $merchantReviewResponseTransfer = (new MerchantReviewResponseTransfer())->setIsSuccess(true);

        try {
            $merchantReviewResponseTransfer = $this->merchantReviewRequestValidator->validate($merchantReviewRequestTransfer);

            if ($merchantReviewResponseTransfer->getIsSuccess() !== true) {
                return $merchantReviewResponseTransfer;
            }

            $this->merchantReviewEntityManager->createMerchantReview(
                $this->merchantReviewRequestMapper->mapRequestTransfer($merchantReviewRequestTransfer, new MerchantReviewTransfer()),
            );
        } catch (Throwable $exception) {
            return $merchantReviewResponseTransfer
                ->setIsSuccess(false)
                ->addError((new MerchantReviewErrorTransfer())->setMessage(static::ERROR_MERCHANT_REVIEW_IS_NOT_CREATED));
        }

        return $merchantReviewResponseTransfer;
    }
}
