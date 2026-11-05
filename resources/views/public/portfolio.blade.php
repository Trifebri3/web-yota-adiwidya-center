@extends('public.partialsporto.appporto')


@section('content')

    {{-- 1. HERO & IDENTITY --}}
    <section id="about">
        @include('public.partialsporto._identity_form')
    </section>

    {{-- 2. PROFESSIONAL JOURNEY --}}
    <section id="experience">
        @include('public.partialsporto._experience_manager')
    </section>

    {{-- 3. TECHNICAL EXPERTISE --}}
    <section id="skills">
        @include('public.partialsporto._skills_manager')

        {{-- Additional Skills diletakkan di bawah Skills utama agar padu --}}
        <div class="mt-5">
            @include('public.partialsporto._additional_skills_manager')
        </div>
    </section>


@endsection
