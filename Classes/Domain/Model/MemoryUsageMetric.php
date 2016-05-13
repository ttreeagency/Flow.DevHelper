<?php
namespace Ttree\Flow\DevHelper\Domain\Model;

/*
 * This file is part of the Ttree.Flow.DevHelper package.
 *
 * (c) Build with love by ttree agency - www.ttree.ch
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

use Ttree\Flow\DevHelper\Traits\HumanTrait;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Utility\Arrays;

/**
 * Metric
 *
 * @Flow\Proxy(false)
 * @api
 */
class MemoryUsageMetric extends Metric
{
    use HumanTrait;

    /**
     * @param string $name
     * @param array $data
     */
    public function __construct($name, array $data = [])
    {
        $memory = memory_get_usage();
        $data = Arrays::arrayMergeRecursiveOverrule([
            'memory' => $memory,
            'human_memory' => $this->humanFilesize($memory),
        ], $data);
        
        parent::__construct($name, $data);
    }
}
