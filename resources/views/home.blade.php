<x-layouts.app-layout>
    <section class="container mx-auto px-4 py-12">
        <div class="mb-10 text-center md:text-left">
            <h1 class="text-3xl font-extrabold text-white">Welcome to the Home Page</h1>
            <p class="text-neutral-400 mt-2 text-base">Explore the latest articles published by our community writers.</p>
        </div>

        @if(isset($blogs) && $blogs->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($blogs as $blog)
                    <div class="bg-neutral-900 border border-neutral-800 rounded-2xl p-6 shadow-xl flex flex-col justify-between transition hover:border-neutral-700">
                        <div>
                            <div class="flex justify-between items-center text-xs text-neutral-400 mb-3">
                                <span>By <strong class="text-neutral-200">{{ $blog->author }}</strong></span>
                                <span>{{ $blog->created_at->format('M d, Y') }}</span>
                            </div>
                            
                            <h2 class="text-xl font-bold text-white mb-3 hover:text-blue-400 transition">
                                <a href="{{ route('blogs.show', $blog->id) }}">
                                    {{ $blog->title }}
                                </a>
                            </h2>
                            
                            <p class="text-neutral-400 text-sm line-clamp-3 mb-6 leading-relaxed">
                                {{ $blog->content }}
                            </p>
                        </div>
                        
                        <div>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="inline-flex items-center gap-1 bg-blue-600/20 hover:bg-blue-600/30 text-blue-400 text-xs font-semibold px-4 py-2 rounded-xl transition">
                                Read More &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16 bg-neutral-900 border border-neutral-800 rounded-2xl">
                <p class="text-neutral-400 text-base">No blog posts available yet.</p>
                <p class="text-sm text-neutral-500 mt-1">Check back soon for new content!</p>
            </div>
        @endif
    </section>
</x-layouts.app-layout>