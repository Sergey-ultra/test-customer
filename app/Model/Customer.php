<?php


namespace App\Model;


use PDO;

class Customer
{
    private $db;

    public function __construct(){
        $this->db = DB::getConnection();
    }

    public function getCustomersWithBooks($customerIds, $minAge, $maxAge, $author)
    {
        $sql = "SELECT c.id as id, c.customer_name as name, count(c.customer_name) as count_book 
            FROM (SELECT * FROM customers";

        if (isset($customerIds) || isset($minAge) || isset($maxAge)) {
            $sql .= " WHERE";

            if (isset($customerIds)) {
                $inQuery = implode(',', array_fill(0, count($customerIds), '?'));
                $sql .= " `id` IN($inQuery)";

                if (isset($minAge) || isset($maxAge)) {
                    $sql .= " AND";
                }
            }
            if (isset($minAge)) {
                $sql .= "  `date` < :min_birth";
                if (isset($maxAge)) {
                    $sql .= " AND";
                }
            }
            if (isset($maxAge)) {
                $sql .= " `date` > :max_birth";

            }
        }


        $sql .= ") c 
            JOIN book_customer bc 
            ON bc.customer_id=c.id
            JOIN books b 
            ON b.id = bc.book_id
            JOIN authors a 
            ON a.id = b.author_id";

        if (isset($author)) {
            $sql .=  " WHERE a.author_name LIKE :author";
        }

        $sql .= "
        GROUP BY c.id, c.customer_name
        ;";



        $this->db->prepare($sql);

        if (isset($customerIds)) {
            foreach ($customerIds as $key => $id) {
                $this->db->bind(($key + 1), $id);
            }
        }
        if (isset($minAge)) {
            $time =  date("Y-m-d", strtotime("-$minAge years"));
            $this->db->bind(":min_birth", $time, PDO::PARAM_STR);
        }
        if (isset($maxAge)) {
            $time = date("Y-m-d", strtotime("-$maxAge years"));
            $this->db->bind(":max_birth", $time, PDO::PARAM_STR);
        }
        if (isset($author)) {
            $this->db->bind(":author", "%$author%");
        }

        return $this->db->resultSet();
    }

    public function show($id)
    {
        $this->db->prepare("SELECT * FROM customers WHERE id = :id");
        $this->db->bind(":id", $id);
        return $this->db->single();

    }
}