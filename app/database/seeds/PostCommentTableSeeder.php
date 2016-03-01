<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostCommentTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$friend = UserProfile::find(2)->friends()->first();

		$post = Post::where('owner_id', 2)->first();

		foreach(range(1, 5) as $index)
		{
			$comment = Comment::Create([
				'comment' => $faker->text($maxNbChars = 50),
			]);

			$postComment = PostComment::Create([
				'owner_id' => 2,
				'post_id' => 10,
				'comment_id' => $comment->id,
			]);
		}
	}

}