<?php
declare(strict_types=1);

namespace knotphp\module\knothttpservice\test;

use PHPUnit\Framework\TestCase;

use knotlib\httpservices\CookieService;
use knotlib\httpservices\DI;
use knotlib\httpservices\SessionService;

use knotphp\module\knotdi\KnotDiModule;
use knotphp\module\nyholmPsr7\NyholmPsr7RequestModule;
use knotphp\module\knothttpservice\KnotHttpServiceModule;
use knotphp\module\knothttpservice\test\classes\TestApplication;
use knotphp\module\knothttpservice\test\classes\TestFileSystem;

class KnotHttpServiceModuleTest extends TestCase
{
    /**
     * @throws
     */
    public function testConstruct()
    {
        $app = new TestApplication(new TestFileSystem());

        (new KnotDiModule())->install($app);
        (new NyholmPsr7RequestModule())->install($app);
        (new KnotHttpServiceModule())->install($app);

        $di = $app->di();

        $this->assertInstanceOf(CookieService::class, $di[DI::URI_SERVICE_COOKIE]);
        $this->assertInstanceOf(SessionService::class, $di[DI::URI_SERVICE_SESSION]);
    }

}