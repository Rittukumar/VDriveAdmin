<?php

// Composer: "fzaninotto/faker": "v1.3.0"


class ServiceSubCategoriesTableSeeder extends Seeder {

	public function run()
	{
		$HealthWellnessFitness = ['Personal Trainers','Medical Services','Ambulance','Hospice','Home Care & Nursing','Fitness Trainers','Yoga & Meditation','Pilates','Nutritionist','Dietician','Weight Management','Dermatologist','Tricologist','Psychiatrist','Psychologist','Gynaecologist','Dentist','Specialized medical clinics - birthing centers,dental,fertility clinics etc.,','Paedritician','Neo-natal Care','Life Coaches','Fitness centers & Gyms','Dianostic clinics and services','Acne & skin problem management','Cosmetic services,cosmetology','Wellness centers/spas','Diagnostic clinics','Dental Clinics','Others'];
		$FoodNutrition = ['Events & Pantry Services','Home Delivery','Grocery Services','Party Caterers','Tiffin Caterers','Marriage Caterers','Special Needs Foods','Restaurants & cafes','Food scuplture carvings','Diet food services'];
		$BeautyFashion = ['Parlour Services','Hair Stylist','Nail Art','Masseuse','Cosmetologist','Mehndi','Bridal Makeup','Stylist','Professional Shoppers','Dress designing','Tailoring Services','Grooming Services','Costume Designers','Make up/makeover artists'];
		$EducationCareParenting = ['Online Tutors','Home Tutors','Coaching Classes','Language Classes','Cooking Classes','Elderly care','Pet care','Care for special children','Child care'];
		$Lifestyle = ['Interior Decoration','Architects','Artists and Painters','Sculpting/Murals','Landscaping','Feng Shui/Vaastu Consulting','Spl Drycleaning & Laundry','House Cleaning Services','Maintenance Services','Movers & Packers','Sustainability Services','Waste Management Services','Printing Services','Party organizers','Event managers','Emcees','Wedding Planners','Vocal Trainers','Choreographers','Performers','Themed Parties','Birthday Parties','Personalized Gifting Services','Photography','Videography','Others'];
		$Business = ['Business Consulting','Startup Consulting','M & A Consulting','Portfolio Management','Legal Services','Auditing Services','CA & Taxation','Marketing & Promotion','Digital Marketing','Brand & Communication','Professional Mentoring','Travel Services','Ad Agencies','Modelling Agencies','Real Estate','Day care services','Special Children Care, cure & education','Insurance Agents','Public Relations','Image Consultants','Design & Printing Services','Corp Cleaning Services','Recruitment Services','Headhunters','Sustainability Services','NGO','Courier','Hospice','Software & App Development','Security Services','Others'];


		foreach(range(11, 16) as $index)
		{
			if($index == 11)
			{
				foreach ($HealthWellnessFitness as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 12)
			{
				foreach ($FoodNutrition as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 13)
			{
				foreach ($BeautyFashion as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 14)
			{
				foreach ($EducationCareParenting as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 15)
			{
				foreach ($Lifestyle as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

			if($index == 16)
			{
				foreach ($Business as $value) {
					SubCategory::create([
						'subcategory_name' => $value,
						'category_id' => $index
					]);
				}

			}

		}
	}
}

