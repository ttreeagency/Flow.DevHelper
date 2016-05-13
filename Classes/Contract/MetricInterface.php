<?php
namespace Ttree\Flow\DevHelper\Contract;

/*
 * This file is part of the Ttree.Flow.DevHelper package.
 *
 * (c) Build with love by ttree agency - www.ttree.ch
 *
 * This package is Open Source Software. For the full copyright and license
 * information, please view the LICENSE file which was distributed with this
 * source code.
 */

/**
 * Metric Interface
 * 
 * @api
 */
interface MetricInterface
{
    /**
     * Metric constructor.
     *
     * @param string $name
     * @param array $data
     */
    public function __construct($name, array $data = []);

    /**
     * @return string
     */
    public function name();

    /**
     * @return array
     */
    public function data();

    /**
     * Output the date in logfmt format
     *
     * @see https://brandur.org/logfmt
     * @return string
     */
    public function logfmt();

}
