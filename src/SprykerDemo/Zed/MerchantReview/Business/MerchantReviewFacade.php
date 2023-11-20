<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewCriteriaTransfer;
use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewResponseTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Business\MerchantReviewBusinessFactory getFactory()
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface getEntityManager()
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface getRepository()
 */
class MerchantReviewFacade extends AbstractFacade implements MerchantReviewFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function createMerchantReview(
        MerchantReviewRequestTransfer $merchantReviewRequestTransfer
    ): MerchantReviewResponseTransfer {
        return $this->getFactory()->createMerchantReviewCreator()->createMerchantReview($merchantReviewRequestTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idMerchantReview
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findMerchantReviewById(
        int $idMerchantReview
    ): ?MerchantReviewTransfer {
        return $this->getRepository()->findMerchantReviewById($idMerchantReview);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    public function updateMerchantReviewStatus(
        MerchantReviewTransfer $merchantReviewTransfer
    ): void {
        $this->getEntityManager()->updateMerchantReviewStatus($merchantReviewTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param int $idMerchantReview
     *
     * @return void
     */
    public function deleteMerchantReviewById(int $idMerchantReview): void
    {
        $this->getEntityManager()->deleteMerchantReviewById($idMerchantReview);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewCriteriaTransfer $merchantReviewCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(MerchantReviewCriteriaTransfer $merchantReviewCriteriaTransfer): MerchantReviewCollectionTransfer
    {
        return $this->getRepository()->getMerchantReviews($merchantReviewCriteriaTransfer);
    }
}
