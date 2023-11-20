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

interface MerchantReviewFacadeInterface
{
    /**
     * Specification:
     *    - Stores provided merchant review in persistent storage with pending status.
     *    - Checks if provided rating in transfer object does not exceed configured limit.
     *    - Returns the provided transfer object updated with the stored entity's data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewResponseTransfer
     */
    public function createMerchantReview(
        MerchantReviewRequestTransfer $merchantReviewRequestTransfer
    ): MerchantReviewResponseTransfer;

    /**
     * Specification:
     * - Finds the merchant review from persistent storage by provided id.
     *
     * @api
     *
     * @param int $idMerchantReview
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findMerchantReviewById(
        int $idMerchantReview
    ): ?MerchantReviewTransfer;

    /**
     * Specification:
     * - Updates merchant review's status in persistent storage that matches the provided id in the transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return void
     */
    public function updateMerchantReviewStatus(
        MerchantReviewTransfer $merchantReviewTransfer
    ): void;

    /**
     * Specification:
     * - Permanently deletes the merchant review from persistent storage that matches the provided id.
     *
     * @api
     *
     * @param int $idMerchantReview
     *
     * @return void
     */
    public function deleteMerchantReviewById(int $idMerchantReview): void;

    /**
     * Specification:
     * - Returns all available merchant reviews by `MerchantReviewCriteriaTransfer`.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\MerchantReviewCriteriaTransfer $merchantReviewCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(MerchantReviewCriteriaTransfer $merchantReviewCriteriaTransfer): MerchantReviewCollectionTransfer;
}
