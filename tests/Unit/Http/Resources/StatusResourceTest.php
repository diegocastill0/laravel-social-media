<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_status_resources_must_have_the_necesary_fields()
    {
        $status = Status::factory()->create();

        $statusResource = StatusResource::make($status)->resolve(); 

        $this->assertEquals($status->id, $statusResource['id']);
        $this->assertEquals($status->body, $statusResource['body']);
        $this->assertEquals($status->user->name, $statusResource['user_name']);
        $this->assertEquals("https://aprendible.com/images/default-avatar.jpg", $statusResource['user_avatar']);
        $this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);    
        
        $this->assertEquals(
            false, 
            $statusResource['is_liked']
        ); 
        $this->assertEquals(
            0, 
            $statusResource['likes_count']
        );    
    }
}