<div class="relative mt-3 w-full  text-base text-left  rounded-xl font-normal">
    <header class="py-3 px-4 text-2xl font-bold tracking-wide text-gray-700 dark:text-white">
        <h3> Top Blogs</h3>
    </header>
    <ul class="p-0 list-none">
        @foreach ($topBlogs as $topBlog)
            <li
                class="py-3 px-4  dark:hover:text-white hover:bg-gray-50 hover:shadow-sm dark:bg-gray-800 dark:hover:bg-gray-700">
               <x-cards.card-small :blog=$topBlog /> 
            </li>
        @endforeach
    </ul>
</div>
