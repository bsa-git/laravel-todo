<?php

use App\User;
use App\Task;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MyTest extends TestCase
{
    public function test_i_can_call_url()
    {
        $response = $this->call('GET', '/photo');
        $this->assertContains('Action-GET(photo.index)', $response->getContent());
        
        $response = $this->call('GET', '/photo/create');
        $this->assertContains('Action-GET(photo.create)', $response->getContent());
        
        $response = $this->call('POST', '/photo');
        $this->assertContains('Action-POST(photo.store)', $response->getContent());
        
        $response = $this->call('GET', '/photo/1');
        $this->assertContains('Action-GET(photo.show)', $response->getContent());
        
        $response = $this->call('GET', '/photo/1/edit');
        $this->assertContains('Action-GET(photo.edit)', $response->getContent());
        
        $response = $this->call('PUT', '/photo/1');
        $this->assertContains('Action-PUT(photo.update)', $response->getContent());
        
        $response = $this->call('DELETE', '/photo/1');
        $this->assertContains('Action-DELETE(photo.destroy)', $response->getContent());
    }
    
     public function test_i_am_redirect_to_login_if_i_try_to_view_db_lists_without_logging_in()
    {
        $this->visit('/test/db')->see('Login');
    }
    
    public function test_action_db()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $userOne->tasks()->save($taskOne = factory(Task::class)->create());
        $userTwo->tasks()->save($taskTwo = factory(Task::class)->create());

        $this->actingAs($userOne)
             ->visit('/test/db')
             ->see('DataBase operations');
    }
    
    public function test_action_encrypt()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $this->actingAs($userOne)
             ->visit('/test/encrypt')
             ->see('Secret information has been added for all users');
    }
    
    public function test_action_mail_from_template()
    {
        $userOne = factory(User::class)->create();

        $this->actingAs($userOne)
             ->visit('/test/mail_from_template')
             ->see('Test send message from template');
    }
    
    public function test_action_mailgun()
    {
        $userOne = factory(User::class)->create();

        $this->actingAs($userOne)
             ->visit('/test/mailgun')
             ->see('Test send message through Mailgun');
    }
    
    public function test_action_addtask()
    {
        $this->expectsEvents(App\Events\AddTask::class);
        
        $userOne = factory(User::class)->create();

        $this->actingAs($userOne)
             ->visit('/test/addtask/Add%20Task')
             ->see('Event to add a task to the user created');
    }
    
    public function test_action_job()
    {
        
//        $this->expectsJobs(App\Jobs\SendReminderEmail::class);
        
        $userOne = factory(User::class)->create();

        $this->actingAs($userOne)
             ->visit('/test/job')
             ->see('Test job - to send a message');
    }
}
