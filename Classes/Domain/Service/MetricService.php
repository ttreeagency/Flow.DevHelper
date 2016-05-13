<?php
namespace Ttree\Flow\DevHelper\Domain\Service;

/*
 * This file is part of the Ttree.Flow.DevHelper package.
 *
 * (c) Build with love by ttree agency - www.ttree.ch
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Flow\DevHelper\Domain\Model\MemoryUsageMetric;
use Ttree\Flow\DevHelper\MetricsStorage;
use TYPO3\Flow\Annotations as Flow;

/**
 * Metric Service
 *
 * @Flow\Scope("singleton")
 * @api
 */
class MetricService
{
    /**
     * @var MetricsStorage
     */
    protected $storage;

    /**
     * @param MetricsStorage $storage
     */
    public function injectStorage(MetricsStorage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return void
     */
    public function registerFinishedCompiletimeRun()
    {
        $this->storage->register(new MemoryUsageMetric('FinishedCompiletimeRun'));
    }

    /**
     * @return void
     */
    public function registerFinishedRuntimeRun()
    {
        $this->storage->register(new MemoryUsageMetric('FinishedRuntimeRun'));
    }
}
