<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($cities as $city)
    <?php 
   $cityName = str_replace(" ","-",$city->name);
    ?>
        <url>
            <loc>https://gocoworq.com/coworking-space/{{$cityName}}</loc>
           <?php if(!is_null($city->created_at) && is_set($city->created_at) ){ ?>
            <lastmod>{{ $city->created_at->tz('UTC')->toAtomString() }}</lastmod>
       <?php    } ?>
            <changefreq>weekly</changefreq>
            <priority>1</priority>
        </url>
    @endforeach
</urlset>