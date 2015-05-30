<?php

namespace GibbonCms\Gibbon\Support\Markdown;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;

class Parser
{
    /**
     * @var \League\CommonMark\DocParser
     */
    protected $parser;

    /**
     * @var \League\CommonMark\HtmlRenderer
     */
    protected $renderer;

    /**
     * @param  string $mediaRoot
     */
    public function __construct($mediaRoot)
    {
        $environment = $this->initializeCommonMark($mediaRoot);

        $this->parser = new DocParser($environment);
        $this->renderer = new HtmlRenderer($environment);
    }

    /**
     * Parse markdown to html
     * 
     * @param  string $markdown
     * @return string
     */
    public function parse($markdown)
    {
        $document = $this->parser->parse($markdown);
        $html = $this->renderer->renderBlock($document);

        return $html;
    }

    /**
     * Create a new instance of commonMark with some custom parser rules
     * 
     * @param  string $mediaRoot
     * @return \League\CommonMark\Environment
     */
    protected function initializeCommonMark($mediaRoot)
    {
        $environment = Environment::createCommonMarkEnvironment();
        $environment->addInlineParser(new MediaParser($mediaRoot));

        return $environment;
    }
}
