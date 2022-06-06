@extends('layouts.blog')

@section('content')
    <main class="global-main">
        <article class="blog-section">
            <section class="pb-4">
                <div class="bg-white border rounded-5">
                    <section class="p-4 text-center w-100">
                        <button class="e-btn e-btn-info">click to get some info</button>
                        <div class="e-card e-card-primary">
                            <div class="e-card-body">
                                <p>In summary, we&rsquo;ve introduced graphs and have seen how they are used to
                                    represent the relationship between objects. We also reviewed a few ways to configure
                                    a graph and the components used to describe different models. With our model
                                    defined, we&rsquo;ve set the stage for more advanced functionality, including graph
                                    navigation and traversal algorithms like breadth-first search.</p>
                            </div>
                        </div>
                    </section>
                    <div class="p-4 text-center border-top mobile-hidden">
                        <a class="btn btn-link px-3" data-mdb-toggle="collapse" href="#example1" role="button"
                            aria-expanded="false" aria-controls="example1" data-ripple-color="hsl(0, 0%, 67%)">
                            <i class="fas fa-code me-md-2"></i>
                            <span class="d-none d-md-inline-block">
                                Show code
                            </span>
                        </a>
                    </div>
                </div>
            </section>

            <section class="collapse show" id="example1" style="">
                <section class="pb-4">
                    <div class="docs-pills border mobile-hidden">
                        <div class="d-flex justify-content-between py-2" style="padding-left: .6rem;">
                            <ul class="nav nav-pills p-2">
                                <li class="nav-item">
                                    <a class="modern-badge modern-badge-danger active show " data-mdb-toggle="tab"
                                        href="#mdb_5614650e6b0ea66112f3f12318b6d219db770fb2" role="tab">HTML
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade  active show " id="mdb_5614650e6b0ea66112f3f12318b6d219db770fb2"
                                role="tabpanel">
                                <div class="code-toolbar">
                                    <pre class="grey default-pre lighten-3 mb-0 line-numbers  language-html">
                                        <code class="langauge-html">
                                            &lt;button class=&quot;e-btn e-btn-info&quot;&gt;click to get some info&lt;/button&gt;
                                            &lt;div class=&quot;e-card e-card-primary&quot;&gt;
                                                &lt;div class=&quot;e-card-body&quot;&gt;
                                                    &lt;p&gt;In summary, we&amp;rsquo;ve introduced graphs and have seen how they are used to
                                                        represent the relationship between objects. We also reviewed a few ways to configure
                                                        a graph and the components used to describe different models. With our model
                                                        defined, we&amp;rsquo;ve set the stage for more advanced functionality, including graph
                                                        navigation and traversal algorithms like breadth-first search.&lt;/p&gt;
                                                &lt;/div&gt;
                                            &lt;/div&gt;
                                        </code>
                                    </pre>
                                    <div class="toolbar">
                                        <div class="toolbar-item"><span>html</span></div>
                                        <div class="toolbar-item"><button class="copy-to-clipboard-button" type="button"
                                                data-copy-state="copy"><span>Copy</span></button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </article>
    </main>
@endsection
