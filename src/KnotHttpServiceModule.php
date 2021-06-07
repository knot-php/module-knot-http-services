<?php
declare(strict_types=1);

namespace knotphp\module\knothttpservice;

use Throwable;

use knotlib\kernel\module\ModuleInterface;
use knotlib\kernel\module\ComponentTypes;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\eventstream\Channels;
use knotlib\kernel\eventstream\Events;
use knotlib\kernel\exception\ModuleInstallationException;
use knotlib\httpservice\CookieService;
use knotlib\httpservice\DI;
use knotlib\httpservice\SessionService;

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
        catch(Throwable $ex)
        {
            throw new ModuleInstallationException(self::class, $ex->getMessage(), $ex);
        }
    }
}