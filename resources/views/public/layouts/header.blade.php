<div x-data="{ mobileMenuOpen: false }">
    <div class="hidden xl:block">
        @include('public.layouts.pc')
    </div>

    <div class="xl:hidden">
        @include('public.layouts.mobileheader')
    </div>
</div>
