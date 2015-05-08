<?php

namespace GibbonCms\Gibbon\Support;

use League\CommonMark\CommonMarkConverter;
use Symfony\Component\Yaml\Yaml;

trait FactoryHelpers
{
    /*
    * @var \League\CommonMark\CommonMarkConverter
    */
    protected static $markdownParser;

    /*
    * @var \Symfony\Component\Yaml\Yaml
    */
    protected static $yamlParser;

    /**
     * Create a new entity instance and return it filled with attributes
     * 
     * @param array $attributes
     * @return \GibbonCms\Gibbon\Entity
     */
    protected function createAndFill(array $attributes)
    {
        $entityClass = static::makes();
        $entity = new $entityClass;

        foreach($attributes as $attribute => $value) {
            $entity->$attribute = $value;
        }

        return $entity;
    }
    
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
     * Split data by the separator
     * 
     * @param string $data
     * @param array $parts
     * @return array
     */
    protected function splitData($data, $parts)
    {
        $array = explode(
            $this->getDataSeparator(),
            str_replace("\n\r", "\n", $data),
            count($parts)
        );

        $i = 0;

        return array_reduce($array, function($carry, $part) use ($i) {
            $carry[$parts[$i]] = $part;
            return $carry;
        }, []);
    }

    /**
     * The data seperator string in raw entities
     * 
     * @return string
     */
    protected function getDataSeparator()
    {
        return "\n\n---\n\n";
    }

    /**
     * Return the instance of the commonmark converter
     * 
     * @return \League\CommonMark\CommonMarkConverter
     */
    protected static function getMarkdownParser()
    {
        if (self::$markdownParser == null) {
            self::$markdownParser = new CommonMarkConverter;
        }

        return self::$markdownParser;
    }

    /**
     * Return the instance of the yaml parser
     * 
     * @return \League\CommonMark\CommonMarkConverter
     */
    protected static function yamlParser()
    {
        if (self::$yamlParser == null) {
            self::$yamlParser = new Yaml;
        }

        return self::$yamlParser;
    }
}
