<?php

namespace GibbonCms\Gibbon\Support\Markdown;

use League\CommonMark\CommonMarkConverter;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;

class Parser
{
    public function __construct($mediaRoot)
    {
        $environment = $this->initializeCommonMark($mediaRoot);

        $this->parser = new DocParser($environment);
        $this->htmlRenderer = new HtmlRenderer($environment);
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
        $html = $this->htmlRenderer->renderBlock($document);

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
