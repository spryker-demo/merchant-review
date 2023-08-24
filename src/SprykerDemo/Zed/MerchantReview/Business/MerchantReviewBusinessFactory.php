<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerDemo\Zed\MerchantReview\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Locale\Business\LocaleFacadeInterface;
use SprykerDemo\Zed\MerchantReview\Business\Creator\MerchantReviewCreator;
use SprykerDemo\Zed\MerchantReview\Business\Creator\MerchantReviewCreatorInterface;
use SprykerDemo\Zed\MerchantReview\Business\Mapper\MerchantReviewRequestMapper;
use SprykerDemo\Zed\MerchantReview\Business\Mapper\MerchantReviewRequestMapperInterface;
use SprykerDemo\Zed\MerchantReview\Business\Validator\MerchantReviewRequestValidator;
use SprykerDemo\Zed\MerchantReview\Business\Validator\MerchantReviewRequestValidatorInterface;
use SprykerDemo\Zed\MerchantReview\MerchantReviewDependencyProvider;

/**
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewRepositoryInterface getRepository()
 * @method \SprykerDemo\Zed\MerchantReview\Persistence\MerchantReviewEntityManagerInterface getEntityManager()
 */
class MerchantReviewBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Validator\MerchantReviewRequestValidatorInterface
     */
    public function createMerchantReviewRequestValidator(): MerchantReviewRequestValidatorInterface
    {
        return new MerchantReviewRequestValidator();
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Mapper\MerchantReviewRequestMapperInterface
     */
    public function createMerchantReviewRequestMapper(): MerchantReviewRequestMapperInterface
    {
        return new MerchantReviewRequestMapper($this->getLocaleFacade());
    }

    /**
     * @return \SprykerDemo\Zed\MerchantReview\Business\Creator\MerchantReviewCreatorInterface
     */
    public function createMerchantReviewCreator(): MerchantReviewCreatorInterface
    {
        return new MerchantReviewCreator(
            $this->createMerchantReviewRequestValidator(),
            $this->createMerchantReviewRequestMapper(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \Spryker\Zed\Locale\Business\LocaleFacadeInterface
     */
    protected function getLocaleFacade(): LocaleFacadeInterface
    {
        return $this->getProvidedDependency(MerchantReviewDependencyProvider::FACADE_LOCALE);
    }
}
