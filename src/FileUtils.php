<?php
declare(strict_types = 1);
namespace mheinzerling\commons;


class FileUtils
{
    public static function to(string $path, Separator $separator): string
    {
        return str_replace([Separator::WIN, Separator::UNIX], $separator->value(), $path);
    }

    public static function append(string $path = null, string $sub = null, Separator $separator = null):?string
    {
        if (StringUtils::isBlank($path)) return $sub;
        if (StringUtils::isBlank($sub)) return $path;
        if ($separator == null) $separator = Separator::UNIX();
        $lastChar = $path[strlen($path) - 1];
        $pathHasSeparator = $lastChar == Separator::UNIX || $lastChar == Separator::WIN;
        $firstChar = $sub[0];
        $subHasSeparator = $firstChar == Separator::UNIX || $firstChar == Separator::WIN;
        if (!$pathHasSeparator && !$subHasSeparator) $path .= $separator->value();
        if ($pathHasSeparator && $subHasSeparator) $sub = substr($sub, 1);
        return $path . $sub;
    }

    public static function createFile(string $file, string $content, int $mode = 0640): int
    {
        if (!file_exists(dirname($file))) mkdir(dirname($file), $mode, true);
        return file_put_contents($file, $content);
    }

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