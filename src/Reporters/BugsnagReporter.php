<?php

namespace Digitalroll\Heimdal\Reporters;

use Throwable;
use Bugsnag\Client;
use InvalidArgumentException;

class BugsnagReporter implements ReporterInterface
{
    /** @var Client */
    protected $client;

    /**
     * SentryReporter constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        if (!class_exists(Client::class)) {
            throw new InvalidArgumentException("Bugsnag client is not installed. Use composer require bugsnag/bugsnag-laravel.");
        }

        $this->client = app(Client::class);
    }

    /**
     * Report exception
     *
     * @param Exception $exception
     */
    public function report(Throwable $exception)
    {
        return $this->client->notifyException($exception);
    }
}
