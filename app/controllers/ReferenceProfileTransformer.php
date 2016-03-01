<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class ReferenceProfileTransformer extends Fractal\TransformerAbstract
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
            'name1' => $user->profile['reference_name1'],
            'email1' => $user->profile['referrer_email1'],
            'phone1' => $user->profile['referrer_phone1'],
            'name2' => $user->profile['reference_name2'],
            'email2' => $user->profile['referrer_email2'],
            'phone2' => $user->profile['referrer_phone2'],
            'name3' => $user->profile['reference_name3'],
            'email3' => $user->profile['referrer_email3'],
            'phone3' => $user->profile['referrer_phone3'],
        ];
    }
}