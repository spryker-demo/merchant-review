<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReview;
use Propel\Runtime\Collection\ObjectCollection;

class MerchantReviewMapper
{
    /**
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function mapMerchantReviewEntityToMerchantReviewTransfer(
        SpyMerchantReview $merchantReviewEntity,
        MerchantReviewTransfer $merchantReviewTransfer
    ): MerchantReviewTransfer {
        return $merchantReviewTransfer
            ->fromArray($merchantReviewEntity->toArray(), true)
            ->setIdLocale($merchantReviewEntity->getFkLocale())
            ->setIdMerchant($merchantReviewEntity->getFkMerchant());
    }

    /**
     * @param \Propel\Runtime\Collection\ObjectCollection $merchantReviewEntities
     * @param \Generated\Shared\Transfer\MerchantReviewCollectionTransfer $merchantReviewCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function mapMerchantReviewEntitiesToMerchantReviewCollection(
        ObjectCollection $merchantReviewEntities,
        MerchantReviewCollectionTransfer $merchantReviewCollectionTransfer
    ): MerchantReviewCollectionTransfer {
        foreach ($merchantReviewEntities as $merchantReviewEntity) {
            $merchantReviewCollectionTransfer->addMerchantReview($this->mapMerchantReviewEntityToMerchantReviewTransfer($merchantReviewEntity, new MerchantReviewTransfer()));
        }

        return $merchantReviewCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview $merchantReviewEntity
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReview
     */
    public function mapMerchantReviewTransferToMerchantReviewEntity(
        MerchantReviewTransfer $merchantReviewTransfer,
        SpyMerchantReview $merchantReviewEntity
    ): SpyMerchantReview {
        return $merchantReviewEntity
            ->fromArray($merchantReviewTransfer->toArray())
            ->setFkMerchant($merchantReviewTransfer->getIdMerchantOrFail())
            ->setFkLocale($merchantReviewTransfer->getIdLocaleOrFail());
    }
}
