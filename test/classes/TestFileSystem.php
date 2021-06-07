<?php
declare(strict_types=1);

namespace knotphp\module\knothttpservice\test;

use knotlib\kernel\fileSystem\AbstractFileSystem;
use knotlib\kernel\fileSystem\FileSystemInterface;

final class TestFileSystem extends AbstractFileSystem implements FileSystemInterface
{
    public function getDirectory(int $dir): string
    {
        $map = [];
        return $map[$dir] ?? '';
    }
}