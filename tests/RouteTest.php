<?php

namespace Spacebib\EventViewer\Tests;

class RouteTest extends TestCase
{
    /** @test */
    public function visit_index_route()
    {
        $response = $this->get(route('event-viewer.index'));
        $response->assertStatus(200);
    }

    /** @test */
    public function visit_show_route()
    {
        $response = $this->get(route('event-viewer.show', random_bytes(10)));
        $response->assertNotFound();
    }
}
