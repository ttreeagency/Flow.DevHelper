<?php
namespace Ttree\Flow\DevHelper;

/*
 * This file is part of the Ttree.Flow.DevHelper package.
 *
 * (c) Build with love by ttree agency - www.ttree.ch
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Flow\DevHelper\Domain\Service\MetricService;
use TYPO3\Flow\Core\Bootstrap;
use TYPO3\Flow\Package\Package as BasePackage;

/**
 * The Flow\DevHelper Package
 */
class Package extends BasePackage
{
    /**
     * @var boolean
     */
    protected $protected = true;

    /**
     * Invokes custom PHP code directly after the package manager has been initialized.
     *
     * @param Bootstrap $bootstrap The current bootstrap
     * @return void
     */
    public function boot(Bootstrap $bootstrap)
    {
        $dispatcher = $bootstrap->getSignalSlotDispatcher();

        $dispatcher->connect(Bootstrap::class, 'finishedCompiletimeRun', MetricService::class, 'registerFinishedCompiletimeRun');
        $dispatcher->connect(Bootstrap::class, 'finishedRuntimeRun', MetricService::class, 'registerFinishedRuntimeRun');

        $dispatcher->connect(Bootstrap::class, 'bootstrapShuttingDown', MetricsStorage::class, 'flush');
    }
}
