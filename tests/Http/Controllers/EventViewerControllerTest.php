<?php

namespace Spacebib\EventViewer\Tests\Http\Controllers;

use Spacebib\EventViewer\EventViewer;
use Spacebib\EventViewer\Tests\TestCase;

class EventViewerControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        EventViewer::auth(function () {
            return true;
        });
    }

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
