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

use Ttree\Flow\DevHelper\Domain\Model\Metric;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Configuration\ConfigurationManager;
use TYPO3\Flow\Exception;
use TYPO3\Flow\Log\Logger;
use TYPO3\Flow\Log\LoggerFactory;
use TYPO3\Flow\Object\ObjectManagerInterface;

/**
 * Metrics Storage
 *
 * @Flow\Scope("singleton")
 * @api
 */
class MetricsStorage
{
    /**
     * @var LoggerFactory
     */
    protected $loggerFactory;

    /**
     * @var ConfigurationManager
     */
    protected $configurationManager;

    /**
     * @var array
     */
    protected $settings;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $metrics = [];

    /**
     * @var string
     */
    protected $requestIdentifier;

    /**
     * @var boolean
     */
    protected $flushed = false;

    /**
     * @param integer $cause
     * @return void
     */
    public function initializeObject($cause = null)
    {
        if ($cause === ObjectManagerInterface::INITIALIZATIONCAUSE_CREATED || $this->requestIdentifier === null) {
            $this->settings = $this->configurationManager->getConfiguration(ConfigurationManager::CONFIGURATION_TYPE_SETTINGS, 'Ttree.Flow.DevHelper');
            $this->requestIdentifier = uniqid('', true);
        }
    }

    /**
     * @param LoggerFactory $factory
     */
    public function injectLoggerFactory(LoggerFactory $factory)
    {
        $this->loggerFactory = $factory;
    }

    /**
     * @param ConfigurationManager $manager
     */
    public function injectConfigurationManager(ConfigurationManager $manager)
    {
        $this->configurationManager = $manager;
    }

    /**
     * Lazy logger initialization
     */
    protected function initializeLogger()
    {
        if ($this->logger !== null) {
            return;
        }
        $this->logger = $this->loggerFactory->create('Ttree.Flow.DevHelper', Logger::class, Log\Backend\FileBackend::class, $this->settings['log']['backendOptions']);
    }

    /**
     * @return array
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * Flush message during shutdown process
     */
    public function flush()
    {
        $this->initializeLogger();
        $messages = [];
        /** @var Metric $metric */
        foreach ($this->metrics as $metric) {
            $message = sprintf('id=%s %s', $this->requestIdentifier, $metric->logfmt());
            $messages[] = $message;
            $this->logger->log($message, LOG_INFO, null, 'Ttree.Flow.DevHelper');
        }
        $this->emitFlushedMessages($messages);
        $this->flushed = true;
    }

    /**
     * @param Metric $metric
     * @throws Exception
     */
    public function register(Metric $metric)
    {
        if ($this->flushed === true) {
            throw new Exception('MetricsStorage has been flushed you can not register new metric', 1463094959);
        }
        $this->metrics[] = $metric;
    }

    /**
     * @Flow\Signal
     * @param array $messages
     * @return void
     */
    protected function emitFlushedMessages(array $messages)
    {
    }
}
