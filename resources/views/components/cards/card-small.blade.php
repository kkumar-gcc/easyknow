@props(['blog'])
<div
    {{ $attributes->merge(['class' => 'relative  w-full text-base text-left  sm:p-1   font-normal']) }}>
    <div class="flex  items-stretch justify-center flex-row">
        <div class="basis-3/4 relative leading-normal sm:mt-0 sm:pr-2">
            <a href="/blogs/{{ Str::slug($blog->title, '-') }}-{{ $blog->id }}" class="link link-secondary">
                <h5 class="text-md font-bold line-clamp-3  tracking-wide ">
                    {{ $blog->title() }}
                </h5>
                <div class="text-sm"> <time datetime="{{ $blog->created_at }}">
                    {{ \Carbon\Carbon::parse($blog->created_at)->format('M d, Y') }}
                </time>
                ∙ {{ $blog->readTime() }} mins read</div>
            </a>
        </div>
        <div
            class="basis-1/4 relative text-center max-h-fit {{ $blog->adult_warning ? 'prose prose-img:blur-lg' : '' }}">
            <img class="block relative w-full h-full rounded-xl  object-cover shadow-md hover:shadow-sm "
                src="https://miro.medium.com/max/1000/1*xRj13VgftcCYP2ppVFmGTw.png" alt="">
        </div>
    </div>
</div>
