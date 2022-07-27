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
                            <div class="tab-panel fade  active show" id="mdb_5614650e6b0ea66112f3f12318b6d219db770fb2"
                                role="tabpanel">
                                <div class="code-toolbar">
                                    <pre class="anguage-html">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </section>
        </article>
        <section id="subsection-text-align">
            <!--Subsection title-->
            <h4 class="mt-5">Text align</h4>
      
            <!--Description-->
            <p>Use following code to align spinner center.</p>
      
            <!--Section: Demo-->
            <section class="pb-4">
        <div class="bg-white border rounded-5">
          
            <section class="p-4 text-center w-100">
              <div class="text-center">
                <div class="spinner-border" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>
            </section>
            
          
          
          <div class="p-4 text-center border-top mobile-hidden">
            <a class="btn btn-link px-3" data-mdb-toggle="collapse" href="#example11" role="button" aria-expanded="true" aria-controls="example11" data-ripple-color="hsl(0, 0%, 67%)" style="">
              <i class="fas fa-code me-md-2"></i>
              <span class="d-none d-md-inline-block">
                Show code
              </span>
            </a>
            
            
              <a class="btn btn-link px-3 " data-ripple-color="hsl(0, 0%, 67%)">
                <i class="fas fa-file-code me-md-2 pe-none"></i>
                <span class="d-none d-md-inline-block export-to-snippet pe-none">
                  Edit in sandbox
                </span>
              </a>
            
          </div>
          
          
        </div>
      </section>
      
            <!--Section: Demo-->
      
            <!--Section: Code-->
            <!-- prettier-ignore -->
            <section class="collapse show" id="example11" style="">
              <section class="pb-4">
                
      
      
      
      
      
        
      
        <div class="docs-pills border mobile-hidden">
          <div class="d-flex justify-content-between py-2" style="padding-left: .6rem;">
            <ul class="nav nav-pills p-2">
              
                
                
                <li class="nav-item"><a class="nav-link  active show " data-mdb-toggle="tab" href="#mdb_6cb639b0308c87492ef6b0b13f627c0309c369d3" role="tab">HTML</a></li>
              
            </ul>
          </div>
          <div class="tab-content">
            
                  
      
      
      
      
      <div class="tab-pane fade  active show " id="mdb_6cb639b0308c87492ef6b0b13f627c0309c369d3" role="tabpanel">
          <div class="code-toolbar"><pre class="grey lighten-3 mb-0 line-numbers  language-html"><code class=" language-html"><span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>text-center<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
        <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>div</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>spinner-border<span class="token punctuation">"</span></span> <span class="token attr-name">role</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>status<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>
          <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;</span>span</span> <span class="token attr-name">class</span><span class="token attr-value"><span class="token punctuation">=</span><span class="token punctuation">"</span>visually-hidden<span class="token punctuation">"</span></span><span class="token punctuation">&gt;</span></span>Loading...<span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>span</span><span class="token punctuation">&gt;</span></span>
        <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span>
      <span class="token tag"><span class="token tag"><span class="token punctuation">&lt;/</span>div</span><span class="token punctuation">&gt;</span></span><span aria-hidden="true" class="line-numbers-rows"><span></span><span></span><span></span><span></span><span></span></span></code></pre><div class="toolbar"><div class="toolbar-item"><button class="btn-copy-code btn btn-dark btn-sm" data-mdb-ripple-color="dark" data-mdb-ripple-unbound="true">Copy</button></div></div></div>
      </div>
      
                
          </div>
        </div>
      
        
      
      
      
              </section>
            </section>
            <!--Section: Code-->
          </section>
    </main>
@endsection
