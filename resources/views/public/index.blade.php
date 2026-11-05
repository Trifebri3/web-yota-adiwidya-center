@extends('public.layouts.app')

@section('title', 'Yayasan Yota Wujudkan Asa | SIYOTA.org — Inisiatif Berkelanjutan 6 Pilar')
@section('seo_title', 'Yayasan Yota Wujudkan Asa (SIYOTA) — Ketahanan Peradaban & 6 Pilar Aksi')
@section('seo_description', 'Yayasan Yota Wujudkan Asa adalah organisasi nirlaba nasional yang berfokus pada 6 pilar strategis: Youth Development, Community Empowerment, Environmental Conservation, Innovation & Research, Disaster Resilience, dan Knowledge & Publication.')
@section('og_image', asset('image/og-share.jpg'))

@section('content')

{{-- ========================================================================= --}}
{{-- 1. HERO SLIDER BERGAYA PERTAMINA FOUNDATION (ARTIKEL & INISIATIF UTAMA)    --}}
{{-- ========================================================================= --}}
@include('public.components.hero-pertamina-slider')

{{-- ========================================================================= --}}
{{-- 2. LIVE PROGRAM ACTIVE TRACKER (SUPER SIMPEL: GAMBAR, STATUS FASE, TOMBOL) --}}
{{-- ========================================================================= --}}
@include('public.components.active-programs-tracker')

{{-- ========================================================================= --}}
{{-- 3. 6 PILAR STRATEGIS + PETA SEBARAN GEOSPASIAL + KILASAN ISU & SDGS METRIK --}}
{{-- ========================================================================= --}}
@include('public.partials.impact-areas')

{{-- ========================================================================= --}}
{{-- 4. JALUR KOLABORASI STAKEHOLDER (HUMAN-CENTERED DESIGN / HCD USER PATHS)  --}}
{{-- ========================================================================= --}}
@include('public.components.stakeholder-journeys')

{{-- ========================================================================= --}}
{{-- 5. PUBLIKASI, BUKU & KAJIAN ILMIAH TERBUKA                                --}}
{{-- ========================================================================= --}}
@include('public.partials.publikasi')

{{-- ========================================================================= --}}
{{-- 7. INOVASI SOSIAL TEPAT GUNA (COMPACT PORTFOLIO)                          --}}
{{-- ========================================================================= --}}
@include('public.partials.product')

{{-- ========================================================================= --}}
{{-- 8. INFORMASI FAKTUAL RESMI & FAQ (GENERATIVE ENGINE OPTIMIZATION / GEO)    --}}
{{-- ========================================================================= --}}
@include('public.components.geo-faq')

{{-- ========================================================================= --}}
{{-- 9. DUKUNGAN AKSI & KAMPANYE SOSIAL                                        --}}
{{-- ========================================================================= --}}
@include('public.partials.crowdfunding')

{{-- ========================================================================= --}}
{{-- 10. SUARA MITRA & TESTIMONI LAPANGAN                                      --}}
{{-- ========================================================================= --}}
@include('public.partials.review')

{{-- ========================================================================= --}}
{{-- 11. JEJARING MITRA STRATEGIS                                              --}}
{{-- ========================================================================= --}}
@include('public.partials.mitra')

@endsection
