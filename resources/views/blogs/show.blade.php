<x-layouts.app-layout>
    <section class="container mx-auto px-4 py-12 max-w-3xl">
        
        <!-- Back Button -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-neutral-400 hover:text-white transition">
                &larr; Back to Home
            </a>
        </div>

        <!-- Blog Post Card -->
        <article class="bg-neutral-900 border border-neutral-800 rounded-2xl p-8 shadow-xl space-y-6">
            
            <!-- Title -->
            <h1 class="text-3xl md:text-4xl font-extrabold text-white leading-tight">
                {{ $blog->title }}
            </h1>

            <!-- Meta Information -->
            <div class="flex items-center gap-4 text-sm text-neutral-400 border-y border-neutral-800 py-4">
                <div>
                    <span>Written by </span>
                    <strong class="text-neutral-200 font-semibold">{{ $blog->author }}</strong>
                </div>
                <span>&bull;</span>
                <div>
                    <span>Published on </span>
                    <time datetime="{{ $blog->created_at }}" class="text-neutral-200">{{ $blog->created_at->format('M d, Y') }}</time>
                </div>
            </div>

            <!-- Content Body -->
            <div class="text-neutral-300 leading-relaxed space-y-4 whitespace-pre-line text-base">
                {{ $blog->content }}
            </div>

        </article>

    </section>
</x-layouts.app-layout>