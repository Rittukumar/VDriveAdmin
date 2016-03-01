<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class PersonalInfoTransformer extends Fractal\TransformerAbstract
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
            'user_id' => $user->profile['id'],
            'firstname' => $user->profile['firstname'],
            'lastname' => $user->profile['lastname'],
            'email' => $user->email,
            'phone' => $user->profile['phone'],
            'country' => $user->profile['country'],
            'state' => $user->profile['state'],
            'city' => $user->profile['city'],
            'streetAddress' => $user->profile['street_address'],
            'zip' => $user->profile['zip'],
            'education1' => $user->profile['education1'],
            'education2' => $user->profile['education2'],
            'education3' => $user->profile['education3'],
            'skills' => $user->profile['skills'],
            'language1' => $user->profile['language1'],
            'language2' => $user->profile['language2'],
            'language3' => $user->profile['language3'],
            'profession' => $user->profile['profession'],
            'designation1' => $user->profile['designation1'],
            'name_organization1' => $user->profile['name_organization1'],
            'work_experience1' => $user->profile['work_experience1'],
            'other_info1' => $user->profile['other_info1'],
        ];
    }
}