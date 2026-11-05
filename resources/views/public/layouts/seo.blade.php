<title>@yield('seo_title', 'Yota Adiwidya Center | Engineering Resilience')</title>
<meta name="description" content="@yield('seo_description', 'Lembaga sosial nasional di bawah Yayasan Yota Wujudkan Asa. Fokus pada pemberdayaan STEAM dan mitigasi bencana.')">
<meta name="keywords" content="NGO Bandung, Yota Adiwidya Center, Yayasan Yota Wujudkan Asa, STEAM Indonesia, Baleendah">
<meta name="author" content="Yota Adiwidya Center">
<meta name="robots" content="index, follow">

<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:title" content="@yield('seo_title', 'Yota Adiwidya Center')">
<meta property="og:description" content="Membangun Arsitek Peradaban melalui STEAM dan Kearifan Lokal di Baleendah, Bandung.">
<meta property="og:image" content="{{ asset('image/og-image.jpg') }}">

<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ url()->current() }}">
<meta property="twitter:title" content="Yota Adiwidya Center">
<meta property="twitter:image" content="{{ asset('image/og-image.jpg') }}">

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NGO",
  "name": "Yota Adiwidya Center",
  "alternateName": "Yayasan Yota Wujudkan Asa",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('image/logo.png') }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Perumahan Jatimekar residence, Blk. C No.26, Malakasari",
    "addressLocality": "Baleendah",
    "addressRegion": "Kabupaten Bandung",
    "postalCode": "40375",
    "addressCountry": "ID"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+62-851-1771-3303",
    "contactType": "customer service",
    "email": "yotaadiwidyacenter@gmail.com"
  }
}
</script>
