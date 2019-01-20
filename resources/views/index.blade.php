@extends('common')

@section('content')
<div class="row align-items-center">
    <div class="col-6 mx-auto col-md-6 order-md-2">
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="img-fluid mb-3 mb-md-0"
            width="512" height="430" viewBox="0 0 1024 860" focusable="false" role="img">
            <title>Bootstrap</title>
            <defs>
                <linearGradient id="c" x1="50%" x2="50%" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="#5C24AE"></stop>
                    <stop offset="100%" stop-color="#30135A"></stop>
                </linearGradient>
                <path id="b" d="M355.967 242.807l-322 216.395c-44.275 29.754-44.275 78.443 0 108.197l322 216.395c44.275 29.754 116.725 29.754 161 0l322-216.395c44.275-29.754 44.275-78.443 0-108.197l-322-216.395c-44.275-29.754-116.725-29.754-161 0z"></path>
                <filter id="a" width="108%" height="112%" x="-4%" y="-4.3%" filterUnits="objectBoundingBox">
                    <feOffset dy="10" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                    <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="10"></feGaussianBlur>
                    <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                </filter>
                <linearGradient id="f" x1="50%" x2="50%" y1="-17.303%" y2="100%">
                    <stop offset="0%" stop-color="#7331D4"></stop>
                    <stop offset="100%" stop-color="#461B84"></stop>
                </linearGradient>
                <path id="e" d="M355.967 132.807l-322 216.395c-44.275 29.754-44.275 78.443 0 108.197l322 216.395c44.275 29.754 116.725 29.754 161 0l322-216.395c44.275-29.754 44.275-78.443 0-108.197l-322-216.395c-44.275-29.754-116.725-29.754-161 0z"></path>
                <filter id="d" width="108%" height="112%" x="-4%" y="-4.3%" filterUnits="objectBoundingBox">
                    <feOffset dy="10" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                    <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="10"></feGaussianBlur>
                    <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                </filter>
                <linearGradient id="i" x1="50%" x2="50%" y1="0%" y2="100%">
                    <stop offset="0%" stop-color="#905BDD"></stop>
                    <stop offset="100%" stop-color="#5521A0"></stop>
                </linearGradient>
                <path id="h" d="M355.967 22.807l-322 216.395c-44.275 29.754-44.275 78.443 0 108.197l322 216.395c44.275 29.754 116.725 29.754 161 0l322-216.395c44.275-29.754 44.275-78.443 0-108.197l-322-216.395c-44.275-29.754-116.725-29.754-161 0z"></path>
                <filter id="g" width="108%" height="112%" x="-4%" y="-4.3%" filterUnits="objectBoundingBox">
                    <feOffset dy="10" in="SourceAlpha" result="shadowOffsetOuter1"></feOffset>
                    <feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="10"></feGaussianBlur>
                    <feColorMatrix in="shadowBlurOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
                </filter>
            </defs>
            <g fill="none">
                <g transform="translate(75 23)">
                    <use fill="#000" filter="url(#a)" xlink:href="#b"></use>
                    <use fill="url(#c)" xlink:href="#b"></use>
                </g>
                <g transform="translate(75 23)">
                    <use fill="#000" filter="url(#d)" xlink:href="#e"></use>
                    <use fill="url(#f)" xlink:href="#e"></use>
                </g>
                <g transform="translate(75 23)">
                    <use fill="#000" filter="url(#g)" xlink:href="#h"></use>
                    <use fill="url(#i)" xlink:href="#h"></use>
                </g>
                <path fill="#FFF" d="M558.273 447.667L308.036 279.5l97.982-65.847c42.83-28.784 96.789-31.483 134.245-6.311 26.044 17.502 31.214 46.615 11.444 65.724l1.389.934c38.324-19.932 84.107-18.527 117.396 3.845 44.046 29.6 38.671 68.419-14.561 104.193l-97.658 65.629zM447.112 331.01l49.942-33.562c36.935-24.822 42.31-48.249 15.224-66.451-24.798-16.665-55.49-14.453-85.851 5.95l-59.641 40.081 80.326 53.982zm176.532 35.663c37.63-25.289 42.136-48.832 13.203-68.276-28.932-19.444-64.163-15.614-104.042 11.186l-58.789 39.508 87.92 59.084 61.708-41.502z"></path>
            </g>
        </svg>
    </div>
    <div class="col-md-6 order-md-1 text-center text-md-left pr-md-5">
        <h1 class="mb-3 bd-text-purple-bright">Bootstrap</h1>
        <p class="lead">
            Build responsive, mobile-first projects on the web with the world’s most popular front-end component
            library.
        </p>
        <p class="lead mb-4">
            Bootstrap is an open source toolkit for developing with HTML, CSS, and JS. Quickly prototype your ideas or
            build your entire app with our Sass variables and mixins, responsive grid system, extensive prebuilt
            components, and powerful plugins built on jQuery.
        </p>
        <div class="row mx-n2">
            <div class="col-md px-2">
                <a href="/docs/4.2/getting-started/introduction/" class="btn btn-lg btn-bd-primary w-100 mb-3" onclick="ga('send', 'event', 'Jumbotron actions', 'Get started', 'Get started');">Get
                    started</a>
            </div>
            <div class="col-md px-2">
                <a href="/docs/4.2/getting-started/download/" class="btn btn-lg btn-outline-secondary w-100 mb-3"
                    onclick="ga('send', 'event', 'Jumbotron actions', 'Download', 'Download 4.2.1');">Download</a>
            </div>
        </div>
        <p class="text-muted mb-0">
            Currently v4.2.1
        </p>
    </div>
</div>
<script async="" src="https://cdn.carbonads.com/carbon.js?serve=CKYIKKJL&amp;placement=getbootstrapcom" id="_carbonads_js"></script>
<div id="carbonads"><span><span class="carbon-wrap"><a href="//srv.carbonads.net/ads/click/x/GTND42QWCAAIKKQUCT74YKQMCEADTK7YCASI6Z3JCWBDEKQIFTSIK2QKC6BIV277F67DEK3EHJNCLSIZ?segment=placement:getbootstrapcom;"
                class="carbon-img" target="_blank" rel="noopener"><img src="https://cdn4.buysellads.net/uu/1/42500/1546365873-1538007875-Monday-laptop_purple_graph.png"
                    alt="" border="0" height="100" width="130" style="max-width: 130px;"></a><a href="//srv.carbonads.net/ads/click/x/GTND42QWCAAIKKQUCT74YKQMCEADTK7YCASI6Z3JCWBDEKQIFTSIK2QKC6BIV277F67DEK3EHJNCLSIZ?segment=placement:getbootstrapcom;"
                class="carbon-text" target="_blank" rel="noopener">Project tracking, teamwork &amp; client reporting
                like you've never seen before.</a></span><a href="http://carbonads.net/?utm_source=getbootstrapcom&amp;utm_medium=ad_via_link&amp;utm_campaign=in_unit&amp;utm_term=carbon"
            class="carbon-poweredby" target="_blank" rel="noopener">ads via Carbon</a><img src="https://ad.doubleclick.net/ddm/trackimp/N728909.734586CARBONADS.NET/B20652854.212994676;dc_trk_aid=414618443;dc_trk_cid=104372716;ord=154799519;dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=?"
            border="0" height="1" width="1" style="display: none;"></span></div>


<a href="{{ route('generate') }}" class="btn btn-primary">早速、フォトダイビングログを生成する</a>
@endsection
