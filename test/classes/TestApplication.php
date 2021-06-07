<?php
declare(strict_types=1);

namespace knotphp\module\knothttpservice\test\classes;

use knotlib\kernel\kernel\AbstractApplication;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\kernel\ApplicationType;

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

    public function installModule(string $module_class): ApplicationInterface
    {
        return $this;
    }
}