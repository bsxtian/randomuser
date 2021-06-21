<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use App\Transformers\CustomerTransformer;

class RandomUserController extends Controller
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function showAllCustomers()
    {
        $customers = $this->em->getRepository(Customer::class)->findAll();

        $transformer = new CustomerTransformer();
        return $transformer->transformAll($customers);
    }

    public function showCustomer($customerId)
    {
        $customer = $this->em->getRepository(Customer::class)->findOneBy(['id' => $customerId]);
        $transformer = new CustomerTransformer();
        return $transformer->transform($customer);

    }
}