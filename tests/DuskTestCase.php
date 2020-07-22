<?php

namespace Tests;

use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Laravel\Dusk\TestCase as BaseTestCase;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
        ]);

<<<<<<< HEAD
        return RemoteWebDriver::create(
            // 'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
            //     ChromeOptions::CAPABILITY, $options
            // )
=======
        /*return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );*/
        return RemoteWebDriver::create(
>>>>>>> 359249fbd881ec512cdc9ba8a8a12b050772fd0d
            'http://selenium:4444/wd/hub',
            DesiredCapabilities::chrome()
        );
    }
}
