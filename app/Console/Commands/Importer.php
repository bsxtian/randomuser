<?php

namespace App\Console\Commands;

use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Console\Command;
use App\Services\CustomerService;


class Importer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will import random user from API.';

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
    public function handle(EntityManagerInterface $entityManager)
    {
        //
        $customer = new CustomerService($entityManager);

        $customer->store();

        echo 'wow';
    }
}
