<?php namespace GibbonCms\Gibbon\Support;

use League\CommonMark\CommonMarkConverter;

trait Markdown
{
    /**
    * @var \League\CommonMark\CommonMarkConverter
    */
    protected static $markdownParser;

    /**
     * Parse markdown to html
     * 
     * @param string $markdown
     * @return string
     */
    public static function parseMarkdown($markdown)
    {
        if (self::$markdownParser == null) {
            self::$markdownParser = new CommonMarkConverter;
        }

        return self::$markdownParser->convertToHtml($markdown);
    }
    
}
