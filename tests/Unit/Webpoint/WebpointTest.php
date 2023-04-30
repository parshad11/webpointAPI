<?php

namespace Tests\Unit\Contract;

use Tests\TestCase;
use App\Models\WebPointContact;

class WebpointTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testGetContract()
    {
        $searchTerm = '';
        $response = $this->get('/api/webpoint/get-contacts?search='.$searchTerm);

        $response
            ->assertStatus(200)
            ->assertSeeText('Contract has been fetched.')
            ->assertJsonStructure([
                'statusCode',
                'message',
                'data' => [
                    'current_page',
                    'data'=>[
                        '*' =>['id', 'full_name', 'email', 'phone'],
                    ],
                    'first_page_url',
                    'from',
                    'last_page',
                    'last_page_url',
                    'links'=>[
                        '*' =>['url','label','active']
                    ],
                    'next_page_url',
                    'path',
                    'per_page',
                    'prev_page_url',
                    'to',
                    'total',  
                ],  
            ]);
    }

    public function testAddContract()
    {

        $response = $this->post('/api/webpoint/add-contact',[
            "full_name" => "Ram Prakash",
            "email" => "rampraksah@gmail.com",
            "phone" => "+977-9876534265",
        ]);

        $response
            ->assertStatus(200)
            ->assertSeeText('Contract has been added.')
            ->assertJsonStructure([
                'statusCode', 'message', 'data' => [
                    'id', 'full_name', 'email', 'phone'
                    ]
                    
            ]);
    }

    public function testEditContract()
    {

        $response = $this->post('/api/webpoint/edit-contact',[
            "id" => encrypt(WebPointContact::select('id')->first()['id']),
            "full_name" => "Ram Prakash",
            "email" => "rampraksah@gmail.com",
            "phone" => "+977-9876534265",
        ]);

        $response
            ->assertStatus(200)
            ->assertSeeText('Contract has been edited.')
            ->assertJsonStructure([
                'statusCode', 'message', 'data' => [
                    'id', 'title', 'description', 'start_date', 'end_date'
                    ]
                    
            ]);
    }

    public function testDeleteContract()
    {

        $response = $this->delete('/api/webpoint/delete-contact',[
            "id" => encrypt(WebPointContact::select('id')->first()['id']),
        ]);

        $response
            ->assertStatus(200)
            ->assertSeeText('Contract has been deleted.')
            ->assertJsonStructure([
                'statusCode', 'message', 'data' => [
                    'id'
                    ]
                    
            ]);
    }
}
