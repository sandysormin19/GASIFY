<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomepageContentController extends Controller
{
    public function edit()
    {
        // Ambil data atau buat default jika belum ada
        $hero = HomepageContent::firstOrCreate(
            ['section' => 'hero'],
            ['content' => [
                'title' => 'Pesan Gas LPG <span class="text-green-600">dengan Mudah</span>',
                'subtitle' => 'Gasify hadir untuk kenyamanan rumah Anda. Tinggal klik, gas langsung sampai!',
                'button_text' => 'Pesan Sekarang',
                'button_url' => '/order/create',
                'image_url' => 'admin/images/Home/deliverygas.jpg'
            ], 'is_active' => true]
        );

        $orderToolsTitle = HomepageContent::firstOrCreate(
            ['section' => 'order_tools_title'],
            ['content' => [
                'title' => 'Fitur <span class="text-green-600">Gasify</span>',
                'subtitle' => 'Gunakan fitur praktis kami untuk pengalaman yang lebih mudah dan cepat.'
            ], 'is_active' => true]
        );
        
        $orderTool1 = HomepageContent::firstOrCreate(
            ['section' => 'order_tool_1'],
            ['content' => [
                'title' => 'Riwayat Pemesanan',
                'description' => 'Cek riwayat pemesanan Anda secara praktis & detail.',
                'url' => '/order-history', 
                'icon_svg_path' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' 
            ], 'is_active' => true]
        );

        $orderTool2 = HomepageContent::firstOrCreate(
            ['section' => 'order_tool_2'],
            ['content' => [
                'title' => 'Lacak Kurir',
                'description' => 'Lihat posisi kurir Anda secara real-time dan akurat.',
                'url' => '/order-history', 
                'icon_svg_path' => 'M12 2c2.21 0 4 1.79 4 4 0 3.53-4 8-4 8s-4-4.47-4-8c0-2.21 1.79-4 4-4zM12 12a2 2 0 100-4 2 2 0 000 4zm0 10c-4.418 0-8-1.79-8-4v-1c0-.552.448-1 1-1h14c.552 0 1 .448 1 1v1c0 2.21-3.582 4-8 4z' 
            ], 'is_active' => true]
        );

        $faqTitle = HomepageContent::firstOrCreate(
            ['section' => 'faq_title'],
            ['content' => [
                'title' => 'Pertanyaan <span class="text-green-600">Umum (FAQ)</span>',
                'subtitle' => 'Temukan jawaban atas pertanyaan yang sering diajukan.'
            ], 'is_active' => true]
        );

        // Fetch atau buat record FAQ
        // Gunakan nama variabel $faqs agar sesuai dengan yang diharapkan view
        $faqs = HomepageContent::where('section', 'faqs')->first();
        if (!$faqs) {
            $faqs = HomepageContent::create([ // Gunakan create agar objeknya adalah instance model
                'section' => 'faqs',
                'content' => [ // Default content jika tidak ada
                    // Anda bisa kosongkan ini jika tidak ingin default saat pertama kali
                    // ['q' => 'Default Q jika tabel kosong', 'a' => 'Default A jika tabel kosong'], 
                ],
                'is_active' => true // Atau false sebagai default
            ]);
        }

        $promoTitle = HomepageContent::firstOrCreate(
            ['section' => 'promo_title'],
            ['content' => [
                'title' => 'Promo <span class="text-green-600">Spesial</span>',
                'subtitle' => 'Dapatkan penawaran menarik dan diskon terbatas dari Gasify!'
            ], 'is_active' => true]
        );

        // Fetch atau buat record Promo
        // Gunakan nama variabel $promos agar sesuai dengan yang diharapkan view
        $promos = HomepageContent::where('section', 'promos')->first();
        if (!$promos) {
            $promos = HomepageContent::create([ // Gunakan create
                'section' => 'promos',
                'content' => [
                    // ['title' => 'Default Promo Title jika kosong', 'desc' => 'Default Promo Desc jika kosong'],
                ],
                'is_active' => true // Atau false sebagai default
            ]);
        }

        // Hapus semua dd() jika masih ada dari debugging sebelumnya
        
        return view('admin.homepage.edit', compact(
            'hero', 
            'orderToolsTitle', 'orderTool1', 'orderTool2',
            'faqTitle', 
            'faqs',  // Variabel $faqs sekarang sudah terdefinisi dengan benar
            'promoTitle', 
            'promos' // Variabel $promos sekarang sudah terdefinisi dengan benar
        ));
    }

    // ... (method update() Anda yang sudah kita perbaiki sebelumnya) ...
    public function update(Request $request)
    {
        // Pastikan method update Anda menggunakan logika yang sudah benar
        // untuk memproses $faqsData dan $promosData
        // seperti yang ada di respons saya sebelumnya.

        // Update Hero Section
        $heroDataForUpdate = [
            'title' => $request->input('hero_title'),
            'subtitle' => $request->input('hero_subtitle'),
            'button_text' => $request->input('hero_button_text'),
            'button_url' => $request->input('hero_button_url'),
        ];
        $currentHero = HomepageContent::where('section', 'hero')->first();
        $currentImageUrl = $currentHero ? ($currentHero->content['image_url'] ?? 'admin/images/Home/deliverygas.jpg') : 'admin/images/Home/deliverygas.jpg';
        $heroDataForUpdate['image_url'] = $request->input('hero_image_url', $currentImageUrl);

        HomepageContent::updateOrCreate(
            ['section' => 'hero'],
            ['content' => $heroDataForUpdate, 'is_active' => $request->has('hero_is_active')]
        );
        
        if ($request->hasFile('hero_image_new')) {
            $heroRecord = HomepageContent::where('section', 'hero')->first();
            if ($heroRecord) { 
                $oldImageUrl = $heroRecord->content['image_url'] ?? null;

                if ($oldImageUrl && 
                    $oldImageUrl !== 'admin/images/Home/deliverygas.jpg' && 
                    !Str::startsWith($oldImageUrl, 'http') &&
                    Storage::disk('public')->exists(Str::replaceFirst('/storage/', '', $oldImageUrl))) {
                    Storage::disk('public')->delete(Str::replaceFirst('/storage/', '', $oldImageUrl));
                }

                $path = $request->file('hero_image_new')->store('homepage_images', 'public'); 
                $newUrl = Storage::url($path); 
                
                $content = $heroRecord->content;
                $content['image_url'] = $newUrl; 
                $heroRecord->content = $content;
                $heroRecord->save();
            }
        }

        // Update Order Tools Title, Tool 1, Tool 2, FAQ Title, Promo Title (sama seperti sebelumnya)
        HomepageContent::updateOrCreate(
            ['section' => 'order_tools_title'],
            ['content' => ['title' => $request->input('order_tools_main_title'),'subtitle' => $request->input('order_tools_main_subtitle'),],'is_active' => $request->has('order_tools_title_is_active')]
        );
        HomepageContent::updateOrCreate(
            ['section' => 'order_tool_1'],
            ['content' => ['title' => $request->input('order_tool_1_title'),'description' => $request->input('order_tool_1_description'),'url' => $request->input('order_tool_1_url'),'icon_svg_path' => $request->input('order_tool_1_icon_svg_path')],'is_active' => $request->has('order_tool_1_is_active')]
        );
        HomepageContent::updateOrCreate(
            ['section' => 'order_tool_2'],
            ['content' => ['title' => $request->input('order_tool_2_title'),'description' => $request->input('order_tool_2_description'),'url' => $request->input('order_tool_2_url'),'icon_svg_path' => $request->input('order_tool_2_icon_svg_path')],'is_active' => $request->has('order_tool_2_is_active')]
        );
        HomepageContent::updateOrCreate(
            ['section' => 'faq_title'],
            ['content' => ['title' => $request->input('faq_main_title'),'subtitle' => $request->input('faq_main_subtitle'),],'is_active' => $request->has('faq_title_is_active')]
        );
        // Update FAQs
        $faqsData = [];
        if ($request->has('faqs') && is_array($request->input('faqs'))) {
            foreach ($request->input('faqs') as $faq_item) {
                if (is_array($faq_item) && isset($faq_item['q']) && isset($faq_item['a'])) {
                    $question = trim($faq_item['q']);
                    $answer = trim($faq_item['a']);
                    if ($question !== '' && $answer !== '') {
                        $faqsData[] = ['q' => $question, 'a' => $answer];
                    }
                }
            }
        }
        HomepageContent::updateOrCreate(
            ['section' => 'faqs'],
            ['content' => $faqsData, 'is_active' => $request->has('faqs_is_active')]
        );

        // Update Promo Title
        HomepageContent::updateOrCreate(
            ['section' => 'promo_title'],
            ['content' => ['title' => $request->input('promo_main_title'),'subtitle' => $request->input('promo_main_subtitle'),],'is_active' => $request->has('promo_title_is_active')]
        );
        // Update Promos
        $promosData = [];
        if ($request->has('promos') && is_array($request->input('promos'))) {
            foreach ($request->input('promos') as $promo_item) {
                if (is_array($promo_item) && isset($promo_item['title']) && isset($promo_item['desc'])) {
                    $promoTitleText = trim($promo_item['title']);
                    $promoDescText = trim($promo_item['desc']);
                    if ($promoTitleText !== '' && $promoDescText !== '') {
                        $promosData[] = ['title' => $promoTitleText, 'desc' => $promoDescText];
                    }
                }
            }
        }
        HomepageContent::updateOrCreate(
            ['section' => 'promos'],
            ['content' => $promosData, 'is_active' => $request->has('promos_is_active')]
        );

        return redirect()->route('admin.homepage.edit')->with('success', 'Konten homepage berhasil diperbarui!');
    }
}