<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class screensTableSeeder extends Seeder
{

    public function run()
    {
       $faker = Faker::create();

       //screen 1
        $screen = Screens::create([
            'id'          => 1,
            'screen_name' => 'Top Menu',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header mysite',
            'field_value' => 'Mysite'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Jobs',
            'field_value' => 'Jobs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Sign In',
            'field_value' => 'Sign In'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Signed in User Options-Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Signed in User Options-Update Profile',
            'field_value' => 'Update Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Signed in User Options-Editor',
            'field_value' => 'Editor'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Signed in User Options-Settings',
            'field_value' => 'Settings'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Signed in User Options-Logout',
            'field_value' => 'Logout'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Track your order',
            'field_value' => 'Track your order'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header cart',
            'field_value' => 'cart'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Top Header Chat',
            'field_value' => 'Chat'
        ]);


        //screen 2
        $screen = Screens::create([
            'id'          => 2,
            'screen_name' => 'Page Footer',
        ]);

        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer About US',
                    'field_value' => 'About US'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Mysite',
                    'field_value' => 'Mysite'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Contribute',
                    'field_value' => 'Contribute'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Careers',
                    'field_value' => 'Careers'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer MarketPlace',
                    'field_value' => 'MarketPlace'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Advertise',
                    'field_value' => 'Advertise'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Contact Us',
                    'field_value' => 'Contact Us'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Jobs',
                    'field_value' => 'Jobs'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Invite Friends',
                    'field_value' => 'Invite Friends'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Privacy Policy',
                    'field_value' => 'Privacy Policy'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Page Footer Webinsights Pvt Ltd.',
                    'field_value' => 'Webinsights Pvt Ltd.'
                ]);

       //screen 3
        $screen = Screens::create([
            'id'          => 3,
            'screen_name' => 'Landing Page',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Mysite Label',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'MarketPlace Label',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Jobs Label',
            'field_value' => 'Jobs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Description Mysite',
            'field_value' => 'Evezown is a unique commerce and community platform. If you are an entrepreneur, Business professional or an organisation/association, Evezown offers a unique web presence combined with interaction and transaction features and a host of Ecom and digital promotional tools.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Description MarketPlace',
            'field_value' => 'Shopping is an art for discerning! If you have an eye for it, you will love MarketPlace! This is a place for all things exclusive, unique, you can always find something that reflects your personal touch and taste. If you know what want, search, filter or just browse through stores at leisure, explore, experience and then choose.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Description Jobs',
            'field_value' => 'This is resourcing platform. If you are in business, you can use it for hiring talent. As a working professional you can use this platform to find an job opportunity of your choice. Customized categorization helps you identify suitable job opportunity.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Description button Take a Tour',
            'field_value' => 'Take a Tour'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Signup Button',
            'field_value' => 'Signup'
        ]);
        ScreenFields::create([
                'screen_id'   => $screen->id,
                'field_name'  => 'Breadcrumbs-1 Stores Button',
                'field_value' => 'Stores'
            ]);
        ScreenFields::create([
                'screen_id'   => $screen->id,
                'field_name'  => 'Breadcrumbs-1 Business Button ',
                'field_value' => 'Business'
            ]);
        ScreenFields::create([
                'screen_id'   => $screen->id,
                'field_name'  => 'Breadcrumbs-1 Store/Business Button ',
                'field_value' => 'Store/Business'
            ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Breadcrumbs-1 Ads & campaigns Button ',
                    'field_value' => 'Ads & campaigns'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Videos button',
                    'field_value' => 'Videos'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'News',
                    'field_value' => 'News'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Interviews',
                    'field_value' => 'Interviews'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Articles',
                    'field_value' => 'Articles'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Content Whats new',
                    'field_value' => 'Whats new'
                ]);
        ScreenFields::create([
                    'screen_id'   => $screen->id,
                    'field_name'  => 'Content Trending this month',
                    'field_value' => 'Trending this month'
                ]);



        // screen 4
        $screen = Screens::create([
            'id'          => 4,
            'screen_name' => 'Mysite-Recent Activity',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Recent Activity- Label',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Recent Activity- Description',
            'field_value' => 'Activity on your site, all your streams in recent times will appear her, you control the visibility, who sees what!'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Chnage Left Cover',
            'field_value' => 'Chnage Left Cover'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Chnage Right Cover',
            'field_value' => 'Chnage Right Cover'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Chnage Bottom Cover',
            'field_value' => 'Chnage Bottom Cover'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Mysite ',
            'field_value' => 'description Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);


        // screen 5
        $screen = Screens::create([
            'id'          => 5,
            'screen_name' => 'Create and Edit Profile',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create and Edit Profile-Label',
            'field_value' => 'Create and Edit Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create and Edit Profile-Description',
            'field_value' => 'Through simple steps, step by step build your profile to reflect personality, control visibility for every element. '
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Take a Tour',
            'field_value' => 'Take a Tour'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Manage Mysite ',
            'field_value' => 'description Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Educational Qualifications',
            'field_value' => 'Educational Qualifications'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Skills',
            'field_value' => 'Skills'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Languages Known',
            'field_value' => 'Languages Known'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Employment / professional details',
            'field_value' => 'Employment / professional details'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Save',
            'field_value' => 'Save'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);

        // screen 6
        $screen = Screens::create([
            'id'          => 6,
            'screen_name' => 'Enhance Profile Page',
        ]);

          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Enhance Profile Page ',
            'field_value' => 'description Enhance Profile Page'
        ]);
       ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content About me',
            'field_value' => 'About me'
        ]);
       ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content profile page Selection',
            'field_value' => 'profile page Selection'
        ]);
       ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Specifics - Hobbies, Talent, Achievements, Interests',
            'field_value' => 'Specifics - Hobbies, Talent, Achievements, Interests'
        ]);
       ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Any Special Uploads',
            'field_value' => 'Any Special Uploads'
        ]);
       ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save',
            'field_value' => 'Save'
        ]);
               ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);

        // screen 7
        $screen = Screens::create([
            'id'          => 7,
            'screen_name' => 'Change Password',
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description  Change Password',
            'field_value' => 'description Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Save Button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);


                // screen 8
        $screen = Screens::create([
            'id'          => 8,
            'screen_name' => 'My Online Presence',
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content My Online Presence URL',
            'field_value' => 'My Online Presence URL'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);


                // screen 9
        $screen = Screens::create([
            'id'          => 9,
            'screen_name' => 'Favorites-Topics /Areas of Interest',
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Favorites-Topics /Areas of Interest',
            'field_value' => 'Favorites-Topics /Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Fill Favorites-Topics /Areas of Interest',
            'field_value' => 'Favorites-Topics /Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);


                // screen 10
        $screen = Screens::create([
            'id'          => 10,
            'screen_name' => 'My Reference Info',
        ]);

          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description My Reference Info',
            'field_value' => 'My Reference Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content My Reference info 1',
            'field_value' => 'My Reference Info 1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content My Reference info 2',
            'field_value' => 'My Reference Info 2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content My Reference info 3',
            'field_value' => 'My Reference Info 3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);

                // screen 11
        $screen = Screens::create([
            'id'          => 11,
            'screen_name' => 'My Participation in MarketPlace',
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content My Participation in MarketPlace checkbox',
            'field_value' => 'My Participation in MarketPlace checkbox'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save button',
            'field_value' => 'Save'
        ]);
                 ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);

                // screen 12
        $screen = Screens::create([
            'id'          => 12,
            'screen_name' => 'Other Evezown Services',
        ]);

          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Other EvezOwn services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Are you looking for checkbox',
            'field_value' => 'Are you looking for checkbox'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);


                // screen 13
        $screen = Screens::create([
            'id'          => 13,
            'screen_name' => 'Partnering with Evezown',
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Partnering with Evezown checkbox',
            'field_value' => 'Partnering with Evezown checkbox'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Any other idea for partnership',
            'field_value' => 'Any other idea for partnership'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);


                // screen 14
        $screen = Screens::create([
            'id'          => 14,
            'screen_name' => 'Feedback/suggestions',
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Update Myzsite Image',
            'field_value' => 'Update Myzsite Image'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Profile-link',
            'field_value' => 'Profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description  Feedback/suggestions',
            'field_value' => 'Feedback/suggestions'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Feedback/suggestions',
            'field_value' => 'Feedback/suggestions'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Save button',
            'field_value' => 'save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Personal Info Basic',
            'field_value' => 'Personal Info Basic'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Enhance Profile Page',
            'field_value' => 'Enhance Profile Page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Change Password',
            'field_value' => 'Change Password'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Online Presence',
            'field_value' => 'My Online Presence'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Favorites-Topics/Areas of Interest',
            'field_value' => 'Favorites-Topics/Areas of Interest'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Reference info',
            'field_value' => 'My Reference info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu My Participation in MarketPlace',
            'field_value' => 'My Participation in MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Other Evezown Services',
            'field_value' => 'Other Evezown Services'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Partnering with Evezown',
            'field_value' => 'Partnering with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Feedback/Suggestions',
            'field_value' => 'Feedback/Suggestions'
        ]);

                // screen 15
        $screen = Screens::create([
            'id'          => 15,
            'screen_name' => 'Build Community',
        ]);


          ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Build Community-description',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Description Take a Tour',
            'field_value' => 'Take a Tour'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Mysite-link',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Connects-Friends',
            'field_value' => 'Friends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Search Friends',
            'field_value' => 'Search Friends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite people',
            'field_value' => 'Invite people'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Search Members',
            'field_value' => 'Search Members'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Member Requests',
            'field_value' => 'Member Requests'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Connects',
            'field_value' => 'Connects'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Advertise',
            'field_value' => 'Advertise'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Circles',
            'field_value' => 'Circles'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Invite People',
            'field_value' => 'Invite People'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Invite History',
            'field_value' => 'Invite History'
        ]);


                // screen 16
        $screen = Screens::create([
            'id'          => 16,
            'screen_name' => 'Advertise',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Advertise-Label',
            'field_value' => 'Advertise'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Advertise-Description',
            'field_value' => 'Spread the word about your site, store/s, campaigns by advertising on available social networks. You can inform your social circles or customers, partners, friends, connects about Evezown and your site on Evezown through this tool.'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advertise',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Build Community-description',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Mysite-link',
            'field_value' => 'Mysite'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Advertise',
            'field_value' => 'Advertise'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite Using Facebook',
            'field_value' => 'Invite Using Facebook'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite Using Whatsapp',
            'field_value' => 'Invite Using Whatsapp'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite Using Google+',
            'field_value' => 'Invite Using Google+'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Connects',
            'field_value' => 'Connects'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Advertise',
            'field_value' => 'Advertise'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Circles',
            'field_value' => 'Circles'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Invite People',
            'field_value' => 'Invite People'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Invite History',
            'field_value' => 'Invite History'
        ]);

                // screen 17
        $screen = Screens::create([
            'id'          => 17,
            'screen_name' => 'Circles',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Circles-Label',
            'field_value' => 'Circles'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Circles-Description',
            'field_value' => 'Compartmentalize, segment your connects as you want, you can segregate your entire database, for example.. Premium customers, suppliers, alliances, colleagues, ex-colleagues'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Circles',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Build Community-description',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Mysite-link',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Search-Circles',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content UserCreated-Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content UserCreated-Circle-Delete',
            'field_value' => 'Delete'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Circle',
            'field_value' => 'Create Circle'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create-Circle Circle Title',
            'field_value' => 'Circle Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create-Circle Circle Description',
            'field_value' => 'Circle Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create-Circle Visibility settings',
            'field_value' => 'Visibility settings'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create-Circle Add',
            'field_value' => 'Add'
        ]);

                // screen 18
        $screen = Screens::create([
            'id'          => 18,
            'screen_name' => 'Circles details',
        ]);


                    ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Circles',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Build Community-description',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles-link',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 edit circles',
            'field_value' => 'edit circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Visibility',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 delete circle',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Edit-Circle Circle-Title',
            'field_value' => 'Circle Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Edit-Circle Circle-Description',
            'field_value' => 'Circle Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Edit-Circle Visibility-setting',
            'field_value' => 'Visibility setting'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Edit-Circle Save Button',
            'field_value' => 'Save'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Added friends list ',
            'field_value' => 'Friends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'RightMenu Add Friends to circle',
            'field_value' => 'Add Friends to circle'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'RightMenu Search Friends',
            'field_value' => 'Search Friends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'RightMenu Friends-name with Add button',
            'field_value' => 'Add'
        ]);

                // screen 19
        $screen = Screens::create([
            'id'          => 19,
            'screen_name' => 'Invite People',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Invite People-label',
            'field_value' => 'Invite People'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Invite People-Description',
            'field_value' => 'Invite your real world connections, friends and family to your site and store/s, In effect they will also become members of Evezown. We don’t make all our members visible to each other de-facto. We ensure complete exclusivity for your business, our aim to give privacy that you need for your growth, go ahead, safely  invite your customers too.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Invite People',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Build Community-description',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Mysite-link',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Invite People',
            'field_value' => 'Invite People description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add an Email',
            'field_value' => 'Add an Email'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Send Invites button for Email',
            'field_value' => 'Send Invites'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Upload XLSX/XLS files',
            'field_value' => 'Choose File'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Upload XLSX/XLS files email list',
            'field_value' => 'Email list box'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Send Invites button for XLSX/XLS files ',
            'field_value' => 'Send Invites'
        ]);

                // screen 20
        $screen = Screens::create([
            'id'          => 20,
            'screen_name' => 'Invite History',
        ]);


                    ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Invite History',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Build Community-description',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Mysite-link',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-description Invite History',
            'field_value' => 'Invite History'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite History',
            'field_value' => 'Invite History'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite History-Delete',
            'field_value' => 'Invite History-Delete'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite History-Resend',
            'field_value' => 'Invite History-Resend'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Invite History-Pagination',
            'field_value' => 'Invite History-Pagination'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Connects',
            'field_value' => 'Connects'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Advertise',
            'field_value' => 'Advertise'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Circles',
            'field_value' => 'Circles'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Invite People',
            'field_value' => 'Invite People'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Invite History',
            'field_value' => 'Invite History'
        ]);


         // screen 21
        $screen = Screens::create([
            'id'          => 21,
            'screen_name' => 'Stream It',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream It- Label',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream It- Description',
            'field_value' => 'Share and Ask, Recommend, Spread the word, tell a friend about your discoveries or lessons. Stream your messages and images, videos to your circles. You decide on visibility.'
        ]);



        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream It-description',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream It Take a Your',
            'field_value' => 'Take a Tour'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Mysite-link',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Recent-All',
            'field_value' => 'All'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Recent-I Recommend',
            'field_value' => 'I Recommend'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Recent-Share/Ask',
            'field_value' => 'Share/Ask'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Recent-My Find',
            'field_value' => 'My Find'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Recent-Be Cautious',
            'field_value' => 'Be Cautious'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Recent-My Friends/All Members Dropdown',
            'field_value' => 'My Friends/All Members Dropdown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Priority checkbox',
            'field_value' => 'Priority'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Uploload post image',
            'field_value' => 'Uploload post image'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Post Title',
            'field_value' => 'Post Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Post Description',
            'field_value' => 'Post Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Select Post Category',
            'field_value' => 'Post Category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Select Post SubCategory',
            'field_value' => 'Post SubCategory'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Select Price',
            'field_value' => 'Price'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Enter Location',
            'field_value' => 'Location'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Select PostType',
            'field_value' => 'PostType'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Select Classify',
            'field_value' => 'Classify'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Select Brand',
            'field_value' => 'Brand'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Add Brand',
            'field_value' => 'Add Brand'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Add Brand-Brand Name',
            'field_value' => 'Brand Name'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Add Brand-Upload Logo',
            'field_value' => 'Upload Logo'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Add Brand-Add button',
            'field_value' => 'Add'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Choose Visibility',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Website address',
            'field_value' => 'Website'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stream Stream It button',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Streamed Posts list',
            'field_value' => 'Streamed Posts'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Streamed Posts-Report',
            'field_value' => 'Report'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Streamed Posts-Comments',
            'field_value' => 'Comments'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Streamed Posts-Grade It',
            'field_value' => 'Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Streamed Posts-Restream',
            'field_value' => 'Restream'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Load More',
            'field_value' => 'Load More'
        ]);

         // screen 22
        $screen = Screens::create([
            'id'          => 22,
            'screen_name' => 'Stores',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stores-Label',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Stores-Description',
            'field_value' => 'If you own a business, products or services or both, want to start a new one, This is the place for you.  We have made it simple for you. You get all the tools to  create your web store and promote it, tab by tab fill in details. Arm yourself with real bright images, get your script and description in place before hand, Go with the flow.'
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Stores',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Advance Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connect',
            'field_value' => 'Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Search Stores',
            'field_value' => 'Search Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Store Button',
            'field_value' => 'Create Store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Created Store list',
            'field_value' => 'Created Store list'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content link-to-store with store name',
            'field_value' => 'link-store name'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content link-to-manage store',
            'field_value' => 'manage store'
        ]);

         // screen 23
        $screen = Screens::create([
            'id'          => 23,
            'screen_name' => 'Create Store Step1',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create-store Step1- Description',
            'field_value' => 'Step1- Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Store Info-link',
            'field_value' => 'Create Store Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step4',
            'field_value' => 'Step4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step5',
            'field_value' => 'Step5'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step6',
            'field_value' => 'Step6'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Store Title',
            'field_value' => 'Store Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Store Description',
            'field_value' => 'Store Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Owners Info',
            'field_value' => 'Owners Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Add more Owners',
            'field_value' => 'Add more Owners'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Registered Address',
            'field_value' => 'Registered Address'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-physical office, store, shop checkbox',
            'field_value' => 'physical office, store, shop'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Licence info',
            'field_value' => 'Licence info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Store Address',
            'field_value' => 'Store Address'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Location',
            'field_value' => 'Location'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Pincode',
            'field_value' => 'Pincode'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Save',
            'field_value' => 'Next'
        ]);

         // screen 24
        $screen = Screens::create([
            'id'          => 24,
            'screen_name' => 'Create Store Step2',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create-store Step2- Description',
            'field_value' => 'Step2- Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Store Info-link',
            'field_value' => 'Create Store Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step4',
            'field_value' => 'Step4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step5',
            'field_value' => 'Step5'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step6',
            'field_value' => 'Step6'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Type of store-selecton',
            'field_value' => 'type of store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Business Information',
            'field_value' => 'Business Information'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Contract with Evezown',
            'field_value' => 'Contract with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Give your billing Info ',
            'field_value' => 'Give your billing Info '
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save button ',
            'field_value' => 'Next'
        ]);

        // screen 25
        $screen = Screens::create([
            'id'          => 25,
            'screen_name' => 'Create Store Step3',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create-store Step3- Description',
            'field_value' => 'Step3- Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Store Info-link',
            'field_value' => 'Create Store Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step4',
            'field_value' => 'Step4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step5',
            'field_value' => 'Step5'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step6',
            'field_value' => 'Step6'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store title/Name plus byline',
            'field_value' => 'Store title/Name plus byline'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Upload Collage Pictures - 3 pictures',
            'field_value' => 'Upload Collage Pictures - 3 pictures'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Upload Profile - shop logo/picture',
            'field_value' => 'Upload Profile - shop logo/picture'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Description',
            'field_value' => 'Store Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Listing Information',
            'field_value' => 'Listing Information'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Keyword attach',
            'field_value' => 'Keyword attach'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Button',
            'field_value' => 'Next'
        ]);

                // screen 26
        $screen = Screens::create([
            'id'          => 26,
            'screen_name' => 'Create Store Step4',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create-store Step4- Description',
            'field_value' => 'Step4- Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Store Info-link',
            'field_value' => 'Create Store Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step4',
            'field_value' => 'Step4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step5',
            'field_value' => 'Step5'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step6',
            'field_value' => 'Step6'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Customer Connect-E-Mail ',
            'field_value' => 'E-Mail'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Customer Connect-Phone Numbers ',
            'field_value' => 'Phone Numbers'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Front - Footer Info Basic Links',
            'field_value' => 'Basic Links'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Additional/Mandatory Disclosures/Info',
            'field_value' => 'Additional/Mandatory Disclosures/Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Button',
            'field_value' => 'Next'
        ]);

                // screen 27
        $screen = Screens::create([
            'id'          => 27,
            'screen_name' => 'Create Store Step5',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create-store Step5- Description',
            'field_value' => 'Step5- Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Store Info-link',
            'field_value' => 'Create Store Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step4',
            'field_value' => 'Step4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step5',
            'field_value' => 'Step5'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step6',
            'field_value' => 'Step6'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 1',
            'field_value' => 'Select slide image 1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 2',
            'field_value' => 'Select slide image 2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 3',
            'field_value' => 'Select slide image 3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 4',
            'field_value' => 'Select slide image 4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Price',
            'field_value' => 'Price'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Tagline',
            'field_value' => 'Tagline'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Button',
            'field_value' => 'Next'
        ]);

        // screen 28
        $screen = Screens::create([
            'id'          => 28,
            'screen_name' => 'Create Store Step6',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Create-store Step6- Description',
            'field_value' => 'Step6- Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Store Info-link',
            'field_value' => 'Create Store Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step4',
            'field_value' => 'Step4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step5',
            'field_value' => 'Step5'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Step6',
            'field_value' => 'Step6'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content want to link your personal profile to Store profile',
            'field_value' => 'want to link your personal profile to Store profile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Choose Stream-it',
            'field_value' => 'Choose Stream-it'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Price List at a glance',
            'field_value' => 'Price List at a glance'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Links to other sites',
            'field_value' => 'Links to other sites'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Store',
            'field_value' => 'Finish'
        ]);

        // screen 29
        $screen = Screens::create([
            'id'          => 29,
            'screen_name' => 'Create Store SuccessPage',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Preview Store Front',
            'field_value' => 'Preview Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Edit/Delete Store Front',
            'field_value' => 'Edit/Delete Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Store',
            'field_value' => 'Manage Store'
        ]);

        // screen 30
        $screen = Screens::create([
            'id'          => 30,
            'screen_name' => 'Store Front Page',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Business',
            'field_value' => 'Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Store/Business',
            'field_value' => 'Store/Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Health, Wellness & Fitness',
            'field_value' => 'Health, Wellness & Fitness'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Food & Nutrition',
            'field_value' => 'Food & Nutrition'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Beauty & Fashion',
            'field_value' => 'Beauty & Fashion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Education, Care & Parenting',
            'field_value' => 'Education, Care & Parenting'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 More',
            'field_value' => 'More'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 MarketPlace-Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Browse Stores-Link',
            'field_value' => 'Browse Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Store-Link',
            'field_value' => 'Manage Store'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Publish store-Link',
            'field_value' => 'Publish store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Comments',
            'field_value' => 'Comments'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Grade It',
            'field_value' => 'Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Restreame',
            'field_value' => 'Restream'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Price List at a Glance',
            'field_value' => 'Price List at a Glance'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote',
            'field_value' => 'Request For Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form',
            'field_value' => 'RFQ form'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Contact me on email',
            'field_value' => 'Contact me on email'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Contact me on mobile',
            'field_value' => 'Contact me on mobile'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Add Product/Service',
            'field_value' => 'Add Product/Service'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Add Product Button',
            'field_value' => 'Add Product'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Any Other Information',
            'field_value' => 'Any Other Information'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Feedback related to purchase',
            'field_value' => 'Feedback related to purchase'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Comments',
            'field_value' => 'Comments'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Request For Quote Form-Send Button',
            'field_value' => 'Send'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-content New Trending Styles',
            'field_value' => 'New Trending Styles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Payment Options',
            'field_value' => 'Payment Options'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Additional/Mandatory Disclosures/Info',
            'field_value' => 'Additional/Mandatory Disclosures/Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-About Us',
            'field_value' => 'About Us'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Shipping And Returns',
            'field_value' => 'About Us'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Contact us',
            'field_value' => 'Contact us'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Privacy Policy',
            'field_value' => 'Privacy Policy'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Videos',
            'field_value' => 'Videos'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-News',
            'field_value' => 'News'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Interviews',
            'field_value' => 'Interviews'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Front-Articles',
            'field_value' => 'Articles'
        ]);

        // screen 31
        $screen = Screens::create([
            'id'          => 31,
            'screen_name' => 'Manage Store-Store Info',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to Home Page',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Info-Description',
            'field_value' => 'Store Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Store Title',
            'field_value' => 'Store Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Store Description',
            'field_value' => 'Store Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Owners Info',
            'field_value' => 'Owners Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Add more Owners',
            'field_value' => 'Add more Owners'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Registered Address',
            'field_value' => 'Registered Address'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-physical office, store, shop checkbox',
            'field_value' => 'physical office, store, shop'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Licence info',
            'field_value' => 'Licence info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Store Address',
            'field_value' => 'Store Address'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Location',
            'field_value' => 'Location'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Pincode',
            'field_value' => 'Pincode'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Basic Info-Pincode',
            'field_value' => 'Pincode'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 32
        $screen = Screens::create([
            'id'          => 32,
            'screen_name' => 'Manage Store-Store Selection',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Selection Contract-Description',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Type of store-selecton',
            'field_value' => 'type of store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Business Information',
            'field_value' => 'Business Information'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Contract with Evezown',
            'field_value' => 'Contract with Evezown'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Give your billing Info ',
            'field_value' => 'Give your billing Info '
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Button ',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);


        // screen 33
        $screen = Screens::create([
            'id'          => 33,
            'screen_name' => 'Manage Store-Store Front',
        ]);

       
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Front-Description',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store title/Name plus byline',
            'field_value' => 'Store title/Name plus byline'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Upload Collage Pictures - 3 pictures',
            'field_value' => 'Upload Collage Pictures - 3 pictures'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Upload Profile - shop logo/picture',
            'field_value' => 'Upload Profile - shop logo/picture'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Description',
            'field_value' => 'Store Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Listing Information',
            'field_value' => 'Listing Information'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Keyword attach',
            'field_value' => 'Keyword attach'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Preview Store',
            'field_value' => 'Save'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 34
        $screen = Screens::create([
            'id'          => 34,
            'screen_name' => 'Manage Store-Product_Catalogue',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product Catalogue-Description',
            'field_value' => 'Product Catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Product/Service Lines-Title',
            'field_value' => 'Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Product/Service Lines-Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Select Product/Service Line',
            'field_value' => 'Product/Service Line'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Product/Service Line',
            'field_value' => 'Add Product/Service Line'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service Line - Add Product/Service button',
            'field_value' => 'Add Product/Service'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Product/Service Title',
            'field_value' => 'Product/Service Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Select Product/Service Line',
            'field_value' => 'Select Product/Service Line'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Price in INR',
            'field_value' => 'Price in INR'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Discount Percentage(If applicable)',
            'field_value' => 'Price in INR'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Shipment Charges(INR)',
            'field_value' => 'Shipment Charges(INR)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Add Size(If applicable)',
            'field_value' => 'Add Size(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Choose Color in Hex Code(If Applicable)',
            'field_value' => 'Choose Color in Hex Code(If Applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Add Weight in Kg(If applicable)',
            'field_value' => 'Add Weight in Kg(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Add Volume in ml(If applicable)',
            'field_value' => 'Add Volume in ml(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Date of packing/Expiry(If applicable)',
            'field_value' => 'Date of packing/Expiry(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Add Available Stock(Default 0)',
            'field_value' => 'Add Available Stock(Default 0)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Upload Product Image',
            'field_value' => 'Upload Product Image'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Product Description',
            'field_value' => 'Product Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Add Product',
            'field_value' => 'Add Product'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service - Build Individual Units - Cancel Button',
            'field_value' => 'Cancel'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service Line-Product Line',
            'field_value' => 'Product Line'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service Line-Type-View Products',
            'field_value' => 'View Products'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service Line-Action-Edit',
            'field_value' => 'Edit Product/Service Line'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service Line-Action-Delete',
            'field_value' => 'Delete Product/Service Line'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service-Title',
            'field_value' => 'Product/Service-Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service-Description',
            'field_value' => 'Product/Service-Description'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service-Variants-View/Add',
            'field_value' => 'View/Add'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service-Action-Update',
            'field_value' => 'Update Product/Service'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service-Action-Delete',
            'field_value' => 'Delete Product/Service'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service View - Product/Service Variants-Is Trending',
            'field_value' => 'Is Trending'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service View - Product/Service Variants-Image',
            'field_value' => 'Image'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service View - Product/Service Variants-Price',
            'field_value' => 'Price'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service View - Product/Service Variants-Stock',
            'field_value' => 'Stock'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service View - Product/Service Variants-Action-Update',
            'field_value' => 'Update'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service View - Product/Service Variants-Action-Delete',
            'field_value' => 'Delete'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product/Service View - Product/Service Variants-Close Button',
            'field_value' => 'Close'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Price in INR',
            'field_value' => 'Price in INR'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Discount Percentage(If applicable)',
            'field_value' => 'Price in INR'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Shipment Charges(INR)',
            'field_value' => 'Shipment Charges(INR)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Add Size(If applicable)',
            'field_value' => 'Add Size(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Choose Color in Hex Code(If Applicable)',
            'field_value' => 'Choose Color in Hex Code(If Applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Add Weight in Kg(If applicable)',
            'field_value' => 'Add Weight in Kg(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Add Volume in ml(If applicable)',
            'field_value' => 'Add Volume in ml(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Date of packing/Expiry(If applicable)',
            'field_value' => 'Date of packing/Expiry(If applicable)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Add Available Stock(Default 0)',
            'field_value' => 'Add Available Stock(Default 0)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Upload Product Image',
            'field_value' => 'Upload Product Image'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Product Description',
            'field_value' => 'Product Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Add Product',
            'field_value' => 'Add Variant'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Product/Service Add - Add Variant - Cancel Button',
            'field_value' => 'Cancel'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 35
        $screen = Screens::create([
            'id'          => 35,
            'screen_name' => 'Manage Store Commerce_Engine',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Commerce Engine-Description',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enable Payment Gateway Checkbox',
            'field_value' => 'Enable Payment Gateway'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Payment gateway PayU terms and conditions-Link',
            'field_value' => 'Payment gateway PayU terms and conditions'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Billing Information for Evezown Billing-Address',
            'field_value' => 'Billing Information for Evezown Billing'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enable Payment Gateway Button',
            'field_value' => 'Enable Payment Gateway'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enter Alternate Payment Terms Checkbox',
            'field_value' => 'Enter Alternate Payment Terms'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Shipment, Delivery Co-ordination Information',
            'field_value' => 'Shipment, Delivery Co-ordination Information'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enable Payment Gateway - Save Button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 36
        $screen = Screens::create([
            'id'          => 36,
            'screen_name' => 'Manage Store Stock_Management',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stock Management-Description',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Select Stores/Business',
            'field_value' => 'Stores/Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business- Title',
            'field_value' => 'Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants',
            'field_value' => 'Variants'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants-View',
            'field_value' => 'Variants-View'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants View- Image',
            'field_value' => 'Image'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants View- Price',
            'field_value' => 'Price'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants View- Stock',
            'field_value' => 'Stock'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants View- Update',
            'field_value' => 'Update'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants View- Cancel Button',
            'field_value' => 'Cancel'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants View- Update-Edit Product Stock',
            'field_value' => 'Edit Product Stock'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Stores/Business Variants View- Update-Save Button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 37
        $screen = Screens::create([
            'id'          => 37,
            'screen_name' => 'Manage Store Store Promotion',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Promotion-Description',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Promotion-Description',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 1',
            'field_value' => 'Select slide image 1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 2',
            'field_value' => 'Select slide image 2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 3',
            'field_value' => 'Select slide image 3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Select slide image 4',
            'field_value' => 'Select slide image 4'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Price',
            'field_value' => 'Price'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Tagline',
            'field_value' => 'Tagline'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 38
        $screen = Screens::create([
            'id'          => 38,
            'screen_name' => 'Manage Store CRM',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store CRM-Description',
            'field_value' => 'Store CRM-Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Customer Connect-E-Mail',
            'field_value' => 'E-Mail'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Customer Connect-Phone Numbers',
            'field_value' => 'Phone Numbers'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Customer Connect-Additional/Mandatory Disclosures/Info',
            'field_value' => 'Additional/Mandatory Disclosures/Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Customer Connect-Save button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 39
        $screen = Screens::create([
            'id'          => 39,
            'screen_name' => 'Manage Store Store-Front-Footer',
        ]);

       
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store-Front-Footer-Description',
            'field_value' => 'Store CRM-Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Front Footer-Basic Links-Terms And Conditions',
            'field_value' => 'Terms And Conditions'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Front Footer-Basic Links-Policies',
            'field_value' => 'Terms And Conditions'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Front Footer-Basic Links-Sales Return And Exchange Policy',
            'field_value' => 'Sales Return And Exchange Policy'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Store Front Footer-Basic Links-Save button',
            'field_value' => 'Save'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 40
        $screen = Screens::create([
            'id'          => 40,
            'screen_name' => 'Manage Store Manage Orders',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Description',
            'field_value' => 'Manage Orders-Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Transaction ID',
            'field_value' => 'Transaction ID'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Transaction ID-Show Details Button',
            'field_value' => 'Show Details'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-hide Details Button',
            'field_value' => 'hide Details'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Price',
            'field_value' => 'Price'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Quantity',
            'field_value' => 'Quantity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Expected shipping date',
            'field_value' => 'Expected shipping date'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Expected delivery date',
            'field_value' => 'Expected delivery date'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Comments',
            'field_value' => 'Comments'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Update Order Item Status',
            'field_value' => 'Update Order Item Status'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Delivery Within',
            'field_value' => 'Delivery Within'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Shipped Within',
            'field_value' => 'Shipped Within'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Update Item',
            'field_value' => 'Update Item'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Buyer email',
            'field_value' => 'Buyer email'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Buyer Phone',
            'field_value' => 'Buyer Phone'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Orders-Show Details-Buyer Code',
            'field_value' => 'Buyer Code'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 41
        $screen = Screens::create([
            'id'          => 41,
            'screen_name' => 'Manage Store RFQ',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Request for Quote-Description',
            'field_value' => 'Request for Quote-Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enquirer-Name of RFQ sender',
            'field_value' => 'Enquirer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFQ-Date ',
            'field_value' => 'Date'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFQ Sender-Phone Number ',
            'field_value' => 'Phone Number'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFQ Sender-Email Id ',
            'field_value' => 'Email Id'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFQ Form- Show More Button ',
            'field_value' => 'Show More'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFQ Form-Product- Show More Button ',
            'field_value' => 'Show More'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 42
        $screen = Screens::create([
            'id'          => 42,
            'screen_name' => 'Manage Store Request for Info(RFI)',
        ]);


        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 link to MarketPlace',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Request for Information-Description',
            'field_value' => 'Request for Information-Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-Enquirer',
            'field_value' => 'Enquirer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI-Label-Date ',
            'field_value' => 'Date'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI Sender-Label-Phone Number ',
            'field_value' => 'Phone Number'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI Sender-Label-Email Id ',
            'field_value' => 'Email Id'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI Form- Label-Show More Button ',
            'field_value' => 'Show More'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFQ Form-Product-Label- Show More Button ',
            'field_value' => 'Show More'
        ]);
                ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store info',
            'field_value' => 'Store info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Selection Contract',
            'field_value' => 'Store Selection Contract'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front',
            'field_value' => 'Store Front'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Product catalogue',
            'field_value' => 'Product catalogue'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Commerce Engine',
            'field_value' => 'Commerce Engine'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Analytics',
            'field_value' => 'Store Analytics'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stock Management',
            'field_value' => 'Stock Management'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Promotion',
            'field_value' => 'Store Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Customer Connect(CRM)',
            'field_value' => 'Customer Connect'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Front - Footer',
            'field_value' => 'Store Front - Footer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Orders',
            'field_value' => 'Manage Orders'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Store Request for Quote',
            'field_value' => 'Store Request for Quote'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Products Request for Info',
            'field_value' => 'Products Request for Info'
        ]);

        // screen 43
        $screen = Screens::create([
            'id'          => 43,
            'screen_name' => 'Track Your Order',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Orders-Email / Transaction Id / Phone / Buyer code',
            'field_value' => 'Email / Transaction Id / Phone / Buyer code'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Orders-Search Button',
            'field_value' => 'Search'
        ]);

        // screen 44
        $screen = Screens::create([
            'id'          => 44,
            'screen_name' => 'Store Product Details',
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Business',
            'field_value' => 'Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Store/Business',
            'field_value' => 'Store/Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Health, Wellness & Fitness',
            'field_value' => 'Health, Wellness & Fitness'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Food & Nutrition',
            'field_value' => 'Food & Nutrition'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Beauty & Fashion',
            'field_value' => 'Beauty & Fashion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Education, Care & Parenting',
            'field_value' => 'Education, Care & Parenting'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 More',
            'field_value' => 'More'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 MarketPlace-Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Browse Stores-Link',
            'field_value' => 'Browse Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Store Name-Link to store front page',
            'field_value' => 'Store Name'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product details-Product name',
            'field_value' => 'Product details'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product details- Product Price',
            'field_value' => 'Product Price'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product details- Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product details- Choose Color',
            'field_value' => 'Choose Color'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Product details- Choose Size',
            'field_value' => 'Choose Size'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add to Cart Button',
            'field_value' => 'Add to Cart'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Buy Button',
            'field_value' => 'Buy'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enquiry/Request for Information(RFI) Button',
            'field_value' => 'Enquiry/Request for Information(RFI)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Videos Button',
            'field_value' => 'Videos'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content News',
            'field_value' => 'News'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Interviews',
            'field_value' => 'Interviews'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Articles',
            'field_value' => 'Articles'
        ]);
        // screen 45
        $screen = Screens::create([
            'id'          => 45,
            'screen_name' => 'Store Shopping Cart',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Shopping Cart-Remove Button',
            'field_value' => 'Remove'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Shopping Cart-Place Order Button',
            'field_value' => 'Place Order'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Store Shopping Cart-Continue Shopping Button',
            'field_value' => 'Continue Shopping'
        ]);
        // screen 46
        $screen = Screens::create([
            'id'          => 46,
            'screen_name' => 'Store Order Place',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enter Buyer Details-Email',
            'field_value' => 'Email'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enter Buyer Details-Phone',
            'field_value' => 'Phone'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Enter Buyer Details-Buyer Code (if you are an existing customer)',
            'field_value' => 'Buyer Code (if you are an existing customer)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Billing and Shipping Address-Billing Address',
            'field_value' => 'Billing Address'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Billing and Shipping Address-Shipping Address',
            'field_value' => 'Shipping Address'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Billing and Shipping Address-Close Button',
            'field_value' => 'Close'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Billing and Shipping Address-Add Button',
            'field_value' => 'Add'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Order Summary-Submit Order Button',
            'field_value' => 'Submit Order'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Order Summary-Continue Shopping Button',
            'field_value' => 'Continue Shopping'
        ]);
        // screen 47
        $screen = Screens::create([
            'id'          => 47,
            'screen_name' => 'Manage Mysite Ads and Campaigns',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads and Campaigns-Label',
            'field_value' => 'Ads and Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads and Campaigns-Description',
            'field_value' => 'Creation is just a start, Promotion, Word of mouth, Advertising, Marketing, Positioning all is key to carve a niche for yourself. This is a tool for you to create multiple ads or theme base d campaigns. We have automated creation to a great extent. You can stream in and out, with any frequency you think fit.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connects',
            'field_value' => 'Connects'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Manage Ads & Campaigns-Link',
            'field_value' => 'Manage Ads & Campaigns'
        ]);
         // screen 48
        $screen = Screens::create([
            'id'          => 48,
            'screen_name' => 'Manage Mysite Blogs',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Blogs-Label',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Blogs-Description',
            'field_value' => 'Express your thoughts through articles and blogs, you can write free flow, all features for smart editing are available to make writing simple. Share and control visibility.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connects',
            'field_value' => 'Connects'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Search Blogs',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Blog Button',
            'field_value' => 'Create Blog'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Created Blog- Read More- Button',
            'field_value' => 'Read More'
        ]);
         // screen 49
        $screen = Screens::create([
            'id'          => 49,
            'screen_name' => 'Manage Mysite Blogs-Create Blogs',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Blogs-Description',
            'field_value' => 'Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs-Link',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content choose category',
            'field_value' => 'choose category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content choose sub category',
            'field_value' => 'choose sub category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content visibility settings',
            'field_value' => 'visibility settings'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Blog-Title',
            'field_value' => 'Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Blog- Description',
            'field_value' => 'Blog- Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save as draft-Button',
            'field_value' => 'Save as draft'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Blog- Publish-Button',
            'field_value' => 'Publish'
        ]);
        // screen 50
        $screen = Screens::create([
            'id'          => 50,
            'screen_name' => 'Blogs-Read More-Blog Details',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Blogs-Description',
            'field_value' => 'Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs-Link',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Blogs-Edit blog',
            'field_value' => 'Edit blog'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Stream Blog',
            'field_value' => 'Stream blog'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Blogs-Visibility',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Blogs-Delete Blog',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Blogs-Grade It',
            'field_value' => 'Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Blogs-Comment',
            'field_value' => 'Comment'
        ]);
        // screen 51
        $screen = Screens::create([
            'id'          => 51,
            'screen_name' => 'Blogs-Edit Blog',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Blogs-Description',
            'field_value' => 'Description'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs-Link',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content choose category',
            'field_value' => 'choose category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content choose sub category',
            'field_value' => 'choose sub category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content visibility settings',
            'field_value' => 'visibility settings'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Blog-Title',
            'field_value' => 'Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Blog- Description',
            'field_value' => 'Blog- Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save as draft-Button',
            'field_value' => 'Save as draft'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Blog- Publish-Button',
            'field_value' => 'Publish'
        ]);
        // screen 52
        $screen = Screens::create([
            'id'          => 52,
            'screen_name' => 'Events',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Events-Label',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Events-Description',
            'field_value' => 'You can create Events, online events as well as reflect real life events- parties, get together and seminars, host of features available to automate all your event planning and execution! Capture the fun element '
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connects',
            'field_value' => 'Connects'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Search button',
            'field_value' => 'Event Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Event button',
            'field_value' => 'Create Event'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Requests',
            'field_value' => 'Event Requests'
        ]);
        // screen 53
        $screen = Screens::create([
            'id'          => 53,
            'screen_name' => 'Events Details',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Event Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events-Link',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Edit Events',
            'field_value' => 'Edit Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Stream Event',
            'field_value' => 'Stream Event'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Delete Event',
            'field_value' => 'Delete Event'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Grade It-Event',
            'field_value' => 'Grade It'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Activity-Select Photo',
            'field_value' => 'Select Photo'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Activity-Submit Button',
            'field_value' => 'Submit'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event-Search Attendees',
            'field_value' => 'Search Attendees'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event-Search Friends',
            'field_value' => 'Search Friends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event-Friends Name-Invite',
            'field_value' => 'Invite'
        ]);
        // screen 54
        $screen = Screens::create([
            'id'          => 54,
            'screen_name' => 'Edit Event',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Event Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events-Link',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Title',
            'field_value' => 'Event title'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Description',
            'field_value' => 'Event Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Visibility',
            'field_value' => 'Event Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Duration',
            'field_value' => 'Duration'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Event Location',
            'field_value' => 'Location'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Save Event',
            'field_value' => 'Save Event'
        ]);
        // screen 55
        $screen = Screens::create([
            'id'          => 55,
            'screen_name' => 'MyGallery',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery-Label',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery-Description',
            'field_value' => 'This is a photo gallery to showcase yourself, your venture, business and aspirations, share with your circles, audience, your can choose.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connects',
            'field_value' => 'Connects'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Search Gallery',
            'field_value' => 'Search Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Gallery button',
            'field_value' => 'Create Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Gallery popup-Add album',
            'field_value' => 'Add album'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Gallery popup-Album Title',
            'field_value' => 'Album Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Gallery popup-Album Description',
            'field_value' => 'Album Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Create Gallery popup-Add button',
            'field_value' => 'Add'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content View Gallery',
            'field_value' => 'View Gallery'
        ]);
        // screen 56
        $screen = Screens::create([
            'id'          => 56,
            'screen_name' => 'GalleryDetails',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connects',
            'field_value' => 'Connects'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Home-link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Gallery-link',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-4 edit album',
            'field_value' => 'edit album'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-4 Album-Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-4 Delete Gallery',
            'field_value' => 'Delete Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-4 Gallery-Grade It',
            'field_value' => 'Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery Name-Image-Delete option',
            'field_value' => 'Delete'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery Name-Image-Comment',
            'field_value' => 'Comment'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery-Add Images button',
            'field_value' => 'add images'
        ]);
        // screen 57
        $screen = Screens::create([
            'id'          => 57,
            'screen_name' => 'Gallery Comment',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Link to Gallery',
            'field_value' => 'Gallery Name'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery-Grade It',
            'field_value' => 'Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery-Add comment',
            'field_value' => 'Add comment'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Gallery-Add comment button',
            'field_value' => 'Add comment'
        ]);
        // screen 58
        $screen = Screens::create([
            'id'          => 58,
            'screen_name' => 'My Groups',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Groups-Label',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Groups-Description',
            'field_value' => 'You have a special purpose, people who share your purpose, create a group, add activity and propagate.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connects',
            'field_value' => 'Connects'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Search Groups',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Create Groups',
            'field_value' => 'Create Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Create Groups-Add group',
            'field_value' => 'Add group'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Create Groups-Group Title',
            'field_value' => 'Group Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Create Groups-Group Description',
            'field_value' => 'Group Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Create Groups-Add button',
            'field_value' => 'Add'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Group Requests',
            'field_value' => 'Group Requests'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content  Group Invites',
            'field_value' => 'Group Invites'
        ]);
        // screen 59
        $screen = Screens::create([
            'id'          => 59,
            'screen_name' => 'Group Details',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Groups Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Link to Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Group-Change cover',
            'field_value' => 'Change cover'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label Activities',
            'field_value' => 'Change cover'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Search Activities',
            'field_value' => 'Search Activities'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Activity Button',
            'field_value' => 'Add Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Activity-Create an activity',
            'field_value' => 'Create an activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Activity-Activity title',
            'field_value' => 'Activity title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Activity-Activity Description',
            'field_value' => 'Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Activity-Activity Website link',
            'field_value' => 'Website link'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Activity-Select Photos',
            'field_value' => 'Select Photos'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Activity-Add Activity button',
            'field_value' => 'Add Activity button'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Edit Group',
            'field_value' => 'Edite group'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Group-Visibility',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Group-Delete Group',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Friends List Label',
            'field_value' => 'Friends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Friends-Search Friends',
            'field_value' => 'Search Friends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Friends List Label-Invite',
            'field_value' => 'Invite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Group-Members List Label',
            'field_value' => 'Members'
        ]);
        // screen 60
        $screen = Screens::create([
            'id'          => 60,
            'screen_name' => 'My Discussion',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Discussion',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Connects',
            'field_value' => 'Connects'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Circles',
            'field_value' => 'Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Recent Activity',
            'field_value' => 'Recent Activity'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Manage Mysite',
            'field_value' => 'Manage Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Build Community',
            'field_value' => 'Build Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stream It',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Gallery',
            'field_value' => 'Gallery'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Groups',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Leftmenu Discussion',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Discussion Label',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Search Discussion',
            'field_value' => 'Search Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion button',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Added Discussion list - delete button',
            'field_value' => 'Delete'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion - Start Discussion Label',
            'field_value' => 'Start Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion - Discussion Title',
            'field_value' => 'Discussion Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion - Discussion description',
            'field_value' => 'Discussion description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion - choose category',
            'field_value' => 'choose category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion - choose sub category',
            'field_value' => 'choose sub category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion - Visibility Settings',
            'field_value' => 'Visibility Settings'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Discussion - Add button',
            'field_value' => 'Add'
        ]);
        // screen 61
        $screen = Screens::create([
            'id'          => 61,
            'screen_name' => 'Discussion Details',
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Discussions-Label',
            'field_value' => 'Discussions'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Discussions-Description',
            'field_value' => 'Open forum for discussing topics which are trending or close to your heart, you can initiate it or simply contribute to others. '
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Mysite',
            'field_value' => 'Mysite'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Discussion',
            'field_value' => 'Groups'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Search',
            'field_value' => 'Search'
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Home-Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Link to Discussion',
            'field_value' => 'Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Breadcrumbs-3 edit discussion',
            'field_value' => 'edit discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content edit discussion-Edit Discussion Label',
            'field_value' => 'Edit Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content edit discussion-choose category Label',
            'field_value' => 'choose category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content edit discussion-choose Sub category Label',
            'field_value' => 'choose Sub category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content edit discussion-Visibility Settings Label',
            'field_value' => 'Visibility Settings'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content edit discussion-Save Button',
            'field_value' => 'Save'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Breadcrumbs-3 Stream It Discussion',
            'field_value' => 'Stream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Breadcrumbs-3 Visibility',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Breadcrumbs-3 Delete Discussion',
            'field_value' => 'Delete Discussion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Breadcrumbs-3 Discussion Grade It',
            'field_value' => 'Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Comments Label',
            'field_value' => 'Comments'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Add Comment button',
            'field_value' => 'Add Comment'
        ]);
        // screen 62
        $screen = Screens::create([
            'id'          => 62,
            'screen_name' => 'MarketPlace',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'MarketPlace Description Label',
            'field_value' => 'Description Label'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'MarketPlace Description',
            'field_value' => 'MarketPlace Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Your Store Button',
            'field_value' => 'Create Your Store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Browse Existing Stores Button',
            'field_value' => 'Browse Existing Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Create Ads & Campaigns Button',
            'field_value' => 'Create Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Browse Ads & Campaigns Button',
            'field_value' => 'Browse Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Stores',
            'field_value' => 'Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Business',
            'field_value' => 'Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Stores/Business',
            'field_value' => 'Stores/Business'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Ads & Campaigns',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-3 Health, Wellness & Fitness',
            'field_value' => 'Health, Wellness & Fitness'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Food & Nutrition',
            'field_value' => 'Food & Nutrition'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Beauty & Fashion',
            'field_value' => 'Beauty & Fashion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Education, Care & Parenting',
            'field_value' => 'Education, Care & Parenting'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 More',
            'field_value' => 'More'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content MarketPlace Recommendations',
            'field_value' => 'MarketPlace Recommendations'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content MarketPlace Recommendations-Show All',
            'field_value' => 'Show All'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Trending This Month',
            'field_value' => 'Trending This Month'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Trending This Month-Show All',
            'field_value' => 'Trending This Month'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RightMenu- Blogs',
            'field_value' => 'Blogs'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RightMenu- Events',
            'field_value' => 'Events'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RightMenu- Discussions',
            'field_value' => 'Discussions'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Videos Button',
            'field_value' => 'Videos'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content News',
            'field_value' => 'News'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Interviews',
            'field_value' => 'Interviews'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Articles',
            'field_value' => 'Articles'
        ]);
        // screen 63
        $screen = Screens::create([
            'id'          => 63,
            'screen_name' => 'Create Store-What Do I get',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1-Label - Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1 - Unique Opportunity Marketplace',
            'field_value' => 'Marketplace for showcasing stores and business services in 5 key categories Health, Wellness Fitness Food & Nutrition Beauty & Fashion Education, Care & Parenting Lifestyle'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1-Get Started button',
            'field_value' => 'Get Started'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2-Label-Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2 - Unique Opportunity Marketplace',
            'field_value' => 'You can open Product Store Business Store Store + Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2-Get Started button',
            'field_value' => 'Get Started'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Label-Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3 - Unique Opportunity Marketplace',
            'field_value' => 'If you are in business, go ahead an open your store. If your business is focused on women as a consumer, contact us. We will help you open a store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Contact Us button',
            'field_value' => 'Contact Us'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 What Do I Get',
            'field_value' => 'What Do I Get'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Types of Stores',
            'field_value' => 'Types of Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 FAQ',
            'field_value' => 'FAQ'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Label-Every Evezown member can claim a Store comprising of',
            'field_value' => 'Every Evezown member can claim a Store comprising of'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-4',
            'field_value' => 'Open a Store or Business services under any of 5 Categories and 250 plus subcategories. You can promote it through Steam It, Connect related blogs, Discussion and Events. Basic Store is free. Paid Standard and Customised stores provide enhanced features helping you to position and market your services.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-5 GET STARTED-Label',
            'field_value' => 'GET STARTED'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Get Started button',
            'field_value' => 'Get Started'
        ]);
        // screen 64
        $screen = Screens::create([
            'id'          => 64,
            'screen_name' => 'Create Store-Types of Stores',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1-Label - Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1 - Unique Opportunity Marketplace',
            'field_value' => 'Marketplace for showcasing stores and business services in 5 key categories Health, Wellness Fitness Food & Nutrition Beauty & Fashion Education, Care & Parenting Lifestyle'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1-Get Started button',
            'field_value' => 'Get Started'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2-Label-Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2 - Unique Opportunity Marketplace',
            'field_value' => 'You can open Product Store Business Store Store + Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2-Get Started button',
            'field_value' => 'Get Started'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Label-Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3 - Unique Opportunity Marketplace',
            'field_value' => 'If you are in business, go ahead an open your store. If your business is focused on women as a consumer, contact us. We will help you open a store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Contact Us button',
            'field_value' => 'Contact Us'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 What Do I Get',
            'field_value' => 'What Do I Get'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Types of Stores',
            'field_value' => 'Types of Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 FAQ',
            'field_value' => 'FAQ'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Label-Types of Eve-Stores',
            'field_value' => 'Types of Eve-Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-4-Description',
            'field_value' => 'We offer three type of stores - Basic Store, Marketplace Standard Store and Customised Store. Basic store is full featured store with visibility limited to closed private community of the store owner and it resides on members Mysite. Paid standard provides full features and visibility in browse store section on Marketplace. Apart from providing customer features, Customised Stores provides unlimited visibility with visibility in browse store section on Marketplace with customised priority on Evezown landing pages as well.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Basic Store(free)',
            'field_value' => 'Basic Store(free)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 MarketPlace Standard Store',
            'field_value' => 'MarketPlace Standard Store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 MarketPlace Customised',
            'field_value' => 'MarketPlace Customised'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu-Access',
            'field_value' => 'Access'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu-Create Store',
            'field_value' => 'Create Store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu-Visibility',
            'field_value' => 'Visibility'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu-Features',
            'field_value' => 'Features'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu-Store Listing',
            'field_value' => 'Store Listing'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu-Streaming',
            'field_value' => 'Streaming'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu-Ads & Campaigns feature',
            'field_value' => 'Ads & Campaigns feature'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-LeftMenu- Pricing of Stores',
            'field_value' => ' Pricing of Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)-Access',
            'field_value' => 'Open to all members,free for members'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)-Create Store',
            'field_value' => 'Through Mysite or Marketplace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)-Visibility',
            'field_value' => 'Limited - only to private community of the store owner'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)-Features',
            'field_value' => ' All Store elements enabled but visiblity limited to private circles.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)-Store Listing',
            'field_value' => ' Listed under 250 plus sub-categories'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)-Streaming',
            'field_value' => 'Closed users, private Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)-Ads & Campaigns feature',
            'field_value' => 'Link to Ads & Campaigns for streaming for eg special deals, new product launch etc.,'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Basic Store(Free)- Pricing of Stores',
            'field_value' => ' Transaction fee per transaction for using the payment gateway services. Logistics, Packaging, Frieght & other charges are not included'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store-Access',
            'field_value' => 'Open to all members'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store-Create Store',
            'field_value' => 'Through Mysite or Marketplace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store-Visibility',
            'field_value' => 'Unlimited'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store-Features',
            'field_value' => 'All store elements enabled'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store-Store Listing',
            'field_value' => 'Listed under 250 plus sub-categories'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store-Streaming',
            'field_value' => 'Closed users, private Community'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store-Ads & Campaigns feature',
            'field_value' => 'Link to Ads & Campaigns for streaming for eg special deals, new product launch etc.,'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Standard Store- Pricing of Stores',
            'field_value' => 'Fixed price, Rs.24000 per annum ( limted to Rs.5Lac per annum revenue) Payment Gateway charges are additional, Logistics, Packaging, Frieght & other charges are not included'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised-Access',
            'field_value' => 'Open to all members and non members who want to purchase this option.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised-Create Store',
            'field_value' => 'Through Marketplace with customised admin controls and offline intervention'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised-Visibility',
            'field_value' => ' Unlimited Visibility like Paid standard, in addition customised priority on Evezown, MarketPlace landing pages.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised-Features',
            'field_value' => 'All store elements enabled , in addition customisation and add-ons can be done as per requirement,for eg. Visual presentation, analytics, promotion & branding can be enhanced'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised-Store Listing',
            'field_value' => 'Listed under 250 plus sub-categories,special sub category can be created if required to improve searchability.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised-Streaming',
            'field_value' => 'Standard promotion features plus additional customised web pomotional features as per requirement of the category, subcategory'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised-Ads & Campaigns feature',
            'field_value' => ' Paid Store features plus additional customised branding and marketing features as per requirement'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-MarketPlace Customised- Pricing of Stores',
            'field_value' => 'Custom Pricing based on member requirement specification, would be quoted offline'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Label- GET STARTED',
            'field_value' => 'GET STARTED'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-5',
            'field_value' => 'It is easy to create a store on Evezown. Get Started now.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Get Started button',
            'field_value' => 'Get Started'
        ]);
        // screen 65
        $screen = Screens::create([
            'id'          => 65,
            'screen_name' => 'frequently asked questions FAQ',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1-Label - Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1 - Unique Opportunity Marketplace',
            'field_value' => 'Marketplace for showcasing stores and business services in 5 key categories Health, Wellness Fitness Food & Nutrition Beauty & Fashion Education, Care & Parenting Lifestyle'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-1-Get Started button',
            'field_value' => 'Get Started'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2-Label-Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2 - Unique Opportunity Marketplace',
            'field_value' => 'You can open Product Store Business Store Store + Business'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-2-Get Started button',
            'field_value' => 'Get Started'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Label-Unique Opportunity Marketplace',
            'field_value' => 'UNIQUE OPPORTUNITY MARKETPLACE'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3 - Unique Opportunity Marketplace',
            'field_value' => 'If you are in business, go ahead an open your store. If your business is focused on women as a consumer, contact us. We will help you open a store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-3-Contact Us button',
            'field_value' => 'Contact Us'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 What Do I Get',
            'field_value' => 'What Do I Get'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Types of Stores',
            'field_value' => 'Types of Stores'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 FAQ',
            'field_value' => 'FAQ'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Label-FAQs on Store',
            'field_value' => 'FAQs on Store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Open Store',
            'field_value' => 'FAQ 1 : Open Store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Open Store - How to open an Store?',
            'field_value' => 'How to open an Store?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Open Store -  Who can open an Store?',
            'field_value' => 'Who can open an Store?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Open Store -  How many stores can i open?',
            'field_value' => 'How many stores can i open?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Products',
            'field_value' => 'FAQ 1 : Manage Products'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Products -  How do i manage my products?',
            'field_value' => 'How do i manage my products?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Products -  How many products can i add under free store?',
            'field_value' => 'How many products can i add under free store?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Products -  How many SKU\'s can be added?',
            'field_value' => 'How many SKU\'s can be added?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Customers',
            'field_value' => 'FAQ 1 : Manage Customers'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Customers - How do i manage my products?',
            'field_value' => 'How do i manage my products?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Customers -  How many products can i add under free store?',
            'field_value' => 'How many products can i add under free store?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Label-FAQ 1 : Manage Customers - How many SKUs can be added?',
            'field_value' => 'How many SKUs can be added?'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Label- GET STARTED',
            'field_value' => 'GET STARTED'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-5',
            'field_value' => 'It is easy to create a store on Evezown. Get Started now.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content-Get Started button',
            'field_value' => 'Get Started'
        ]);
        // screen 66
        $screen = Screens::create([
            'id'          => 66,
            'screen_name' => 'Marketplace Browse Store',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 - Home- link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 - MarketPlace- link',
            'field_value' => 'MarketPlace'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Search store',
            'field_value' => 'Search store'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Advance Search- link',
            'field_value' => 'Advance Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Advance Search- Advanced Search with Filter - Label',
            'field_value' => 'Advanced Search with Filter'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Advance Search- Clear Search - Link',
            'field_value' => 'Clear Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Search Key: - Label',
            'field_value' => 'Search Key:'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Location: - Label',
            'field_value' => 'Location:'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Store type: - Label',
            'field_value' => 'Store type:'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Category:: - Label',
            'field_value' => 'Category:'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Close Button',
            'field_value' => 'Close'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Browse Store - Search Button',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Store - Explore Store - Link',
            'field_value' => 'Explore Store'
        ]);
        // screen 67
        $screen = Screens::create([
            'id'          => 67,
            'screen_name' => 'Create Ads & Campaigns-Step1',
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Description-Label',
            'field_value' => 'Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Description',
            'field_value' => 'Welcome to Ads & Campaigns creation page. If you are a store owner, you can create an ad for your store - be it deals, new product or service. If you are a consumer, you can create your favourite product or service as a poster for promotion. This is a structured way of creating and promoting and building a campaign...you can stream to your evezown community or share it with your friends or cusomers on social networks. All In 3 simple steps! Start here by choosing the type of Ads & Campaigns and the category/sub-category you would like it to be listed under.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Label - Choose Ads & Campaigns Type',
            'field_value' => 'Choose Ads & Campaigns Type'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Label - You want to create Ads & Campaigns for',
            'field_value' => 'You want to create Ads & Campaigns for'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Label - Category',
            'field_value' => 'Category'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Label - Subcategory',
            'field_value' => 'Subcategory'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Label - Specify',
            'field_value' => 'Specify'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Label - Duration (Choose Date Range)',
            'field_value' => 'Duration (Choose Date Range)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Label - Tag Keywords',
            'field_value' => 'Tag Keywords'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Next-Button',
            'field_value' => 'Next'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step1 - Discard-Link',
            'field_value' => 'Discard'
        ]);
         // screen 68
        $screen = Screens::create([
            'id'          => 68,
            'screen_name' => 'Create Ads & Campaigns-Step2',
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Step 2-Description-Label',
            'field_value' => 'Step 2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Step2-Description',
            'field_value' => 'Choose the type of Ads & Campaigns layout you prefer from the 4 standard options provided. Provide Title, description, images you would like to have in the Ads & Campaigns. You can mention the price, if you would like to. Provide contact details and store location details, (if you have a physical store)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - Choose Layout of Ads & Campaigns',
            'field_value' => 'Choose Layout of Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - Title',
            'field_value' => 'Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - Body Description',
            'field_value' => 'Body Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - Title Image',
            'field_value' => 'Title Image'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - The Ads & Campaigns consists of 4 Body Images',
            'field_value' => 'The Ads & Campaigns consists of 4 Body Images'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - Deal Description or Price Box',
            'field_value' => 'Deal Description or Price Box'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - Contact Details',
            'field_value' => 'Contact Details'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Label - Store Location',
            'field_value' => 'Store Location'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Preview Ads & Campaigns - Button',
            'field_value' => 'Preview Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step2 - Next - Button',
            'field_value' => 'Next'
        ]);
        // screen 69
        $screen = Screens::create([
            'id'          => 69,
            'screen_name' => 'Create Ads & Campaigns-Step3',
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Step 3-Description-Label',
            'field_value' => 'Step 3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Step3-Description',
            'field_value' => 'Choose how you would like to use the Ads & Campaigns, both on evezown.com and other social network sites. You can choose where you would like it steamed on evezown.com and on other social network sites. If you would like to receive enquiries, tick the enquiry button. Choose the kind of analytics you would like for your Ads & Campaigns for eg., no of enquiries or grade it etc., You can choose one or more options.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step1',
            'field_value' => 'Step1'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step2',
            'field_value' => 'Step2'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1-Step3',
            'field_value' => 'Step3'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Label - Choose Layout of Ads & Campaigns',
            'field_value' => 'Choose Layout of Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Label - Your Target Audience (send to)',
            'field_value' => 'Your Target Audience (send to)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Label - Your Personal Circles',
            'field_value' => 'Your Personal Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - My Friends',
            'field_value' => 'My Friends'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - My Circles',
            'field_value' => 'My Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Only Me',
            'field_value' => ' Only Me'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Open to Public',
            'field_value' => 'Open to Public'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Add Enquiry Button',
            'field_value' => 'Add Enquiry Button'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Label -  Promote to other sites',
            'field_value' => 'Promote to other sites'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Facebook',
            'field_value' => 'Facebook'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Whats App',
            'field_value' => 'Whats App'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Google Plus',
            'field_value' => 'Google Plus'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Twitter',
            'field_value' => 'Twitter'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - Direct Messages (SMS)',
            'field_value' => 'Direct Messages (SMS)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -  Gmail',
            'field_value' => 'Gmail'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - Linked In',
            'field_value' => 'Linked In'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - Email',
            'field_value' => 'Email'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Label -Choose Analytics Reports',
            'field_value' => 'Choose Analytics Reports'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - No. of Views',
            'field_value' => 'No. of Views'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - No. of Enquiries',
            'field_value' => 'No. of Enquiries'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -No. of Sends',
            'field_value' => 'No. of Sends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox -No. of Grade It',
            'field_value' => 'No. of Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Checkbox - Do you want visibility of summary on Ads & Campaigns page',
            'field_value' => 'Do you want visibility of summary on Ads & Campaigns page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 -  Preview Ads & Campaigns-Button',
            'field_value' => 'Preview Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Step3 - Finish-Button',
            'field_value' => 'Finish'
        ]);
        // screen 70
        $screen = Screens::create([
            'id'          => 70,
            'screen_name' => 'Create Ads & Campaigns-Success Page',
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Success Page-Label-Ads & Campaigns Created Successfully.',
            'field_value' => 'Ads & Campaigns Created Successfully.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Success Page-Description-Your Ads & Campaigns is ready. You can publish it right away or preview it or make further edits.',
            'field_value' => 'Your Ads & Campaigns is ready. You can publish it right away or preview it or make further edits.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Success Page-Preview Ads & Campaigns Now - Button',
            'field_value' => 'Preview Ads & Campaigns Now'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Success Page-Publish Ads & Campaigns Now - Button',
            'field_value' => 'Publish Ads & Campaigns Now'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Success Page-Manage Ads & Campaigns Now - Button',
            'field_value' => 'Manage Ads & Campaigns Now'
        ]);
        // screen 71
        $screen = Screens::create([
            'id'          => 71,
            'screen_name' => 'Ads & Campaigns-Details Page',
        ]);
        
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Home Page -Link',
            'field_value' => 'Home'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace -Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Browse Ads & Campaigns -Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Details Page - Publish Button',
            'field_value' => 'Publish'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns-Details Page - Manage Button',
            'field_value' => 'Manage'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Comments',
            'field_value' => 'Comments'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Grade It',
            'field_value' => 'Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Restream It',
            'field_value' => 'Restream It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-2 Enquiry/Request For Information(RFI)',
            'field_value' => 'Enquiry/Request For Information(RFI)'
        ]);
        // screen 72
        $screen = Screens::create([
            'id'          => 72,
            'screen_name' => 'Manage Ads & Campaigns -Ads & Campaigns Type Page',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace -Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Type Page- Leftmenu-Ads & Campaigns Type',
            'field_value' => 'Ads & Campaigns Type'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Type Page- Leftmenu-Ads & Campaigns Info',
            'field_value' => 'Ads & Campaigns Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Type Page- Leftmenu-Ads & Campaigns Promotion',
            'field_value' => 'Ads & Campaigns Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Type Page- Leftmenu-Ads & Campaigns RFI',
            'field_value' => 'Ads & Campaigns RFI'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Type Page-Description-Label-Choose Ads & Campaigns Type',
            'field_value' => 'Choose Ads & Campaigns Type'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Type Page- Description',
            'field_value' => 'You can edit the Ads & Campaigns Type here. You can edit the Ads & Campaigns title and description. You can change the category or sub-category of your Ads & Campaigns listing.'
        ]);

         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Choose Ads & Campaigns Type',
            'field_value' => 'Choose Ads & Campaigns Type'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - You want to create Ads & Campaigns for',
            'field_value' => 'You want to create Ads & Campaigns for'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Category',
            'field_value' => 'Category'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Subcategory',
            'field_value' => 'Subcategory'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Specify',
            'field_value' => 'Specify'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Duration (Choose Date Range)',
            'field_value' => 'Duration (Choose Date Range)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Tag Keywords',
            'field_value' => 'Tag Keywords'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Save-Button',
            'field_value' => 'Save'
        ]);
        // screen 73
        $screen = Screens::create([
            'id'          => 73,
            'screen_name' => 'Manage Ads & Campaigns -Ads & Campaigns Info Page',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace -Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Info Page- Leftmenu-Ads & Campaigns Type',
            'field_value' => 'Ads & Campaigns Type'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Info Page- Leftmenu-Ads & Campaigns Info',
            'field_value' => 'Ads & Campaigns Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Info Page- Leftmenu-Ads & Campaigns Promotion',
            'field_value' => 'Ads & Campaigns Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Info Page- Leftmenu-Ads & Campaigns RFI',
            'field_value' => 'Ads & Campaigns RFI'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Info Page-Description-Label-Choose Ads & Campaigns Info',
            'field_value' => 'Choose Ads & Campaigns Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Info Page-Description',
            'field_value' => 'You can edit the Ads & Campaigns info here. You can edit the Ads & Campaigns title and description. You can change the category or sub-category of your Ads & Campaigns listing.'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns Info Page-Label-Choose Ads & Campaigns Info',
            'field_value' => 'Choose Ads & Campaigns Info'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Title',
            'field_value' => 'Title'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Body Description',
            'field_value' => 'Body Description'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Title Image',
            'field_value' => 'Title Image'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - The Ads & Campaigns consists of 4 Body Images',
            'field_value' => 'The Ads & Campaigns consists of 4 Body Images'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Deal Description or Price Box',
            'field_value' => 'Deal Description or Price Box'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Contact Details',
            'field_value' => 'Contact Details'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Store Location',
            'field_value' => 'Store Location'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Preview Ads & Campaigns - Button',
            'field_value' => 'Preview Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Save-Button',
            'field_value' => 'Save'
        ]);
        // screen 74
        $screen = Screens::create([
            'id'          => 74,
            'screen_name' => 'Manage Ads & Campaigns -Ads & Campaigns Promotion Page',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace -Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Promotion Page- Leftmenu-Ads & Campaigns Type',
            'field_value' => 'Ads & Campaigns Type'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Promotion Page- Leftmenu-Ads & Campaigns Info',
            'field_value' => 'Ads & Campaigns Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Promotion Page- Leftmenu-Ads & Campaigns Promotion',
            'field_value' => 'Ads & Campaigns Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Promotion Page- Leftmenu-Ads & Campaigns RFI',
            'field_value' => 'Ads & Campaigns RFI'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Promotion Page-Description-Label-Choose Ads & Campaigns Promotion',
            'field_value' => 'Choose Ads & Campaigns Promotion'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns Promotion Page-Description',
            'field_value' => 'You can edit the Ads & Campaigns Promotion here. You can edit the Ads & Campaigns title and description. You can change the category or sub-category of your Ads & Campaigns listing.'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns Promotion Page-Label-Choose Ads & Campaigns Promotion',
            'field_value' => 'Choose Ads & Campaigns Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-Label - Your Target Audience (send to)',
            'field_value' => 'Your Target Audience (send to)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label - Your Personal Circles',
            'field_value' => 'Your Personal Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - My Friends',
            'field_value' => 'My Friends'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - My Circles',
            'field_value' => 'My Circles'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Only Me',
            'field_value' => ' Only Me'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Open to Public',
            'field_value' => 'Open to Public'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Add Enquiry Button',
            'field_value' => 'Add Enquiry Button'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label -  Promote to other sites',
            'field_value' => 'Promote to other sites'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Facebook',
            'field_value' => 'Facebook'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Whats App',
            'field_value' => 'Whats App'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Google Plus',
            'field_value' => 'Google Plus'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Twitter',
            'field_value' => 'Twitter'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - Direct Messages (SMS)',
            'field_value' => 'Direct Messages (SMS)'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -  Gmail',
            'field_value' => 'Gmail'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - Linked In',
            'field_value' => 'Linked In'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - Email',
            'field_value' => 'Email'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Label -Choose Analytics Reports',
            'field_value' => 'Choose Analytics Reports'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - No. of Views',
            'field_value' => 'No. of Views'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - No. of Enquiries',
            'field_value' => 'No. of Enquiries'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -No. of Sends',
            'field_value' => 'No. of Sends'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox -No. of Grade It',
            'field_value' => 'No. of Grade It'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Checkbox - Do you want visibility of summary on Ads & Campaigns page',
            'field_value' => 'Do you want visibility of summary on Ads & Campaigns page'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns-  Preview Ads & Campaigns-Button',
            'field_value' => 'Preview Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Ads & Campaigns- Save-Button',
            'field_value' => 'Save'
        ]);
        // screen 75
        $screen = Screens::create([
            'id'          => 75,
            'screen_name' => 'Manage Ads & Campaigns -Ads & Campaigns RFI Page',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace -Link',
            'field_value' => 'MarketPlace'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns RFI Page- Leftmenu-Ads & Campaigns Type',
            'field_value' => 'Ads & Campaigns Type'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns RFI Page- Leftmenu-Ads & Campaigns Info',
            'field_value' => 'Ads & Campaigns Info'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns RFI Page- Leftmenu-Ads & Campaigns Promotion',
            'field_value' => 'Ads & Campaigns Promotion'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns RFI Page- Leftmenu-Ads & Campaigns RFI',
            'field_value' => 'Ads & Campaigns RFI'
        ]);

        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns RFI Page-Description-Label-Ads & Campaigns Request for Info',
            'field_value' => 'Ads & Campaigns Request for Info'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Ads & Campaigns RFI Page-Description',
            'field_value' => 'You can see all the request for info sent by users here.'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Lable Enquirer',
            'field_value' => 'Enquirer'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI-Lable -Date ',
            'field_value' => 'Date'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI Sender-Lable-Phone Number ',
            'field_value' => 'Phone Number'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI Sender-Lable-Email Id ',
            'field_value' => 'Email Id'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content RFI Form-Lable- Show More Button ',
            'field_value' => 'Show More'
        ]);
        // screen 76
        $screen = Screens::create([
            'id'          => 76,
            'screen_name' => 'MarketPlace Browse Ads & Campaigns',
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 Home -Link',
            'field_value' => 'Home'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Breadcrumbs-1 MarketPlace -Link',
            'field_value' => 'MarketPlace'
        ]);
         ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Search',
            'field_value' => 'Search Ads & Campaigns'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Advance Search',
            'field_value' => 'Advance Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Advanced Search with Filter',
            'field_value' => 'Advanced Search with Filter'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Advanced Search with Filter-Search Key',
            'field_value' => 'Search Key'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Advanced Search with Filter-Location',
            'field_value' => 'Location'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Advanced Search with Filter-Category',
            'field_value' => 'Category'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Advanced Search with Filter-Close button',
            'field_value' => 'Close'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Advanced Search with Filter-Search button',
            'field_value' => 'Search'
        ]);
        ScreenFields::create([
            'screen_id'   => $screen->id,
            'field_name'  => 'Content Browse Ads & Campaigns - Show Details',
            'field_value' => 'Show details'
        ]);
    }
}
