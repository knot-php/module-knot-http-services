<?php
declare(strict_types=1);

namespace KnotModule\KnotHttpService\Test;

use KnotLib\Kernel\Kernel\AbstractApplication;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\Kernel\ApplicationType;

final class TestApplication extends AbstractApplication
{
    public static function type(): ApplicationType
    {
        return ApplicationType::of(ApplicationType::CLI);
    }

    public function install(): ApplicationInterface
    {
        return $this;
    }

    public function installModules(array $modules): ApplicationInterface
    {
        return $this;
    }
}