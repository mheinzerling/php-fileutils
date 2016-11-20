<?php
namespace mheinzerling\commons;

class FileUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testAppend()
    {
        static::assertEquals(null, FileUtils::append(null, null));
        static::assertEquals("", FileUtils::append("", ""));
        static::assertEquals("foo", FileUtils::append("", "foo"));
        static::assertEquals("bar", FileUtils::append("bar", ""));
        static::assertEquals("bar/foo", FileUtils::append("bar", "foo"));
        static::assertEquals("bar/foo", FileUtils::append("bar/", "foo"));
        static::assertEquals("bar/foo", FileUtils::append("bar", "/foo"));
        static::assertEquals("bar/foo", FileUtils::append("bar/", "/foo"));
    }

    public function testBasename()
    {
        static::assertEquals("", FileUtils::basename(null, null));
        static::assertEquals("passwd", FileUtils::basename("/etc/passwd"));
        static::assertEquals("etc", FileUtils::basename("/etc/"));
        static::assertEquals(".", FileUtils::basename("."));
        static::assertEquals("", FileUtils::basename("/"));
        static::assertEquals("Revision", FileUtils::basename("mheinzerling\\revision\\Revision"));
        static::assertEquals("sudoers", FileUtils::basename("/etc/sudoers.d", ".d"));
        static::assertEquals("file", FileUtils::basename("path/to/file.xml#xpointer(/Texture)", ".xml#xpointer(/Texture)"));
    }
}