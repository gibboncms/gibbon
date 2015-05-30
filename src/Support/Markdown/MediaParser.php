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

        return $this->parseMediaType();
    }

    /**
     * @return mixed
     */
    protected function parseMediaType()
    {
        $mediaType = $this->cursor->match('/^image/') ?: $this->cursor->match('/^file/');

        if ($mediaType === null) {
            return $this->cancel();
        }

        return $this->getElementParts($mediaType);
    }

    /**
     * @param  string $mediaType
     * @return mixed
     */
    protected function getElementParts($mediaType)
    {
        $label = trim($this->cursor->match('/^\[(?:[^\\\\\[\]]|\\\\[\[\]]){0,750}\]/'), '[]');
        $url   = trim(LinkParserHelper::parseLinkDestination($this->cursor), '()');

        if ($label === null || $url === null) {
            return $this->cancel();
        }

        return $this->getElement($mediaType, $label, $url);
    }

    /**
     * @param  string $mediaType
     * @param  string $label
     * @param  string $url
     * @return mixed
     */
    protected function getElement($mediaType, $label, $url)
    {
        if ($mediaType === 'image') {
            $element = new Image($this->mediaRoot.'/'.$url, $label);
        }

        if ($mediaType === 'file') {
            $element = new Link($this->mediaRoot.'/'.$url, $label);
        }

        if (!isset($element)) {
            return $this->cancel();
        }

        return $this->addElement($element);
    }

    /**
     * @param  \League\CommonMark\Inline\Element\AbstractWebResource $element
     * @return bool
     */
    protected function addElement($element)
    {
        $this->inlineContext->getInlines()->add($element);
        
        return true;
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
