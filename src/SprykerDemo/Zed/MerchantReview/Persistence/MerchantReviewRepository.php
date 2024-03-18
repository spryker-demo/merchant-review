<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Generated\Shared\Transfer\MerchantReviewCollectionTransfer;
use Generated\Shared\Transfer\MerchantReviewCriteriaTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewPersistenceFactory getFactory()
 */
class MerchantReviewRepository extends AbstractRepository implements MerchantReviewRepositoryInterface
{
    /**
     * @param int $idMerchantReview
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer|null
     */
    public function findMerchantReviewById(int $idMerchantReview): ?MerchantReviewTransfer
    {
        $merchantReviewEntity = $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview($idMerchantReview)
            ->findOne();

        if (!$merchantReviewEntity) {
            return null;
        }

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntityToMerchantReviewTransfer($merchantReviewEntity, new MerchantReviewTransfer());
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewCriteriaTransfer $merchantReviewCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(MerchantReviewCriteriaTransfer $merchantReviewCriteriaTransfer): MerchantReviewCollectionTransfer
    {
        $merchantReviewQuery = $this->getFactory()
            ->createMerchantReviewQuery();

        if ($merchantReviewCriteriaTransfer->getMerchantReviewIds()) {
            $merchantReviewQuery->filterByIdMerchantReview_In($merchantReviewCriteriaTransfer->getMerchantReviewIds());
        }

        if ($merchantReviewCriteriaTransfer->getFilter()) {
            $merchantReviewQuery = $this->applyFilter($merchantReviewCriteriaTransfer->getFilter(), $merchantReviewQuery);
        }

        /** @var \Propel\Runtime\Collection\ObjectCollection $merchantReviewEntities */
        $merchantReviewEntities = $merchantReviewQuery->find();

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntitiesToMerchantReviewCollection($merchantReviewEntities, new MerchantReviewCollectionTransfer());
    }

    /**
     * @param array<int> $merchantReviewIds
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviewsByIds(array $merchantReviewIds): MerchantReviewCollectionTransfer
    {
        /** @var \Propel\Runtime\Collection\ObjectCollection $merchantReviewEntities */
        $merchantReviewEntities = $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview_In($merchantReviewIds)
            ->find();

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntitiesToMerchantReviewCollection($merchantReviewEntities, new MerchantReviewCollectionTransfer());
    }

    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery $merchantReviewQuery
     *
     * @return \Orm\Zed\MerchantReview\Persistence\SpyMerchantReviewQuery
     */
    protected function applyFilter(FilterTransfer $filterTransfer, SpyMerchantReviewQuery $merchantReviewQuery): SpyMerchantReviewQuery
    {
        if ($filterTransfer->getLimit()) {
            $merchantReviewQuery->limit($filterTransfer->getLimit());
        }

        if ($filterTransfer->getOffset()) {
            $merchantReviewQuery->offset($filterTransfer->getOffset());
        }

        if ($filterTransfer->getOrderBy()) {
            $merchantReviewQuery->orderBy($filterTransfer->getOrderBy(), $filterTransfer->getOrderDirection() ?? 'ASC');
        }

        return $merchantReviewQuery;
    }
}
