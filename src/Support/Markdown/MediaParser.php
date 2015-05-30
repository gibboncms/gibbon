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
    /**
     * @var string
     */
    protected $mediaRoot;

    /**
     * @var \League\CommonMark\ContextInterface
     */
    protected $context;

    /**
     * @var \League\CommonMark\InlineParserContext
     */
    protected $inlineContext;

    /**
     * @var \League\CommonMark\Cursor
     */
    protected $cursor;

    /**
     * @var \League\CommonMark\CursorState
     */
    protected $originalState;

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
     * @param  \League\CommonMark\ContextInterface $context
     * @param  \League\CommonMark\InlineParserContext $inlineContext
     * @return bool
     */
    public function parse(ContextInterface $context, InlineParserContext $inlineContext)
    {
        $this->context = $context;
        $this->inlineContext = $inlineContext;

        $this->cursor = $inlineContext->getCursor();
        $this->originalState = $this->cursor->saveState();

        $this->cursor->advance();

        $mediaType = $this->cursor->match('/^image/') ?: $this->cursor->match('/^file/');

        if ($mediaType === null) {
            return $this->cancel();
        }

        $parts = $this->getInlineParts();

        if (empty($parts)) {
            return $this->cancel();
        }

        if ($mediaType === 'image') {
            $element = new Image($this->mediaRoot.'/'.$parts['url'], $parts['label']);
        }

        if ($mediaType === 'file') {
            $element = new Link($this->mediaRoot.'/'.$parts['url'], $parts['label']);
        }

        if (!isset($element)) {
            return $this->cancel();
        }

        $this->inlineContext->getInlines()->add($element);

        return true;
    }

    /**
     * @return array|null
     */
    protected function getInlineParts()
    {
        $label = trim($this->cursor->match('/^\[(?:[^\\\\\[\]]|\\\\[\[\]]){0,750}\]/'), '[]');
        $url   = trim(LinkParserHelper::parseLinkDestination($this->cursor), '()');

        return ($label && $url) ? compact('label', 'url') : null;
    }

    /**
     * @return bool
     */
    protected function cancel()
    {
        $this->cursor->restoreState($this->originalState);
        
        return false;
    }
}
