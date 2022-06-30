<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://gocoworq.com/about_us</loc>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gocoworq.com</loc>
        <changefreq>daily</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gocoworq.com/privacyPolicy</loc>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gocoworq.com/upgrade</loc>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    <url>
        <loc>https://gocoworq.com/terms</loc>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    @foreach ($cities as $city)
    <?php
    $cityName = str_replace(" ", "-", $city->name);
    ?>
    <url>
        <loc>https://gocoworq.com/coworking-spaces/{{strtolower($cityName)}}</loc>
        <?php if (!is_null($city->created_at) && is_set($city->created_at)) { ?>
            <lastmod>{{ $city->created_at->tz('UTC')->toAtomString() }}</lastmod>
        <?php } ?>
        <changefreq>weekly</changefreq>
        <priority>1</priority>
    </url>
    @endforeach
    @foreach ($spaces as $space)
        <url>
            <loc>https://gocoworq.com/{{strtolower($space->city->name)}}/coworking-space/{{strtolower($space->url)}}</loc>
            <lastmod>{{ $space->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>