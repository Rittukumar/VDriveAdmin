<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class OtherServicesTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'    => (int) $user['id'],
            'need_wopportunity_listing' => $user->profile['need_wopportunity_listing'],
            'need_resume_upload' => $user->profile['need_resume_upload'],
            'full_time_job' => $user->profile['full_time_job'],
            'part_time_job' => $user->profile['part_time_job'],
            'flexi_job' => $user->profile['flexi_job'],
            'short_assignment' => $user->profile['short_assignment'],
            'freelancing_job' => $user->profile['freelancing_job'],
            'interested_industry_sector' => $user->profile['interested_industry_sector'],
            'hire_through_evezown' => $user->profile['hire_through_evezown'],
        ];
    }
}