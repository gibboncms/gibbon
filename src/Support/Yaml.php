<?php namespace GibbonCms\Gibbon\Support;

use Symfony\Component\Yaml\Yaml as YamlParser;

trait Yaml
{
    /*
    * @var \Symfony\Component\Yaml\Yaml
    */
    protected static $yamlParser;

    /**
     * Transform an associative array to yaml.
     * Not using symfony's yaml dumper for full control over the format.
     * 
     * @param array $array
     * @return string
     */
    protected function dumpToSimpleYaml($array)
    {
        $parts = [];

        foreach ($array as $key => $value) {
            $parts[] = "$key: $value";
        }

        $yaml = implode("\n", $parts);

        return $yaml;
    }

    /**
     * Parse yaml to an array
     * 
     * @param string $yaml
     * @return array
     */
    public static function parseYaml($yaml)
    {
        if (self::$yamlParser == null) {
            self::$yamlParser = new YamlParser;
        }

        return self::$yamlParser->parse($yaml);
    }
}
