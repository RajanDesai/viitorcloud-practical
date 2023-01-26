<?php

namespace App\Jobs;

use App\Models\TenantDbDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TenantDbJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $name = strtolower(strtok($this->user->name, ' '));
        $userName = 'tnt_'.$name;
        $dbName = 'db_'.$name;
        $password = \Str::random(8);

        DB::statement("CREATE USER '".$userName."'@'localhost' IDENTIFIED BY '".$password."'");
        DB::statement("CREATE database $dbName");
        DB::statement("GRANT ALL PRIVILEGES ON ".$dbName.".* To '".$userName."'@'localhost'");

        TenantDbDetail::create([
            'user_id' => $this->user->id,
            'db_name' => encrypt($dbName),
            'db_host' => 'localhost',
            'db_port' => 3306,
            'db_username' => encrypt($userName),
            'db_password' => encrypt($password),
        ]);

        changeDbConnection($dbName, $userName, $password);
        /* config(['database.connections.mysql' => [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => $dbName,
            'username'  => $userName,
            'password'  => $password,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'strict'    => false,
        ]]);
        DB::purge('mysql');
        DB::reconnect('mysql'); */

        DB::statement("CREATE TABLE `users` (
            `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
            `email` VARCHAR(255) COLLATE utf8_unicode_ci DEFAULT NULL,
            `password` VARCHAR(255) COLLATE utf8_unicode_ci NOT NULL,
            `created_at` TIMESTAMP NULL DEFAULT NULL,
            `updated_at` TIMESTAMP NULL DEFAULT NULL,
            `deleted_at` TIMESTAMP NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
          ) ENGINE=INNODB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
        ");
        $hashPassword = Hash::make('User@123');
        DB::table('users')->insert([
            ['name'=>'User 1', 'email'=> 'user1@mailinator.com', 'password' => $hashPassword],
            ['name'=>'User 2', 'email'=> 'user2@mailinator.com', 'password' => $hashPassword],
        ]);
    }
}
