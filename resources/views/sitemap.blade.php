<?xml version='1.0' encoding='UTF-8'?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($Products as $post)
        <url>
            <loc>{{route('producthomename',$post->url)}}</loc>
            <lastmod>{{ $post->created_at->format('Y-m-d'); }}</lastmod>
        </url>
    @endforeach
</urlset>