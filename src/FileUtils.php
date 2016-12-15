<?php
declare(strict_types = 1);
namespace mheinzerling\commons;


class FileUtils
{
    const WIN = "\\";
    const NS = "\\";
    const UNIX = "/";

    /**
     * @param string $path
     * @param $separator String FileUtils::WIN,FileUtils::NS,FileUtils::UNIX
     * @return string
     */
    public static function to(string $path, string $separator): string
    {
        return str_replace([self::WIN, self::UNIX], $separator, $path);
    }

    /**
     * @param string $path
     * @param string $sub
     * @param $separator String FileUtils::WIN,FileUtils::NS,FileUtils::UNIX
     * @return string|null
     */
    public static function append(string $path = null, string $sub = null, $separator = self::UNIX):?string
    {
        if (StringUtils::isBlank($path)) return $sub;
        if (StringUtils::isBlank($sub)) return $path;
        $lastChar = $path[strlen($path) - 1];
        $pathHasSeparator = $lastChar == self::UNIX || $lastChar == self::WIN;
        $firstChar = $sub[0];
        $subHasSeparator = $firstChar == self::UNIX || $firstChar == self::WIN;
        if (!$pathHasSeparator && !$subHasSeparator) $path .= $separator;
        if ($pathHasSeparator && $subHasSeparator) $sub = substr($sub, 1);
        return $path . $sub;
    }

    public static function createFile(string $file, string $content): int
    {
        $dir = dirname($file);
        if (!file_exists($dir)) mkdir(dirname($file), 0777, true);
        return file_put_contents($file, $content);
    }

    /**
     * Will find the basename also of windows paths/name spaces on linux. Suffix is php4 behaviour and removed first.
     *
     * @param string $path
     * @param string $suffix
     * @return string
     */
    public static function basename(string $path = null, string $suffix = null): string
    {
        if ($path == null) return "";
        if ($suffix != null && StringUtils::endsWith($path, $suffix)) {
            $path = substr($path, 0, -strlen($suffix));
        }
        $path = trim($path, "\\/");
        $segments = preg_split("@[\\\\/]@", $path);
        return end($segments);
    }
}