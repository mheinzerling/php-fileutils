<?php
namespace mheinzerling\commons;

class FileUtilsTest extends \PHPUnit_Framework_TestCase
{
    public function testAppend()
    {
        $this->assertEquals(null, FileUtils::append(null, null));
        $this->assertEquals("", FileUtils::append("", ""));
        $this->assertEquals("foo", FileUtils::append("", "foo"));
        $this->assertEquals("bar", FileUtils::append("bar", ""));
        $this->assertEquals("bar/foo", FileUtils::append("bar", "foo"));
        $this->assertEquals("bar/foo", FileUtils::append("bar/", "foo"));
        $this->assertEquals("bar/foo", FileUtils::append("bar", "/foo"));
        $this->assertEquals("bar/foo", FileUtils::append("bar/", "/foo"));
    }

    public function testBasename()
    {
        $this->assertEquals("", FileUtils::basename(null, null));
        $this->assertEquals("passwd", FileUtils::basename("/etc/passwd"));
        $this->assertEquals("etc", FileUtils::basename("/etc/"));
        $this->assertEquals(".", FileUtils::basename("."));
        $this->assertEquals("", FileUtils::basename("/"));
        $this->assertEquals("Revision", FileUtils::basename("mheinzerling\\revision\\Revision"));
        $this->assertEquals("sudoers", FileUtils::basename("/etc/sudoers.d", ".d"));
        $this->assertEquals("file", FileUtils::basename("path/to/file.xml#xpointer(/Texture)", ".xml#xpointer(/Texture)"));
    }
}