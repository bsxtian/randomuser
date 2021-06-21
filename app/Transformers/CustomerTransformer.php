<?php

namespace App\Transformers;

use App\Entities\Customer;

class CustomerTransformer
{
   
   public function transform(Customer $customer)
   {
       return [
           'fullname' => $customer->getFirstname()  .' ' . $customer->getLastname(),
           'email' => $customer->getEmail(),
           'username' => $customer->getUsername(),
           'gender' => $customer->getGender(),
           'country' => $customer->getCountry(),
           'city' => $customer->getCity(),
           'phone' => $customer->getPhone(),
       ];
   }

   public function transformAll(array $customers) {
      return array_map(
         function ($customer) {
           return [
            'fullname' => $customer->getFirstname()  .' ' . $customer->getLastname(),
            'email' => $customer->getEmail(),
            'country' => $customer->getCountry(),
           ];
         }, $customers
      );
   }

}