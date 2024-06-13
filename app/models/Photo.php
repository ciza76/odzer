<?php

namespace Model;

defined('ROOTPATH') OR exit('Access Denied!');

/**
 * Photo class
 */
class Photo
{
	
	use Model;

	protected $table = 'photos p';
    protected $tableJoin = 'join categories c on p.category_id = c.id';
	protected $primaryKey = 'p.id';
	protected $loginUniqueColumn = 'p.id';
    protected $childOrderColumn = "p.id";

	protected $allowedColumns = [

		'p.user_id',
		'c.title',
		'c.image',
		'p.date_created',
		'p.date_updated',
	];

	/*****************************
	 * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_8_chars
		alpha_numeric_symbol
		alpha_numeric
		alpha_symbol
	 * 
	 ****************************/
	protected $onInsertValidationRules = [

		'c.title' => [
			'alpha_numeric_symbol',
			'required',
		]
	];

	protected $onUpdateValidationRules = [

		'c.title' => [
			'alpha_numeric_symbol',
			'required',
		]
	];

    public function insertUpdateMultiple($data, $categoryId = null)
    {
        $con = $this->connect();
        $con->beginTransaction();
        try {
            if ($categoryId === null) {
                $qC = sprintf("insert into categories (user_id, title, date_created) values ('%s', '%s', '%s')",
                    $data['user_id'], $data['title'], $data['date_created']);
                $stm = $con->prepare($qC);
                $check = $stm->execute();
                $categoryId = (int)$con->lastInsertId();
            } else {
                $qC = sprintf("update categories set title = '%s' where id=%d", $data['title'], $categoryId);
                $stm = $con->prepare($qC);
                $check = $stm->execute();
            }

            if ($check && $categoryId) {
                foreach ($data['image'] as $image) {
                    $qI = sprintf("insert into photos (category_id, user_id, image, date_created) values (%d, '%s', '%s', '%s')",
                        $categoryId, $data['user_id'], $image, $data['date_created']);
                    $stm = $con->prepare($qI);
                    $stm->execute();
                }
                $con->commit();
                return false;
            }
        } catch (\Throwable $t) {
            //skiped
        }
        $con->rollback();
        return false;
    }

    public function findAllForCategories()
    {
        $table = $this->table;
        if (property_exists($this, "tableJoin")) {
            $table = sprintf('%s %s', $this->table, $this->tableJoin);
        }
        if (property_exists($this, "childOrderColumn")) {
            $this->order_column = $this->childOrderColumn;
        }

        $query = "
            select * from $table
            INNER JOIN (
                SELECT category_id, MAX(id) AS max_id
                FROM photos
                GROUP BY category_id
            ) pm ON p.category_id = pm.category_id AND p.id = pm.max_id
            order by $this->order_column $this->order_type limit $this->limit offset $this->offset";

        return $this->query($query);
    }

    public function findAll()
    {
        $table = $this->table;
        if (property_exists($this, "tableJoin")) {
            $table = sprintf('%s %s', $this->table, $this->tableJoin);
        }
        if (property_exists($this, "childOrderColumn")) {
            $this->order_column = $this->childOrderColumn;
        }
        $query = "select p.* from $table order by $this->order_column $this->order_type limit $this->limit offset $this->offset";
        return $this->query($query);
    }

}