<?php

namespace Database\Seeders;

use App\Models\Forum;
use App\Models\Post;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get users
        $admin = User::where('email', 'admin@forum.com')->first();
        $moderator = User::where('email', 'moderator@forum.com')->first();
        $john = User::where('email', 'john@forum.com')->first();
        $jane = User::where('email', 'jane@forum.com')->first();

        // Create Forums
        $generalForum = Forum::create([
            'name' => 'General Discussion',
            'description' => 'A place for general discussions and conversations about anything.',
            'is_active' => true,
        ]);

        $techForum = Forum::create([
            'name' => 'Technology',
            'description' => 'Discuss the latest in technology, programming, and software development.',
            'is_active' => true,
        ]);

        $sportsForum = Forum::create([
            'name' => 'Sports',
            'description' => 'Talk about your favorite sports, teams, and athletes.',
            'is_active' => true,
        ]);

        // Assign moderators
        $generalForum->moderators()->attach($moderator->id);
        $techForum->moderators()->attach($moderator->id);

        // Create Topics and Posts
        $topic1 = Topic::create([
            'title' => 'Welcome to the Forum!',
            'body' => 'This is a welcome message to all new members. Feel free to introduce yourself and start participating in discussions!',
            'user_id' => $admin->id,
            'forum_id' => $generalForum->id,
        ]);

        Post::create([
            'body' => 'Thanks for the welcome! Looking forward to being part of this community.',
            'user_id' => $john->id,
            'topic_id' => $topic1->id,
        ]);

        Post::create([
            'body' => 'Great to be here! This forum looks amazing.',
            'user_id' => $jane->id,
            'topic_id' => $topic1->id,
        ]);

        $topic2 = Topic::create([
            'title' => 'Laravel 12 Features',
            'body' => 'What are your favorite new features in Laravel 12? Let\'s discuss!',
            'user_id' => $john->id,
            'forum_id' => $techForum->id,
        ]);

        Post::create([
            'body' => 'I really like the new routing system. It\'s much cleaner!',
            'user_id' => $jane->id,
            'topic_id' => $topic2->id,
        ]);

        $topic3 = Topic::create([
            'title' => 'Best Programming Languages in 2024',
            'body' => 'What programming languages do you think are the best to learn in 2024?',
            'user_id' => $jane->id,
            'forum_id' => $techForum->id,
        ]);

        Post::create([
            'body' => 'I think Python and JavaScript are still the top choices for beginners.',
            'user_id' => $john->id,
            'topic_id' => $topic3->id,
        ]);

        $topic4 = Topic::create([
            'title' => 'Favorite Sports Teams',
            'body' => 'Share your favorite sports teams and why you support them!',
            'user_id' => $john->id,
            'forum_id' => $sportsForum->id,
        ]);

        Post::create([
            'body' => 'I\'m a huge fan of basketball. The Lakers are my team!',
            'user_id' => $jane->id,
            'topic_id' => $topic4->id,
        ]);
    }
}
