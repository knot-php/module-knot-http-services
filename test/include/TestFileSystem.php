<?php
declare(strict_types=1);

namespace KnotModule\KnotHttpService\Test;

use KnotLib\Kernel\FileSystem\AbstractFileSystem;
use KnotLib\Kernel\FileSystem\FileSystemInterface;

final class TestFileSystem extends AbstractFileSystem implements FileSystemInterface
{
    public function getDirectory(int $dir): string
    {
        $map = [];
        return $map[$dir] ?? '';
    }
}