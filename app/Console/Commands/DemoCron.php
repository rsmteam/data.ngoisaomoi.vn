<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\User;
use App\Contact;


class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $contact = new Contact();
         // DB::table('items')->insert(['name'=>'hello new']);
       // $p =  User::SentEmailToAdmin();
        $p = $contact->SentEmailToAdmin();
        $this->info($p);
    }
}
