<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($spaces as $space)
        <url>
            <loc>https://gocoworq.com/{{ $space->city->name}}/coworking-space/{{$space->url}}</loc>
            <lastmod>{{ $space->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>