<?php
namespace Ttree\Flow\DevHelper\Aspect;

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
use Ttree\Flow\DevHelper\Domain\Model\TimerMetric;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Aop\JoinPointInterface;

/**
 * Dispatcher Timing Aspect
 *
 * @Flow\Aspect
 */
class DispatcherMetricAspect
{
    /**
     * @var \Ttree\Flow\DevHelper\MetricsStorage
     * @Flow\Inject
     */
    protected $metricsStorage;

    /**
     * @param JoinPointInterface $joinPoint
     * @Flow\After("method(public TYPO3\Flow\Mvc\Dispatcher->dispatch())")
     */
    public function memoryMetric(JoinPointInterface $joinPoint)
    {
        $this->metricsStorage->register(new MemoryUsageMetric('DispatcherDispatch'));
    }

    /**
     * @param JoinPointInterface $joinPoint
     * @Flow\Around("method(public TYPO3\Flow\Mvc\Dispatcher->dispatch())")
     */
    public function timerMetric(JoinPointInterface $joinPoint)
    {
        $this->metricsStorage->register(new TimerMetric('DispatcherDispatch'));
        $joinPoint->getAdviceChain()->proceed($joinPoint);
        $this->metricsStorage->register(new TimerMetric('DispatcherDispatch'));
    }

}
