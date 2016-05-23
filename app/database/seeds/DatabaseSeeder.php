<?php

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 // $this->cleanDatabase();

		Eloquent::unguard();

		$this->call('RoleTableSeeder');

		$this->call('PermissionsTableSeeder');

		$this->call('DobTableSeeder');

		$this->call('UserTableSeeder');

		$this->call('PostTypeTableSeeder');

		$this->call('EvezownSectionTableSeeder');

		$this->call('CategoryTableSeeder');

		$this->call('SubCategoryTableSeeder');

		$this->call('VisibilityTableSeeder');

        $this->call('EvezplaceProductsTableSeeder');

        $this->call('EvezplaceProductSubcategoriesTableSeeder');

        $this->call('ServicesCategoriesTableSeeder');

        $this->call('ServiceSubCategoriesTableSeeder');

        $this->call('EvezplaceListingTableSeeder');

        $this->call('EvezplaceListingSubcategoriesTableSeeder');

        $this->call('ListingTypeTableSeeder');

        $this->call('ProductPlusServiceTableSeeder');

        $this->call('ProductPlusServiceSubTableSeeder');

        $this->call('StoreSubscriptionTypeTableSeeder');

        $this->call('ReccoSubscriptionsTableSeeder');
        
        $this->call('NotSpecifiedTableSeeder');
        
        $this->call('NotSpecifiedSubcatTableSeeder');
        
        $this->call('StoreStatusEnumTableSeeder');
        
        $this->call('OrderStatusEnumTableSeeder');
       
        $this->call('ImageTableAvatarImageSeeder');

        $this->call('screensTableSeeder');

        $this->call('PaymentModeTableSeeder');
        
        $this->call('StoreStatusEnumTableSeederAdditions');

        $this->call('AdminConfigurationTableSeeder');
       // -- Following Seeder are not required. This is for testing purpose. -- 
       // BlogTableSeeder
       // BrandTableSeeder
       // CirclesTableSeeder
       // EventsTableSeeder
       // FavoritesTableSeeder
       // FriendsTableSeeder
       // ImagesTableSeeder	
       // ListingsTableSeeder
       // PostCommentTableSeeder
       // PostGradeTableSeeder
       // PostRewoiceTableSeeder
       // PostsTableSeeder
       // ProductsTableSeeder
       // StoresTableSeeder
 	}

}
