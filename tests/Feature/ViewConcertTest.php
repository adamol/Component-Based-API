<?php

use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Request;

require __DIR__.'/../DatabaseTestCase.php';

//class ViewConcertTest extends PHPUnit\Framework\TestCase
class ViewConcertTest extends DatabaseTestCase
{
//    public function setUp()
//    {
//        parent::setUp();
//
//        $this->app()['db']->exec("
//            CREATE TABLE concerts (
//                id INTEGER PRIMARY KEY,
//                title VARCHAR(50) NOT NULL,
//                subtitle VARCHAR(50) NOT NULL,
//                date timestamp,
//                ticket_price INT NOT NULL,
//                venue VARCHAR(50) NOT NULL,
//                venue_address VARCHAR(100) NOT NULL,
//                city VARCHAR(100) NOT NULL,
//                state VARCHAR(2) NOT NULL,
//                zip VARCHAR(5) NOT NULL,
//                additional_information VARCHAR(100) NOT NULL
//            );
//        ");
//    }

    public function tearDown()
    {
        parent::tearDown();

        $this->app()['db']->exec("DROP TABLE concerts");
    }

    /** @test */
    function users_can_view_a_concert()
    {
        $concert = $this->app()['repositories.concert']->create([
            'title' => 'The Red Chord',
            'subtitle' => 'with Animosity and Lethargy',
            'date' => Carbon::parse('December 13, 2016 8:00pm'),
            'ticket_price' => 3250,
            'venue' => 'The Mosh Pit',
            'venue_address' => '123 Example Lane',
            'city' => 'Fooville',
            'state' => 'ON',
            'zip' => '17916',
            'additional_information' => 'For tickets, call (555) 555-5555'
        ]);

        $response = $this->request("concerts/{$concert->id}", 'GET');
        $response = json_decode($response->getContent());

        $this->assertEquals('The Red Chord', $response->title);
        $this->assertEquals('with Animosity and Lethargy', $response->subtitle);
        $this->assertEquals('2016-12-13 20:00:00', $response->date);
        $this->assertEquals('$32.50', $response->ticket_price);
        $this->assertEquals('The Mosh Pit', $response->venue);
        $this->assertEquals('123 Example Lane', $response->venue_address);
        $this->assertEquals('Fooville', $response->city);
        $this->assertEquals('ON', $response->state);
        $this->assertEquals('17916', $response->zip);
        $this->assertEquals('For tickets, call (555) 555-5555', $response->additional_information);
    }

    protected function app()
    {
        return App\Framework\DependencyInjection\Container::getInstance();
    }

    protected function request($url, $method)
    {
        $request = Request::create($url, $method);

        $response = $this->app()['kernel']->handle($request);

        return $response;
    }
}