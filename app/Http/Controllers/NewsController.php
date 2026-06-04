<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    private function getSamplePosts()
    {
        return [
            [
                'id' => 1,
                'slug' => 'the-art-of-slow-coffee',
                'title' => 'The Art of Slow Coffee: Why V60 is Still King',
                'category' => 'Brewing Tips',
                'author' => 'Barista Joe',
                'date' => 'May 10, 2024',
                'read_time' => '5 min read',
                'image' => 'https://images.unsplash.com/photo-1544787210-282aa065362e?q=80&w=1974&auto=format&fit=crop',
                'excerpt' => 'Menyeduh kopi bukan sekadar rutinitas, melainkan meditasi. Pelajari mengapa metode V60 tetap menjadi favorit para pecinta kopi spesialti di seluruh dunia.',
                'featured' => true,
            ],
            [
                'id' => 2,
                'slug' => 'arabica-vs-robusta-deep-dive',
                'title' => 'Arabica vs Robusta: Mana yang Cocok Untuk Anda?',
                'category' => 'Coffee Education',
                'author' => 'Sarah K.',
                'date' => 'May 08, 2024',
                'read_time' => '8 min read',
                'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=2070&auto=format&fit=crop',
                'excerpt' => 'Memahami perbedaan mendasar antara dua varietas kopi paling populer di dunia dan bagaimana pengaruhnya terhadap profil rasa di cangkir Anda.',
                'featured' => false,
            ],
            [
                'id' => 3,
                'slug' => 'latte-art-trends-2024',
                'title' => 'Tren Latte Art 2024: Dari Rosetta Hingga 3D Art',
                'category' => 'Latte Art',
                'author' => 'Mike Chen',
                'date' => 'May 05, 2024',
                'read_time' => '4 min read',
                'image' => 'https://images.unsplash.com/photo-1512568400610-62da28bc8a13?q=80&w=1974&auto=format&fit=crop',
                'excerpt' => 'Eksplorasi kreativitas tanpa batas di atas secangkir kopi. Tren terbaru yang akan mendominasi kejuaraan barista tahun ini.',
                'featured' => false,
            ],
            [
                'id' => 4,
                'slug' => 'specialty-coffee-business-growth',
                'title' => 'Masa Depan Bisnis Kopi Spesialti di Indonesia',
                'category' => 'Coffee Business',
                'author' => 'Ahmad R.',
                'date' => 'May 02, 2024',
                'read_time' => '10 min read',
                'image' => 'https://images.unsplash.com/photo-1442512595331-e89e73853f31?q=80&w=2070&auto=format&fit=crop',
                'excerpt' => 'Analisis mendalam mengenai pertumbuhan pesat industri kopi gelombang ketiga dan peluang bagi para pengusaha muda.',
                'featured' => false,
            ],
            [
                'id' => 5,
                'slug' => 'perfect-espresso-extraction',
                'title' => 'Rahasia Ekstraksi Espresso yang Sempurna',
                'category' => 'Barista',
                'author' => 'Barista Joe',
                'date' => 'April 28, 2024',
                'read_time' => '12 min read',
                'image' => 'https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?q=80&w=2070&auto=format&fit=crop',
                'excerpt' => 'Tingkatkan kualitas espresso Anda dengan memahami variabel penting: gilingan, dosis, suhu, dan tekanan.',
                'featured' => false,
            ],
            [
                'id' => 6,
                'slug' => 'coffee-beans-storage-tips',
                'title' => 'Cara Menyimpan Biji Kopi Agar Tetap Segar',
                'category' => 'Coffee Beans',
                'author' => 'Sarah K.',
                'date' => 'April 25, 2024',
                'read_time' => '6 min read',
                'image' => 'https://images.unsplash.com/photo-1559056199-641a0ac8b55e?q=80&w=2070&auto=format&fit=crop',
                'excerpt' => 'Kesegaran adalah kunci. Panduan praktis untuk menjaga aromatik dan cita rasa biji kopi Anda bertahan lebih lama.',
                'featured' => false,
            ],
        ];
    }

    public function index()
    {
        $posts = $this->getSamplePosts();
        $featuredPost = collect($posts)->where('featured', true)->first();
        $latestPosts = collect($posts)->where('featured', false)->take(6);
        $trendingTags = ['Coffee Trends', 'Brewing Tips', 'Beans', 'Lifestyle', 'Latte Art', 'Business'];

        return view('pages.news', compact('featuredPost', 'latestPosts', 'trendingTags'));
    }

    public function show($slug)
    {
        $posts = $this->getSamplePosts();
        $post = collect($posts)->where('slug', $slug)->first();
        
        if (!$post) {
            abort(404);
        }

        $relatedPosts = collect($posts)->where('slug', '!=', $slug)->take(3);

        return view('pages.news-detail', compact('post', 'relatedPosts'));
    }
}
