<?php


class EvezplaceListingSubcategoriesTableSeeder extends Seeder {

	public function run()
	{
		$FB = ['Restaurants','Bars','Night Clubs/Lounges','Home Delivery','Fine Dining','Cafes','Beer Clubs/Breweries'];
		$TravelPackages = ['Spiritual Travel','Business Travel','Budget Tours','Honeymoon Tours','Education Tours','Nature Tours','Adventure Travel','Others'];
		$InterestsHobbies = ['Cycling','Trekking','Karaoke','Musicians','Singers','Biking','Dance Forms','Running','Pets','NGOs','Gardening'];
		$Care = ['Old Age Homes','Hospice','Orphanage','Adoption Homes','Surrogacy','Babysitting','Nurseries','Day Care Schools'];
		$Home = ['Furniture','Home Decor','Accessories','Appliances','Utilities','Bathware','Food','Others'];
		$EventsExhibitions = ['Art Shows','Theatre Festivals','Announcements','Film Screenings','Exhibitions','Launches','Promotions','Others'];
		$Entertainment = ['DVD Rentals','Movie Screenings','Plays','Book Shops','Book Launches','Concerts','Stand-up Acts','Karaoke Classes'];
		$PreOwned = ['Cars/2 wheelers','Bags','Furniture','Designer Wear','Home Appliances','Electronics','Phones/Tabs','Computers','Others'];
		$RealEstate = ['Commercial - Buy','Commercial - Sell','Commercial - Rent/Lease','Residential - Buy','Residential - Sell','Residential - Rent/Lease','Land','Others'];
		$Automobiles = ['Cars','Motor Bikes','Scooters','Cycles','Auto-Rickshaws'];
		$Matrimonial = ['Re-marriages','Single Mothers','Senior Citizen','Others'];
		$NewBrands = ['Apparel','Cosmetics','Foot Wear','Accessories','Sports Wear','Jewellery','Watches','Anti-aging','Stationery','Medicine & Nutrition','Supplements','Baby Products','Mom-to-be','Electronics','Phones/Tabs','Computers','Others'];
		
		foreach(range(17, 28) as $index)
		{
			if($index == 17)
			{
				foreach ($FB as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 18)
			{
				foreach ($TravelPackages as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 19)
			{
				foreach ($InterestsHobbies as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 20)
			{
				foreach ($Care as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 21)
			{
				foreach ($Home as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 22)
			{
				foreach ($EventsExhibitions as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 23)
			{
				foreach ($Entertainment as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 24)
			{
				foreach ($PreOwned as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 25)
			{
				foreach ($RealEstate as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 26)
			{
				foreach ($Automobiles as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 27)
			{
				foreach ($Matrimonial as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 28)
			{
				foreach ($NewBrands as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}
		}

	}

}