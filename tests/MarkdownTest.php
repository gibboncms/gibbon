<?php

namespace GibbonCms\Gibbon\Test;

use GibbonCms\Gibbon\Support\Markdown\Parser;

class MarkdownTest extends TestCase
{
    public function setUp()
    {
        $this->markdown = new Parser('/media');
        $this->data = file_get_contents($this->fixtures.'/markdown/file.md');
    }

    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(Parser::class, $this->markdown);
    }

    /** @test */
    public function it_does_simple_parsing()
    {
        $parsed = $this->markdown->parse($this->data);

        $this->assertContains('<h1>Hello world</h1>', $parsed);
        $this->assertContains('<p>I\'m a markdown file.</p>', $parsed);
    }

    /** @test */
    public function it_adds_file_links()
    {
        $parsed = $this->markdown->parse($this->data);
        
        $this->assertContains('<a href="/media/file.pdf">Linked file</a>', $parsed);
    }

    /** @test */
    public function it_adds_media_images()
    {
        $parsed = $this->markdown->parse($this->data);
        
        $this->assertContains('<img src="/media/image.jpg" alt="Media image" />', $parsed);
    }
}
