<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravelium\Sitemap\Sitemap;
use App\Models\Topic;
use App\Models\User;

class SitemapController extends Controller
{
    public function index(Sitemap $sitemap, Topic $topic, User $user)
    {
        $sitemap->setCache('larabbs.sitemap-index', 60);

        if (!$sitemap->isCached()) {
            $lastTopic = $topic->orderBy('updated_at', 'desc')->first();
            $lastUser = $user->orderBy('updated_at', 'desc')->first();

            $sitemap->addSitemap(route('sitemap.topics.index'), $lastTopic->updated_at->toAtomString());
            $sitemap->addSitemap(route('sitemap.users.index'), $lastUser->updated_at->toAtomString());
        }

        return $sitemap->render('sitemapindex');
    }

    public function topics(Sitemap $sitemap, Topic $topic)
    {
        $sitemap->setCache('larabbs.sitemap-topics', 60);

        if (!$sitemap->isCached()) {

            $topic->orderBy('updated_at', 'desc')->chunk(500, function($topics) use ($sitemap) {

                foreach ($topics as $topic) {
                    $sitemap->add($topic->link(), $topic->updated_at->toAtomString(), '0.8', 'daily');
                }
            });
        }

        return $sitemap->render('xml');
    }

    public function users(Sitemap $sitemap, User $user)
    {
        $sitemap->setCache('larabbs.sitemap-users', 60);

        if (!$sitemap->isCached()) {

            $user->orderBy('updated_at', 'desc')->chunk(500, function($users) use ($sitemap) {

                foreach ($users as $user) {
                    $sitemap->add(route('users.show', $user), $user->updated_at->toAtomString(), '0.8', 'daily');
                }
            });
        }

        return $sitemap->render('xml');
    }
}
