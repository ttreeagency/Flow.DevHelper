<?php
namespace Ttree\Flow\DevHelper\Traits;

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
 * HumanTrait
 */
trait HumanTrait
{
    /**
     * @param mixed $size
     * @param integer $precision
     * @return string
     */
    protected function humanFilesize($size, $precision = 2) {
        for($i = 0; ($size / 1024) > 0.9; $i++, $size /= 1024) {}
        return round($size, $precision).['B','kB','MB','GB','TB','PB','EB','ZB','YB'][$i];
    }

}
