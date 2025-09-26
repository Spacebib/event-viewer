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

    public function test_visit_index_route(): void
    {
        $this->withoutMix();
        $response = $this->get(route('event-viewer.index'));
        $response->assertStatus(200);

        $response = $this->get(route('event-viewer.index', 'dashboard'));
        $response->assertStatus(200);
    }
}
