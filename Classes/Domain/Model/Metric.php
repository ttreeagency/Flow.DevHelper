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

use Ttree\Flow\DevHelper\Contract\MetricInterface;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Utility\Arrays;

/**
 * Metric
 *
 * @Flow\Proxy(false)
 * @api
 */
abstract class Metric implements MetricInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $at;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @param string $name
     * @param array $data
     */
    public function __construct($name, array $data = [])
    {
        $this->at = microtime(true);
        $this->name = $name;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function data()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function logfmt()
    {
        $data = [
            'at' => $this->at,
            'name' => $this->name,
            'metric' => get_called_class(),
        ] + $this->data();

        $message = [];
        foreach ($data as $name => $value) {
            if(strpos($value, ' ') !== false) {
                $value = sprintf('"%s"', $value);
            }
            $message[] = sprintf('%s=%s', $name, $value);
        }
        return implode(', ', $message);
    }
}
