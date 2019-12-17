<?php
declare(strict_types=1);

namespace KnotModule\KnotHttpService\Test;

use PHPUnit\Framework\TestCase;

use KnotLib\HttpService\CookieService;
use KnotLib\HttpService\DI;
use KnotLib\HttpService\SessionService;

use KnotPhp\Module\KnotDi\KnotDiModule;
use KnotPhp\Module\NyholmPsr7\NyholmPsr7RequestModule;
use KnotPhp\Module\KnotHttpService\KnotHttpServiceModule;

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