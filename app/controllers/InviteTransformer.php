<?php
use League\Fractal;

class InviteTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param Invite $invite
     * @return array
     * @internal param User|UserProfile $user
     */
    public function transform(Invite $invite)
    {
        return [
            'id'    => (int) $invite['id'],
            'code' => $invite['code'],
            'name' => $invite['name'],
            'surname' => $invite['surname'],
            'email' => $invite['email'],
            'referrer_name' => $invite['referrer_name'],
            'referrer_email' => $invite['referrer_email'],
            'claimed_at' => $invite['claimed_at'],
            'submit_date' => $invite['created_at'],
            'reminder' => $invite['reminder'],
            'status' => isset($invite['user']['email'])?'Registered':'Pending'
        ];
    }
}