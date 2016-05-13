<?php
namespace Ttree\Flow\DevHelper\Log\Backend;

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
 * File Backend implementation based on logfmt
 *
 * @api
 */
class FileBackend extends \TYPO3\Flow\Log\Backend\FileBackend
{
    /**
     * {@inheritdoc}
     */
    public function open()
    {
        parent::open();

        $this->severityLabels = [
            LOG_EMERG => 'emergency',
            LOG_ALERT => 'alert',
            LOG_CRIT => 'critical',
            LOG_ERR => 'error',
            LOG_WARNING => 'warning',
            LOG_NOTICE => 'notice',
            LOG_INFO => 'info',
            LOG_DEBUG => 'debug',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function append($message, $severity = LOG_INFO, $additionalData = null, $packageKey = null, $className = null, $methodName = null)
    {
        if ($severity > $this->severityThreshold) {
            return;
        }

        if (function_exists('posix_getpid')) {
            $processId = posix_getpid();
        } else {
            $processId = 'unknow';
        }
        $ipAddress = ($this->logIpAddress === true && isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 'unknow';
        $severityLabel = (isset($this->severityLabels[$severity])) ? $this->severityLabels[$severity] : 'unknow';
        $output = sprintf('pid=%s remote_address=%s severity=%s %s', $processId, $ipAddress, $severityLabel, $message);

        if ($this->fileHandle !== false) {
            fputs($this->fileHandle, $output . PHP_EOL);
        }
    }

}
