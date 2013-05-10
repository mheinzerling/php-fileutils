<?php
namespace mheinzerling\commons;


class FileUtils
{
    const WIN = "\\";
    const NS = "\\";
    const UNIX = "/";

    /**
     * @param $separator String FileUtils::WIN,FileUtils::NS,FileUtils::UNIX
     */
    public static function to($path, $separator)
    {
        return str_replace(array(self::WIN, self::UNIX), $separator, $path);
    }

    /**
     * @param $separator String FileUtils::WIN,FileUtils::NS,FileUtils::UNIX
     */
    public static function append($path, $sub, $separator = self::UNIX)
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

    public static function createFile($file, $content)
    {
        $dir = dirname($file);
        if (!file_exists($dir)) mkdir(dirname($file), 0777, true);
        file_put_contents($file, $content);
    }

    /**
     * Will find the basename also of windows paths/name spaces on linux. Suffix is php4 behaviour and removed first.
     *
     * @param $path
     */
    public static function basename($path, $suffix = null)
    {
        if ($suffix != null && StringUtils::endsWith($path, $suffix)) {
            $path = substr($path, 0, -strlen($suffix));
        }
        $path = trim($path, "\\/");
        $segments = preg_split("@[\\\\/]@", $path);
        return end($segments);
    }
}