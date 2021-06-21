<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

use App\Entities\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Illuminate\Http\Request;

class CustomerService
{

    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getRandomUser()
    {
        $response = Http::get('https://randomuser.me/api/?results=100&nat=au');
        
        $data = $response->body();
        $customer = json_decode($data);
        return $customer->results;

    }

    public function store()
    {

        $datas = $this->getRandomUser();

        foreach($datas as $data){

            $exist = $this->em->getRepository(Customer::class)->findOneBy(['email' => $data->email]);

            if($exist){
                $exist->setLastname($data->name->last);
                $exist->setFirstname($data->name->first);
                $exist->setEmail($data->email);
                $exist->setUsername($data->login->username);
                $exist->setPassword(md5($data->login->password));
                $exist->setGender($data->gender);
                $exist->setCountry($data->location->country);
                $exist->setCity($data->location->city);
                $exist->setPhone($data->phone);
            }else{
                $customer = new Customer;

                $customer->setLastname($data->name->last);
                $customer->setFirstname($data->name->first);
                $customer->setEmail($data->email);
                $customer->setUsername($data->login->username);
                $customer->setPassword(md5($data->login->password));
                $customer->setGender($data->gender);
                $customer->setCountry($data->location->country);
                $customer->setCity($data->location->city);
                $customer->setPhone($data->phone);

                $this->em->persist($customer);
            }

            
            $this->em->flush();
        }

        return response()->json(['ok' => true], 201);
    }
}