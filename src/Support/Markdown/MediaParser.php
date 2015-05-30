<?php

namespace GibbonCms\Gibbon\Support\Markdown;

use League\CommonMark\ContextInterface;
use League\CommonMark\InlineParserContext;
use League\CommonMark\Inline\Element\Image;
use League\CommonMark\Inline\Element\Link;
use League\CommonMark\Inline\Parser\AbstractInlineParser;
use League\CommonMark\Util\LinkParserHelper;

class MediaParser extends AbstractInlineParser
{
    const MEDIA_IMAGE = 'image';
    const MEDIA_FILE = 'file';

    /**
     * @param  string $mediaRoot
     */
    public function __construct($mediaRoot)
    {
        $this->mediaRoot = $mediaRoot;
    }

    /**
     * @return array
     */
    public function getCharacters()
    {
        return ['$'];
    }

    /**
     * @param  League\CommonMark\ContextInterface $context
     * @param  League\CommonMark\InlineParserContext $inlineContext
     * @return bool
     */
    public function parse(ContextInterface $context, InlineParserContext $inlineContext)
    {
        $this->context = $context;
        $this->inlineContext = $inlineContext;

        $this->cursor = $inlineContext->getCursor();
        $originalState = $this->cursor->saveState();

        $this->cursor->advance();

        $toParse = $this->match();

        if ($toParse == null) {
            return $this->cancel();
        }

        $label = $this->getLabel();
        $url = $this->getUrl();

        if ($label == null || $url == null) {
            return $this->cancel();
        }

        if ($toParse == self::MEDIA_IMAGE) {
            $element = new Image($this->mediaRoot.'/'.$url, $label);
        }

        if ($toParse == self::MEDIA_FILE) {
            $element = new Link($this->mediaRoot.'/'.$url, $label);
        }

        if (!isset($element)) {
            return $this->cancel();
        }

        $this->inlineContext->getInlines()->add($element);

        return true;
    }

    /**
     * @return string|null
     */
    public function match()
    {
        if ($this->cursor->match('/^image/') != null) {
            return self::MEDIA_IMAGE;
        }

        if ($this->cursor->match('/^file/') != null) {
            return self::MEDIA_FILE;
        }

        return null;
    }

    /**
     * @return bool
     */
    protected function cancel()
    {
        $cursor->restoreState($originalState);
        
        return false;
    }

    /**
     * @return string|null
     */
    protected function getLabel()
    {
        return trim($this->cursor->match('/^\[(?:[^\\\\\[\]]|\\\\[\[\]]){0,750}\]/'), '[]');
    }

    /**
     * @return string|null
     */
    protected function getUrl()
    {
        return trim(LinkParserHelper::parseLinkDestination($this->cursor), '()');
    }
}
