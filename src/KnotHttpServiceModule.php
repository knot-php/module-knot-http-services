<?php
declare(strict_types=1);

namespace KnotPhp\Module\KnotHttpService;

use Throwable;

use KnotLib\Kernel\Module\ModuleInterface;
use KnotLib\Kernel\Module\ComponentTypes;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\EventStream\Channels;
use KnotLib\Kernel\EventStream\Events;
use KnotLib\Kernel\Exception\ModuleInstallationException;
use KnotLib\HttpService\CookieService;
use KnotLib\HttpService\DI;
use KnotLib\HttpService\SessionService;

class KnotHttpServiceModule implements ModuleInterface
{
    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [];
    }

    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponentTypes() : array
    {
        return [
            ComponentTypes::DI,
            ComponentTypes::EVENTSTREAM,
            ComponentTypes::SESSION,
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return ComponentTypes::SERVICE;
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     *
     * @throws ModuleInstallationException
     */
    public function install(ApplicationInterface $app)
    {
        try{
            $session = $app->session();

            $c = $app->di();

            // services.cookie factory
            $c[DI::URI_SERVICE_COOKIE] = function(){
                return new CookieService();
            };

            // services.session factory
            $c[DI::URI_SERVICE_SESSION] = function() use($session){
                return new SessionService($session);
            };

            // fire event
            $app->eventstream()->channel(Channels::SYSTEM)->push(Events::MODULE_INSTALLED, $this);
        }
        catch(Throwable $e)
        {
            throw new ModuleInstallationException(self::class, $e->getMessage(), 0, $e);
        }
    }
}