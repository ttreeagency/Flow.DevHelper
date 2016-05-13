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

use Ttree\Flow\DevHelper\Traits\HumanTrait;
use TYPO3\Flow\Annotations as Flow;

/**
 * Profiler
 */
class Profiler
{
    use HumanTrait;

    /**
     * @var array
     */
    protected $metrics = [];

    /**
     * @var double
     */
    protected $lastTimer;

    /**
     * Profiler constructor
     */
    public function __construct()
    {
        register_tick_function([$this, "tick"]);
        $this->lastTimer = microtime(true);
        declare(ticks = 1);
    }

    /**
     * Unregister the tick method during object lifecycle
     *
     * @return void
     */
    public function __destruct()
    {
        unregister_tick_function([$this, "tick"]);
    }

    /**
     * Register metrics on every tick
     *
     * @return void
     */
    public function tick()
    {
        $timer = microtime(true);
        $delta = $timer - $this->lastTimer;
        $this->lastTimer = $timer;
        $memory = memory_get_usage(true);
        $peakMemory = memory_get_peak_usage(true);
        $this->metrics[] = [
            "memory" => $memory,
            "_memory" => $this->humanFilesize($memory),
            "peakMemory" => $peakMemory,
            "_peakMemory" => $this->humanFilesize($peakMemory),
            "delta" => $delta
        ];
    }

    /**
     * @return array
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

}
