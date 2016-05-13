[![BSD License](https://img.shields.io/github/license/mashape/apistatus.svg)](LICENSE)
[![Latest Stable Version](https://poser.pugx.org/ttree/flow-devhelper/version)](https://packagist.org/packages/ttree/flow-devhelper)

# Flow Framework performance monitoring helper

Slim package to store performance metric for your application.

**Warning**: Under developmenet, everything can change.

## Installation

No stable release is available, you must use ```dev-master``` currently:

    composer require ttree/flow-devhelper dev-master
    
## Usage

This package simple log metrics to ```%FLOW_PATH_DATA%Logs/PerformanceMetrics.log```, you can change this value in your 
```Settings.yaml```. The log use [logfmt](https://brandur.org/logfmt) format to be easly parsable and human readable.

## Available metrics

### \Ttree\Flow\DevHelper\Domain\Model\MemoryUsageMetric

Log the current PHP memory usage.


### \Ttree\Flow\DevHelper\Domain\Model\TimerMetric

Create an internal timer. Display to start time, delta time between two invocation and number of invocation.

## Example log output

    pid=1235 remote_address=unknow severity=info id=57214c5418ce66.81891080, at=1461800020.1016 name=FinishedCompiletimeRun metric=Ttree\Flow\DevHelper\Domain\Model\MemoryUsageMetric memory=76425800 human_memory=72.89MB
    pid=259 remote_address=172.17.0.2 severity=info id=57214c547492f1.85042719, at=1461800020.4772 name=TYPO3\Flow\Mvc\Dispatcher::Dispatch metric=Ttree\Flow\DevHelper\Domain\Model\TimerMetric start=1461800020.4772 last=1461800020.4772 delta=0 iteration=1
    pid=259 remote_address=172.17.0.2 severity=info id=57214c547492f1.85042719, at=1461800020.8253 name=TYPO3\Flow\Mvc\Dispatcher::Dispatch metric=Ttree\Flow\DevHelper\Domain\Model\TimerMetric start=1461800020.4772 last=1461800020.4772 delta=0.34807991981506 iteration=2
    pid=259 remote_address=172.17.0.2 severity=info id=57214c547492f1.85042719, at=1461800020.8265 name=TYPO3\Flow\Mvc\Dispatcher::Dispatch metric=Ttree\Flow\DevHelper\Domain\Model\MemoryUsageMetric memory=70936144 human_memory=67.65MB
    pid=259 remote_address=172.17.0.2 severity=info id=57214c547492f1.85042719, at=1461800020.827 name=FinishedRuntimeRun metric=Ttree\Flow\DevHelper\Domain\Model\MemoryUsageMetric memory=70946984 human_memory=67.66MB

## How to work with logfmt ?

Tools like ```grep```, ```sed``` and ```awk``` are your best friend ;) but you can use more dedicated tools. Check the
article from [Codeship](https://blog.codeship.com/logfmt-a-log-format-thats-easy-to-read-and-write/) and use 
the [```htutils```](https://github.com/brandur/hutils) to see the full power of logfmt.

## Acknowledgments

Development sponsored by [ttree ltd - neos solution provider](http://ttree.ch).

We try our best to craft this package with a lots of love, we are open to sponsoring, support request, ... just contact us.

## License

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
