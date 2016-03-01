<?php


class EvezplaceProductSubcategoriesTableSeeder extends Seeder {

	public function run()
	{
		$HealthWellnessFitness = ['Gym & sports equipment','Sports Medicine products','Outdoor & Indoor Games','Fitness Supplements','Yoga products','Health Monitoring gadgets & wearables','Fitness Apparel','Fitness Video products','Mental fitness and therapeutic products','Other alternate med & healing','Ayurveda products','Homeopathy products','Allopathy products','Others'];
		$FoodNutrition = ['Organic Food - farm produce','Sweets & Condiments','Grocery & Staples - spices,fruits,vegetables,ready to eat,dry fruits','Bakery confectionary - cakes,pastries,pattesery,confectionary,baked products','Ready to Eat food','Low Cal foods/diet foods','Nutrition/vitamin supplements/nutraceuticals/super foods','Diabetic foods/sugar free','Special food - diabetic,diet,sugar free,Vegan,jain','Imported food & Gourmet','Exotic Cuisines/party foods/festive food','Home made products - Pickles & Spreads,sweets,savories,snacks','Beverages','Baby foods','Utensils-special purpose','Others'];
		$BeautyFashion = ['Skincare/anti aging','Colour Cosmetics','Hair Styling Products/hair care products','HairEnhancements/bioceuticals/implants,extensions','Hair & Skin equipments & gadgets','Disease management & monitoring','Weight management','Acne & skin problem management','Apparel - casual,resort,party,beach wear,active,fusion','Business and formal wear','Traditional & ethnic wear sarees','Haute Couture/designer wear','Footwear - casual,formal,designer,sports,party','Lingerie,Sleep Wear,','Organic & envt friendly - apparel and accessories','Jewellery - traditional','Jewellery - others','Precious metals/stone','Watches','Accessories - belts,scarves,stoles,watches,bands,hair accessories','Hand bags','Eyeware'];
		$EducationCareParenting = ['Childrens books','Eldery care','Home Care','Pet care','Skills building books and videos','Innovative games and toys,Education toys,puzzles,hobbies','Safety and security for children,adults,women,senior citizens,home etc','Baby & childrens clothes,maternity clothes','Books, ebooks','Special needs children care','Garden care,landscaping','Hobbies - musical instruments','Birthday gifts','Others'];
		$Lifestyle = ['Gifts & Hampers','Flowers & plants','Eco-friendly Lighting','Arts & Crafts - home decor,deco products,eco-friendly art & craft,sculpture,murals,antiques,artefacts','Eco-friendly stationary/packaging, paper products','Water Conservation & Purification','Waste Management','Eco-friendly Gifts & Decor','Handmade Products','Gadgets & Electronics','Applications and software','Wearables','Robotics & sensors','Photography','Entertainment,music,movies,fine arts,karaoke','Travel & Leisure','Others'];

		foreach(range(6, 10) as $index)
		{
			if($index == 6)
			{
				foreach ($HealthWellnessFitness as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 7)
			{
				foreach ($FoodNutrition as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 8)
			{
				foreach ($BeautyFashion as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 9)
			{
				foreach ($EducationCareParenting as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 10)
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