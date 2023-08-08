<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Service\MerchantReview\Calculator;

use Generated\Shared\Transfer\MerchantReviewSummaryTransfer;
use Generated\Shared\Transfer\RatingAggregationTransfer;
use SprykerDemo\Shared\MerchantReview\MerchantReviewConfig;

class MerchantReviewSummaryCalculator
{
    /**
     * @var int
     */
    public const MINIMUM_RATING = 1;

    /**
     * @var int
     */
    public const RATING_PRECISION = 1;

    /**
     * @param \Generated\Shared\Transfer\RatingAggregationTransfer $ratingAggregationTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewSummaryTransfer
     */
    public function calculate(RatingAggregationTransfer $ratingAggregationTransfer): MerchantReviewSummaryTransfer
    {
        $ratingAggregationTransfer->requireRatingAggregation();

        $ratingAggregation = $ratingAggregationTransfer->getRatingAggregation();
        $totalReview = $this->getTotalReview($ratingAggregation);

        return (new MerchantReviewSummaryTransfer())
            ->setRatingAggregation($this->formatRatingAggregation($ratingAggregation))
            ->setMaximumRating(MerchantReviewConfig::MERCHANT_REVIEW_MAXIMUM_RATING)
            ->setAverageRating($this->getAverageRating($ratingAggregation, $totalReview))
            ->setTotalReview($totalReview);
    }

    /**
     * @param array<int> $ratingAggregation
     * @param int $totalReview
     *
     * @return float
     */
    protected function getAverageRating(array $ratingAggregation, int $totalReview): float
    {
        if ($totalReview === 0) {
            return 0.0;
        }

        $totalRating = $this->getTotalRating($ratingAggregation);

        return round($totalRating / $totalReview, static::RATING_PRECISION);
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return array<int>
     */
    protected function formatRatingAggregation(array $ratingAggregation): array
    {
        $ratingAggregation = $this->fillRatings($ratingAggregation);
        $ratingAggregation = $this->sortRatings($ratingAggregation);

        return $ratingAggregation;
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return array<int>
     */
    protected function fillRatings(array $ratingAggregation): array
    {
        for ($rating = static::MINIMUM_RATING; $rating <= MerchantReviewConfig::MERCHANT_REVIEW_MAXIMUM_RATING; $rating++) {
            $ratingAggregation[$rating] = $ratingAggregation[$rating] ?? 0;
        }

        return $ratingAggregation;
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return array<int>
     */
    protected function sortRatings(array $ratingAggregation): array
    {
        krsort($ratingAggregation);

        return $ratingAggregation;
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return int
     */
    protected function getTotalReview(array $ratingAggregation): int
    {
        return array_sum($ratingAggregation);
    }

    /**
     * @param array<int> $ratingAggregation
     *
     * @return int
     */
    protected function getTotalRating(array $ratingAggregation): int
    {
        $totalRating = 0;

        foreach ($ratingAggregation as $rating => $reviewCount) {
            $totalRating += $reviewCount * $rating;
        }

        return $totalRating;
    }
}
