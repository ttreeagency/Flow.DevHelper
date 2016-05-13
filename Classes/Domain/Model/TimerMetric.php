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

use TYPO3\Flow\Annotations as Flow;

/**
 * Metric
 *
 * @Flow\Proxy(false)
 * @api
 */
class TimerMetric extends Metric
{
    /**
     * @var integer
     */
    protected static $lastTimer = [];

    /**
     * @param string $name
     * @param array $data
     */
    public function __construct($name, array $data = [])
    {
        $time = microtime(true);
        if (isset(self::$lastTimer[$name])) {
            $data = self::$lastTimer[$name];
            $data['delta'] = $time - self::$lastTimer[$name]['last'];
            $data['iteration']++;

            self::$lastTimer[$name]['last'] = $time;
            self::$lastTimer[$name]['iteration']++;
        } else {
            self::$lastTimer[$name] = [
                'start' => $time,
                'last' => $time,
                'delta' => 0,
                'iteration' => 1
            ];

            $data = self::$lastTimer[$name];
        }

        parent::__construct($name, $data);
    }
}
