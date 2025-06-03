@extends('admin.layouts.admin') {{-- Pastikan ini layout admin yang benar --}}

@section('title', 'Edit Konten Homepage - Gasify Admin')
@section('page_title', 'Edit Konten Homepage')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Edit Konten Homepage</h1>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Hero Section --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Hero Section</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="hero_title" class="form-label">Judul Hero</label>
                        <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $hero->content['title'] ?? '') }}" class="form-control">
                        <small class="form-text text-muted">Gunakan <code>&lt;span class="text-success"&gt;teks hijau&lt;/span&gt;</code>.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hero_subtitle" class="form-label">Subjudul Hero</label>
                        <input type="text" name="hero_subtitle" id="hero_subtitle" value="{{ old('hero_subtitle', $hero->content['subtitle'] ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hero_button_text" class="form-label">Teks Tombol</label>
                        <input type="text" name="hero_button_text" id="hero_button_text" value="{{ old('hero_button_text', $hero->content['button_text'] ?? '') }}" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hero_button_url" class="form-label">URL Tombol</label>
                        <input type="text" name="hero_button_url" id="hero_button_url" value="{{ old('hero_button_url', $hero->content['button_url'] ?? '') }}" class="form-control" placeholder="/order/create">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="hero_image_url" class="form-label">URL Gambar Hero Saat Ini</label>
                        <input type="text" name="hero_image_url" id="hero_image_url" value="{{ old('hero_image_url', $hero->content['image_url'] ?? '') }}" class="form-control bg-light" readonly>
                        @if(isset($hero->content['image_url']) && $hero->content['image_url'])
                            <img src="{{ Str::startsWith($hero->content['image_url'], 'http') ? $hero->content['image_url'] : asset($hero->content['image_url']) }}" alt="Hero Image Preview" class="mt-2 img-thumbnail" style="max-height: 150px;">
                        @endif
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="hero_image_new" class="form-label">Upload Gambar Hero Baru (Opsional)</label>
                        <input type="file" name="hero_image_new" id="hero_image_new" class="form-control">
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="hero_is_active" id="hero_is_active" value="1" class="form-check-input" {{ ($hero && $hero->is_active) ? 'checked' : '' }}>
                    <label for="hero_is_active" class="form-check-label">Aktifkan Hero Section</label>
                </div>
            </div>
        </div>

        {{-- Order Tools Section --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order Tools Section</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="order_tools_main_title" class="form-label">Judul Utama Order Tools</label>
                    <input type="text" name="order_tools_main_title" id="order_tools_main_title" value="{{ old('order_tools_main_title', $orderToolsTitle->content['title'] ?? '') }}" class="form-control">
                    <small class="form-text text-muted">Gunakan <code>&lt;span class="text-success"&gt;teks hijau&lt;/span&gt;</code>.</small>
                </div>
                <div class="mb-3">
                    <label for="order_tools_main_subtitle" class="form-label">Subjudul Utama Order Tools</label>
                    <textarea name="order_tools_main_subtitle" id="order_tools_main_subtitle" rows="2" class="form-control">{{ old('order_tools_main_subtitle', $orderToolsTitle->content['subtitle'] ?? '') }}</textarea>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="order_tools_title_is_active" id="order_tools_title_is_active" value="1" class="form-check-input" {{ ($orderToolsTitle && $orderToolsTitle->is_active) ? 'checked' : '' }}>
                    <label for="order_tools_title_is_active" class="form-check-label">Aktifkan Judul Order Tools</label>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="border p-3 rounded mb-3">
                            <h5 class="mb-3">Order Tool 1</h5>
                            <div class="mb-3">
                                <label for="order_tool_1_title" class="form-label">Judul</label>
                                <input type="text" name="order_tool_1_title" id="order_tool_1_title" value="{{ old('order_tool_1_title', $orderTool1->content['title'] ?? '') }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="order_tool_1_description" class="form-label">Deskripsi</label>
                                <input type="text" name="order_tool_1_description" id="order_tool_1_description" value="{{ old('order_tool_1_description', $orderTool1->content['description'] ?? '') }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="order_tool_1_url" class="form-label">URL</label>
                                <input type="text" name="order_tool_1_url" id="order_tool_1_url" value="{{ old('order_tool_1_url', $orderTool1->content['url'] ?? '') }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="order_tool_1_icon_svg_path" class="form-label">SVG Path Icon (d="...")</label>
                                <textarea name="order_tool_1_icon_svg_path" id="order_tool_1_icon_svg_path" rows="2" class="form-control">{{ old('order_tool_1_icon_svg_path', $orderTool1->content['icon_svg_path'] ?? '') }}</textarea>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="order_tool_1_is_active" id="order_tool_1_is_active" value="1" class="form-check-input" {{ ($orderTool1 && $orderTool1->is_active) ? 'checked' : '' }}>
                                <label for="order_tool_1_is_active" class="form-check-label">Aktifkan Order Tool 1</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                         <div class="border p-3 rounded mb-3">
                            <h5 class="mb-3">Order Tool 2</h5>
                            <div class="mb-3">
                                <label for="order_tool_2_title" class="form-label">Judul</label>
                                <input type="text" name="order_tool_2_title" id="order_tool_2_title" value="{{ old('order_tool_2_title', $orderTool2->content['title'] ?? '') }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="order_tool_2_description" class="form-label">Deskripsi</label>
                                <input type="text" name="order_tool_2_description" id="order_tool_2_description" value="{{ old('order_tool_2_description', $orderTool2->content['description'] ?? '') }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="order_tool_2_url" class="form-label">URL</label>
                                <input type="text" name="order_tool_2_url" id="order_tool_2_url" value="{{ old('order_tool_2_url', $orderTool2->content['url'] ?? '') }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="order_tool_2_icon_svg_path" class="form-label">SVG Path Icon (d="...")</label>
                                <textarea name="order_tool_2_icon_svg_path" id="order_tool_2_icon_svg_path" rows="2" class="form-control">{{ old('order_tool_2_icon_svg_path', $orderTool2->content['icon_svg_path'] ?? '') }}</textarea>
                            </div>
                             <div class="form-check">
                                <input type="checkbox" name="order_tool_2_is_active" id="order_tool_2_is_active" value="1" class="form-check-input" {{ ($orderTool2 && $orderTool2->is_active) ? 'checked' : '' }}>
                                <label for="order_tool_2_is_active" class="form-check-label">Aktifkan Order Tool 2</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- FAQ Section --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">FAQ Section</h6>
                <button type="button" id="add-faq-item" class="btn btn-sm btn-success">Tambah FAQ</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="faq_main_title" class="form-label">Judul Utama FAQ</label>
                    <input type="text" name="faq_main_title" id="faq_main_title" value="{{ old('faq_main_title', $faqTitle->content['title'] ?? '') }}" class="form-control">
                     <small class="form-text text-muted">Gunakan <code>&lt;span class="text-success"&gt;teks hijau&lt;/span&gt;</code>.</small>
                </div>
                <div class="mb-3">
                    <label for="faq_main_subtitle" class="form-label">Subjudul Utama FAQ</label>
                    <textarea name="faq_main_subtitle" id="faq_main_subtitle" rows="2" class="form-control">{{ old('faq_main_subtitle', $faqTitle->content['subtitle'] ?? '') }}</textarea>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="faq_title_is_active" id="faq_title_is_active" value="1" class="form-check-input" {{ ($faqTitle && $faqTitle->is_active) ? 'checked' : '' }}>
                    <label for="faq_title_is_active" class="form-check-label">Aktifkan Judul FAQ</label>
                </div>
                <hr>
                <h6 class="mt-3 mb-3">List FAQ Items</h6>
                <div id="faq-items-container">
                    @php
                        // Ambil data dari $faqs->content jika old('faqs') tidak ada (bukan setelah validation error)
                        $faq_items_to_display = old('faqs', ($faqs && $faqs->content && is_iterable($faqs->content)) ? $faqs->content : []);
                    @endphp

                    @if(count($faq_items_to_display) > 0)
                        @foreach ($faq_items_to_display as $index => $faq_item_data)
                        <div class="faq-item border p-3 rounded mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">FAQ Item</h6> {{-- Bisa diganti dengan $faq_item_data['q'] jika mau --}}
                                <button type="button" class="btn btn-sm btn-danger remove-faq-item">&times; Hapus</button>
                            </div>
                            <div class="mb-3">
                                <label for="faq_q_{{ $index }}" class="form-label">Pertanyaan</label>
                                <input type="text" name="faqs[{{ $index }}][q]" id="faq_q_{{ $index }}" 
                                       value="{{ $faq_item_data['q'] ?? '' }}" class="form-control">
                            </div>
                            <div>
                                <label for="faq_a_{{ $index }}" class="form-label">Jawaban</label>
                                <textarea name="faqs[{{ $index }}][a]" id="faq_a_{{ $index }}" rows="3" 
                                          class="form-control">{{ $faq_item_data['a'] ?? '' }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted" id="no-faq-message">Belum ada FAQ. Klik "Tambah FAQ" untuk memulai.</p>
                    @endif
                </div>
                 <div class="form-check mt-3">
                    <input type="checkbox" name="faqs_is_active" id="faqs_is_active" value="1" class="form-check-input" {{ ($faqs && $faqs->is_active) ? 'checked' : '' }}>
                    <label for="faqs_is_active" class="form-check-label">Aktifkan List FAQ Keseluruhan</label>
                </div>
            </div>
        </div>

        {{-- Promo Section --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Promo Section</h6>
                <button type="button" id="add-promo-item" class="btn btn-sm btn-success">Tambah Promo</button>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="promo_main_title" class="form-label">Judul Utama Promo</label>
                    <input type="text" name="promo_main_title" id="promo_main_title" value="{{ old('promo_main_title', $promoTitle->content['title'] ?? '') }}" class="form-control">
                    <small class="form-text text-muted">Gunakan <code>&lt;span class="text-success"&gt;teks hijau&lt;/span&gt;</code>.</small>
                </div>
                <div class="mb-3">
                    <label for="promo_main_subtitle" class="form-label">Subjudul Utama Promo</label>
                    <textarea name="promo_main_subtitle" id="promo_main_subtitle" rows="2" class="form-control">{{ old('promo_main_subtitle', $promoTitle->content['subtitle'] ?? '') }}</textarea>
                </div>
                 <div class="form-check mb-3">
                    <input type="checkbox" name="promo_title_is_active" id="promo_title_is_active" value="1" class="form-check-input" {{ ($promoTitle && $promoTitle->is_active) ? 'checked' : '' }}>
                    <label for="promo_title_is_active" class="form-check-label">Aktifkan Judul Promo</label>
                </div>
                <hr>
                <h6 class="mt-3 mb-3">List Promo Items</h6>
                <div id="promo-items-container">
                    @php
                        $promo_items_to_display = old('promos', ($promos && $promos->content && is_iterable($promos->content)) ? $promos->content : []);
                    @endphp

                    @if(count($promo_items_to_display) > 0)
                        @foreach ($promo_items_to_display as $index => $promo_item_data)
                        <div class="promo-item border p-3 rounded mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h6 class="mb-0">Promo Item</h6> {{-- Bisa diganti dengan $promo_item_data['title'] jika mau --}}
                                <button type="button" class="btn btn-sm btn-danger remove-promo-item">&times; Hapus</button>
                            </div>
                            <div class="mb-3">
                                <label for="promo_title_{{ $index }}" class="form-label">Judul Promo</label>
                                <input type="text" name="promos[{{ $index }}][title]" id="promo_title_{{ $index }}" 
                                       value="{{ $promo_item_data['title'] ?? '' }}" class="form-control">
                            </div>
                            <div>
                                <label for="promo_desc_{{ $index }}" class="form-label">Deskripsi Promo</label>
                                <textarea name="promos[{{ $index }}][desc]" id="promo_desc_{{ $index }}" rows="2" 
                                          class="form-control">{{ $promo_item_data['desc'] ?? '' }}</textarea>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted" id="no-promo-message">Belum ada Promo. Klik "Tambah Promo" untuk memulai.</p>
                    @endif
                </div>
                <div class="form-check mt-3">
                    <input type="checkbox" name="promos_is_active" id="promos_is_active" value="1" class="form-check-input" {{ ($promos && $promos->is_active) ? 'checked' : '' }}>
                    <label for="promos_is_active" class="form-check-label">Aktifkan List Promo Keseluruhan</label>
                </div>
            </div>
        </div>

        <div class="mt-4 mb-3">
            <button type="submit" class="btn btn-primary btn-lg">
                Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

@push('admin_scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const faqContainer = document.getElementById('faq-items-container');
    const addFaqButton = document.getElementById('add-faq-item');
    // Menggunakan variabel $faqs yang dikirim dari controller
    let faqIndex = {{ count(old('faqs', ($faqs && $faqs->content && is_iterable($faqs->content)) ? $faqs->content->all() : [])) }};
    console.log('Initial faqIndex from Blade:', faqIndex);

    // Sembunyikan pesan "Belum ada FAQ" jika sudah ada item dari server
    const noFaqMsg = document.getElementById('no-faq-message');
    if (noFaqMsg && faqIndex > 0) {
        noFaqMsg.style.display = 'none';
    }

    if (addFaqButton) {
        addFaqButton.addEventListener('click', function () {
            const newItemHtml = `
                <div class="faq-item border p-3 rounded mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">FAQ Item Baru</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-faq-item">&times; Hapus</button>
                    </div>
                    <div class="mb-3">
                        <label for="faq_q_${faqIndex}" class="form-label">Pertanyaan</label>
                        <input type="text" name="faqs[${faqIndex}][q]" id="faq_q_${faqIndex}" class="form-control">
                    </div>
                    <div>
                        <label for="faq_a_${faqIndex}" class="form-label">Jawaban</label>
                        <textarea name="faqs[${faqIndex}][a]" id="faq_a_${faqIndex}" rows="3" class="form-control"></textarea>
                    </div>
                </div>`;
            faqContainer.insertAdjacentHTML('beforeend', newItemHtml);
            if (noFaqMsg) { // Sembunyikan pesan jika ada setelah item baru ditambahkan
                noFaqMsg.style.display = 'none';
            }
            faqIndex++;
        });
    }

    if (faqContainer) {
        faqContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-faq-item')) {
                e.target.closest('.faq-item').remove();
                // Tampilkan pesan "Belum ada FAQ" jika semua item dihapus
                if (noFaqMsg && faqContainer.querySelectorAll('.faq-item').length === 0) {
                    noFaqMsg.style.display = 'block';
                }
            }
        });
    }

    // Promo Item Management
    const promoContainer = document.getElementById('promo-items-container');
    const addPromoButton = document.getElementById('add-promo-item');
    // Menggunakan variabel $promos yang dikirim dari controller
    let promoIndex = {{ count(old('promos', ($promos && $promos->content && is_iterable($promos->content)) ? $promos->content->all() : [])) }};
    console.log('Initial promoIndex from Blade:', promoIndex);

    const noPromoMsg = document.getElementById('no-promo-message');
    if (noPromoMsg && promoIndex > 0) {
        noPromoMsg.style.display = 'none';
    }

    if (addPromoButton) {
        addPromoButton.addEventListener('click', function () {
            const newItemHtml = `
                <div class="promo-item border p-3 rounded mb-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="mb-0">Promo Item Baru</h6>
                        <button type="button" class="btn btn-sm btn-danger remove-promo-item">&times; Hapus</button>
                    </div>
                    <div class="mb-3">
                        <label for="promo_title_${promoIndex}" class="form-label">Judul Promo</label>
                        <input type="text" name="promos[${promoIndex}][title]" id="promo_title_${promoIndex}" class="form-control">
                    </div>
                    <div>
                        <label for="promo_desc_${promoIndex}" class="form-label">Deskripsi Promo</label>
                        <textarea name="promos[${promoIndex}][desc]" id="promo_desc_${promoIndex}" rows="2" class="form-control"></textarea>
                    </div>
                </div>`;
            promoContainer.insertAdjacentHTML('beforeend', newItemHtml);
            if (noPromoMsg) {
                noPromoMsg.style.display = 'none';
            }
            promoIndex++;
        });
    }

    if (promoContainer) {
        promoContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-promo-item')) {
                e.target.closest('.promo-item').remove();
                if (noPromoMsg && promoContainer.querySelectorAll('.promo-item').length === 0) {
                    noPromoMsg.style.display = 'block';
                }
            }
        });
    }
});
</script>
@endpush