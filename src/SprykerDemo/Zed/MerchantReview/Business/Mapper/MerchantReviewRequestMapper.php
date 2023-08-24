<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business\Mapper;

use Generated\Shared\Transfer\MerchantReviewRequestTransfer;
use Generated\Shared\Transfer\MerchantReviewTransfer;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;

class MerchantReviewRequestMapper implements MerchantReviewRequestMapperInterface
{
    /**
     * @var \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected LocaleFacadeInterface $localeFacade;

    /**
     * @param \Spryker\Zed\Locale\Business\LocaleFacadeInterface $localeFacade
     */
    public function __construct(LocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantReviewRequestTransfer $merchantReviewRequestTransfer
     * @param \Generated\Shared\Transfer\MerchantReviewTransfer $merchantReviewTransfer
     *
     * @return \Generated\Shared\Transfer\MerchantReviewTransfer
     */
    public function mapRequestTransfer(
        MerchantReviewRequestTransfer $merchantReviewRequestTransfer,
        MerchantReviewTransfer $merchantReviewTransfer
    ): MerchantReviewTransfer {
        return $merchantReviewTransfer
            ->fromArray($merchantReviewRequestTransfer->modifiedToArray(), true)
            ->setFkMerchant($merchantReviewRequestTransfer->getIdMerchantOrFail())
            ->setFkLocale($this->findIdLocale($merchantReviewRequestTransfer->getLocaleNameOrFail()));
    }

    /**
     * @param string $localeName
     *
     * @return int|null
     */
    protected function findIdLocale(string $localeName): ?int
    {
        return $this->localeFacade->getLocale($localeName)->getIdLocale();
    }
}
