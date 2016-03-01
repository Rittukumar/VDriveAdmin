<?php

use League\Fractal;
/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 02/12/15
 * Time: 4:16 PM
 */
class StoreGradeTransformer extends Fractal\TransformerAbstract
{
    public function transform(StoreGrade $storeGrade)
    {
        return [
            'id'    => (int) $storeGrade['id'],
            'grade_id'    => (int) $storeGrade->grade->id,
            'grade'    => $storeGrade->grade,
            'grader'    => $storeGrade->grader
        ];
    }
}