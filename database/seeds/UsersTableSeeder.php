<?php

use App\User;
use App\Task;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(User::class, 5)->create()->each(function($u) {
            factory(Task::class, 3)->create()->each(function($t) use($u) {
                $user_id = $u->id;
                $t->user_id = $user_id;
                $t->save(); 
            });
        });
    }

}
