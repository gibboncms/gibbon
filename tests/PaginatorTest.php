<?php

namespace GibbonCms\Gibbon\Test;

use GibbonCms\Gibbon\Support\Paginator;

class PaginatorTest extends TestCase
{
    public function setUp()
    {
        $this->paginator = new Paginator(
            ['brann', 'hodor', 'mountain', 'robb', 'jaime', 'cersei', 'sansa', 'arya', 'jon', 'aemon', 'sam',
                'oberyn', 'margeary', 'alerie', 'loras', 'stannis', 'melisandre', 'missandei', 'daenerys', 'tyrion',
                'tommen', 'ser pounce'],
            5
        );
    }

    /** @test */
    public function it_is_initializable()
    {
        $this->assertInstanceOf(Paginator::class, $this->paginator);
    }

    /** @test */
    public function it_calculates_a_page_count()
    {
        $this->assertEquals(5, $this->paginator->pageCount());
    }

    /** @test */
    public function it_gets_items_for_a_page()
    {
        $this->assertCount(5, $this->paginator->page(1));
        $this->assertCount(5, $this->paginator->page(3));
    }

    /** @test */
    public function it_gets_items_for_the_first_page()
    {
        $this->assertCount(5, $this->paginator->firstPage());
    }

    /** @test */
    public function it_gets_items_for_the_last_page()
    {
        $this->assertCount(2, $this->paginator->lastPage(1));
    }
}
