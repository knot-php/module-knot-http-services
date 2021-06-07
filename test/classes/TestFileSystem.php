<?php
declare(strict_types=1);

namespace knotphp\module\knothttpservice\test\classes;

use knotlib\kernel\filesystem\AbstractFileSystem;
use knotlib\kernel\filesystem\FileSystemInterface;

final class TestFileSystem extends AbstractFileSystem implements FileSystemInterface
{
    public function getDirectory(string $dir): string
    {
        return '';
    }
}