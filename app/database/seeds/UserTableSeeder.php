<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        // DB::table('users')->truncate();

        $user = array(
            'dbgeral.strusuario' => 'usm4n',
            'dbgeral.strsenha' => Hash::make('admin'),
            'created_at' => DB::raw('NOW()'),
            'updated_at' => DB::raw('NOW()'),
        );

        // Comment the below to stop the seeder
        DB::table('dbgeral.tblusuario')->insert($user);
    }

}
