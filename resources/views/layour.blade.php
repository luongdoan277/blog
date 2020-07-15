<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Portfolio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900|Cormorant+Garamond:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<header>
    <a href="{{route('product.index')}}" class="header-brand">mmtuts</a>
    <nav>
        <ul>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">About me</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <a href="#" class="header-cases">Cases</a>
    </nav>
</header>
<main>
    @yield('main')
</main>
<footer>
    <div class="container">
        <ul class="footer-links-main">
            <li><a href="#">Home</a></li>
            <li><a href="#">Cases</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">About me</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
        <ul class="footer-links-cases">
            <li><p>Latest cases</p></li>
            <li><a href="#">MALING SHAOLIN - WEB DEVELOPMENT</a></li>
            <li><a href="#">EXCELLENTO - WEB DEVELOPMENT, SEO</a></li>
            <li><a href="#">MMTUTS - YOUTUBE CHANNEL</a></li>
            <li><a href="#">WELTEC - VIDEO PRODUCTION</a></li>
        </ul>
        <div class="footer-sm">
            <a href="#">
                <img src="{{asset('img/youtube-symbol.png')}}" alt="youtube icon">
            </a>
            <a href="#">
                <img src="{{asset('img/twitter-logo-button.png')}}" alt="youtube icon">
            </a>
            <a href="#">
                <img src="{{asset('img/facebook-logo-button.png')}}" alt="youtube icon">
            </a>
        </div>
    </div>
</footer>
<script src="node_modules/typeahead.js/dist/typeahead.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function($) {
        const engine1 = new Bloodhound({
            remote: {
                url: '/search/name?value=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        const engine2 = new Bloodhound({
            remote: {
                url: '/search/id?value=%QUERY%',
                wildcard: '%QUERY%'
            },
            datumTokenizer: Bloodhound.tokenizers.whitespace('value'),
            queryTokenizer: Bloodhound.tokenizers.whitespace
        });

        $(".search-input").typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, [
            {
                source: engine1.ttAdapter(),
                name: 'product-name',
                display: function(data) {
                    return data.name;
                },
                templates: {
                    empty: [
                        '<div class="header-title">Name</div><div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="header-title">Name</div><div class="list-group search-results-dropdown"></div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="/product/' + data.id + '" class="list-group-item">' + data.name + '</a>';
                    }
                }
            },
            {
                source: engine2.ttAdapter(),
                id: 'product-id',
                display: function(data) {
                    return data.id;
                },
                templates: {
                    empty: [
                        '<div class="header-title">Id</div><div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                    ],
                    header: [
                        '<div class="header-title">Id</div><div class="list-group search-results-dropdown"></div>'
                    ],
                    suggestion: function (data) {
                        return '<a href="/product/' + data.id + '" class="list-group-item">' + data.id + '</a>';
                    }
                }
            }
        ]);
    });
</script>
</body>
</html>
