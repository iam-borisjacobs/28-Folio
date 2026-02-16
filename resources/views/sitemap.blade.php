<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach($languages as $lang)
        <url>
            <loc>{{ route('home', ['locale' => $lang->code]) }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>
        <url>
            <loc>{{ route('projects.index', ['locale' => $lang->code]) }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ route('blog.index', ['locale' => $lang->code]) }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
        <url>
            <loc>{{ route('contact', ['locale' => $lang->code]) }}</loc>
            <lastmod>{{ date('Y-m-d') }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.5</priority>
        </url>

        @foreach ($projects as $project)
            @php $slug = $project->translated('slug', $lang->code); @endphp
            @if($slug)
            <url>
                <loc>{{ route('projects.show', ['slug' => $slug, 'locale' => $lang->code]) }}</loc>
                <lastmod>{{ $project->updated_at->format('Y-m-d') }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.6</priority>
            </url>
            @endif
        @endforeach

        @foreach ($posts as $post)
            @php $slug = $post->translated('slug', $lang->code); @endphp
            @if($slug)
            <url>
                <loc>{{ route('blog.show', ['slug' => $slug, 'locale' => $lang->code]) }}</loc>
                <lastmod>{{ $post->updated_at->format('Y-m-d') }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.6</priority>
            </url>
            @endif
        @endforeach
    @endforeach
</urlset>
