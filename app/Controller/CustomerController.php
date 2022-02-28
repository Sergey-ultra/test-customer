<?php

namespace App\Controller;

use App\Model\Customer;


class CustomerController
{

    private $customer;

    public function __construct(){
        $this->customer = new Customer;
    }

    public function index()
    {
        $customerIds = !empty($_GET['customer_id'])
            ? array_map(function ($el) {
                return (int)$el;
            }, $_GET['customer_id'])
            : NULL;

        $minAge = isset($_GET['min_age']) ? (int) $_GET['min_age'] : NULL;
        $maxAge = isset($_GET['max_age']) ? (int) $_GET['max_age'] : NULL;
        $author = $_GET['author'] ?? NULL;

        $customers = $this->customer->getCustomersWithBooks($customerIds, $minAge, $maxAge, $author);
        render('customers', compact('customers'));
    }

    public function view($id)
    {
        $customer = $this->customer->show((int)$id);
        render('customer', compact('customer'));
    }
}