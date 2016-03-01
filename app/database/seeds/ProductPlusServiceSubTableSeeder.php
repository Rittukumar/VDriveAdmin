<?php


class ProductPlusServiceSubTableSeeder extends Seeder {

	public function run()
	{
		$HealthWellnessFitness = ['Wellness Centers','Spas','Beauty Parlors','Fitness,Weight Management Centers', 'Yoga institutes','Image mgmt, Grooming Studios','Alternate Medicine, healing Centers','Ayurveda Centers','Mental fitness and therapy centers','Homeopathy clinics','Specialty Medical & Diagnostics Clinics','Others'];
		$FoodNutrition = ['Nutritionist, Diet Clinics','Diabetic mgmt Clinics','Event management Services & Products','Cafes','Theme Restaurants','Organic Food Suppliers and services','Others'];
		$BeautyFashion = ['Skincare/anti aging Clinics and Spas','Nail Bars','Hair Care and Styling Spas,clinics, Centers','Cosmetic Surgery clinics','Cosmetology Clinics','Weight Management Clinics','Apparel Designing houses','Customized Jewelry Designers','Others'];
		$EducationCareParenting = ['Pet care Spas, Clinics','Library Services','Children Skill enhancement workshops','Hobbies Classes, camps','Special Needs Children Care','Event Management Services and products','Art and Craft classes','Music, Karaoke Classes','Others'];
		$Lifestyle = ['Interior decoration, Home décor- consulting and Products','Art and Craft supplies','Landscaping and Gardening','Feng Shui,Vastu and others - consulting and products','Electronic security consulting , services and products','Water Conservation & Purification','Waste Management','Eco-friendly Architects, construction and related services','IT and Comm. Services and products','Digitization services and products','Photography services and products','Travel , leisure services and products','Procurement, Sourcing Services, Products','Marketing, Promotion - Consulting and Products','Horoscope, Astrology Services and Products'];
		
		foreach(range(29, 33) as $index)
		{
			if($index == 29)
			{
				foreach ($HealthWellnessFitness as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 30)
			{
				foreach ($FoodNutrition as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 31)
			{
				foreach ($BeautyFashion as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 32)
			{
				foreach ($EducationCareParenting as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 33)
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