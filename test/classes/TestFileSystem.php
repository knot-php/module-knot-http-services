<?php
declare(strict_types=1);

namespace knotphp\module\knothttpservice\test\classes;

use knotlib\kernel\fileSystem\AbstractFileSystem;
use knotlib\kernel\fileSystem\FileSystemInterface;

final class TestFileSystem extends AbstractFileSystem implements FileSystemInterface
{
    public function getDirectory(string $dir): string
    {
        return '';
    }
}