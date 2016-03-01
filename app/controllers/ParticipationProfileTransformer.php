<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class ParticipationProfileTransformer extends Fractal\TransformerAbstract
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
            'doYouHavePhysicalStore' => (boolean) $user->profile['have_physical_online_store'],
            'doYouWantToOpenStore' => (boolean) $user->profile['want_evezown_store'],
            'storeFrontOnly' => (boolean) $user->profile['store_without_ecommerce'],
            'storeWithPayment' => (boolean) $user->profile['store_with_payment_gateway'],
            'needLogistics' => (boolean) $user->profile['logistics_coordination_assistance'],
            'requirePostSalesSupport' => (boolean) $user->profile['post_sales_support'],
            'likeSurvey' => (boolean) $user->profile['need_analytics'],
        ];
    }
}