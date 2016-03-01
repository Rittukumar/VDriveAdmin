<?php


class SubCategoryTableSeeder extends Seeder {

	public function run()
	{
		$HealthWellnessFitness = ['Gym & sports','Fitness Supplements','Health Monitoring','Fitness Apparel','Mental fitness and therapy','Yoga','Spirituality','Alternative medicines','Allopathy','Preventive health','Pregnancy','Menopause','Vastu','Feng Shui','Disease management','Weight management'];
		$FoodNutrition = ['Organic Food - farm produce','Sweets & Condiments','Grocery & Staples','Bakery confectionary','Ready to Eat food','Low Cal foods/diet foods','Supplements & super foods','Sugar free/special food','Imported food & Gourmet','Home made products','Beverages','Baby foods','Others'];
		$BeautyFashion = ['Skincare/anti aging','Colour Cosmetics','Hair care & Styling','Skin care & acne','Apparel','Body care','Jewellery','Watches','Accessories'];
		$EducationCareParenting = ['Childrens books','Eldery care','Home Care','Pet care','Skills building','Games & Toys','Safety and Security','Baby & Mom clothing','Child care','Special children','Hobbies','Others'];
		$Lifestyle = ['Gifts & Hampers','Flowers & plants','Eco-friendly & handmade','Waste Management','Gadgets & Electronics','Applications and software','Fine Arts & crafts','Movies','Music','Literature & book reviews','Photography','Travel & Leisure','Home decor & Interiors','Gardening','Events and festivals'];

		foreach(range(1, 5) as $index)
		{
			if($index == 1)
			{
				foreach ($HealthWellnessFitness as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 2)
			{
				foreach ($FoodNutrition as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 3)
			{
				foreach ($BeautyFashion as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 4)
			{
				foreach ($EducationCareParenting as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 5)
			{
				foreach ($Lifestyle as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}
		}
	}

}