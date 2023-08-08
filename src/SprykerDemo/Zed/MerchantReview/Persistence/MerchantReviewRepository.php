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
     * @param \Generated\Shared\Transfer\MerchantReviewCriteriaTransfer $merchantReviewCriteria
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviews(MerchantReviewCriteriaTransfer $merchantReviewCriteria): MerchantReviewCollectionTransfer
    {
        $merchantReviewQuery = $this->getFactory()
            ->createMerchantReviewQuery();

        if ($merchantReviewCriteria->getMerchantReviewIds()) {
            $merchantReviewQuery->filterByIdMerchantReview_In($merchantReviewCriteria->getMerchantReviewIds());
        }

        if ($merchantReviewCriteria->getFilter()) {
            $merchantReviewQuery = $this->applyFilter($merchantReviewCriteria->getFilter(), $merchantReviewQuery);
        }

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntitiesToMerchantReviewCollection($merchantReviewQuery->find());
    }

    /**
     * @param array<int> $merchantReviewIds
     *
     * @return \Generated\Shared\Transfer\MerchantReviewCollectionTransfer
     */
    public function getMerchantReviewsByIds(array $merchantReviewIds): MerchantReviewCollectionTransfer
    {
        $merchantReviewEntities = $this->getFactory()
            ->createMerchantReviewQuery()
            ->filterByIdMerchantReview_In($merchantReviewIds)
            ->find();

        return $this->getFactory()
            ->createMerchantReviewMapper()
            ->mapMerchantReviewEntitiesToMerchantReviewCollection($merchantReviewEntities);
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
