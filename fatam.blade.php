<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="...." />
    <meta name="author" content="misara adel" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>شركة ابن ماجد العامة</title>
    <link rel="shortcut icon" href="{{ asset('web_assets') }}/assets/images/logo/icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('web_assets') }}/assets/css/lib/animate.css" />
    <link rel="stylesheet" href="{{ asset('web_assets') }}/assets/css/lib/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('web_assets') }}/assets/css/style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .dropdown-submenu {
            position: relative;
            padding-inline-start: 15px;
            border-top: 1px solid #ddd;
        }
        
        .dropdown-submenu a {
            padding: 5px 0px;
            font-size: 13px !important;
        }
        
        .navbar .flex-data {
            display: flex;
            align-items: center;
            align-content: center;
            gap: 10px;
        }
        
        .navbar .flex-data .logo-data {
            width: 150px;
            height: 100px;
            object-fit: contain;
        }
        
        @media(max-width: 992px) {
            .navbar .flex-data {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    
   
    <nav class="navbar">
        <div class="data-nav">
            <div class="container">
                <div class="data-nav-contain">
                    <h1>
                         احدى تشكيلات وزارة الصناعة والمعادن
                    </h1>
                    
                    <ul>
                        <li>
                            <a href="#">
                                EN
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
      <div class="top-nav">
        <div class="container">
          <div class="top-nav-contain">
            <div class="hamburger">
               
              <span class="line"></span>
              <span class="line"></span>
              <span class="line"></span>
            </div>
   <div class="data">
           <img src="{{ asset('web_assets') }}/assets/images/ibnmaged_logo.png" loading="lazy" class="place" alt="" />

  
       <div style="text-align: center;">
    <h2 style="margin-bottom: 0;">شركة ابن ماجد العامة</h2>
    <h2 style="margin-top: 0;">Ibn Majid State Company</h2>
</div>


            </div>
  
            <div class="flex-data">
                <ul class="socail">
        <li>
          <a href="{{ $social->facebook }}">
            <img src="{{ asset('web_assets')}}/assets/images/footer/facebook.svg" loading="lazy" alt="Facebook" />
          </a>
        </li>

          <li>
                    <a href="{{ $social->instagram }}">
                        <img src="{{ asset('web_assets') }}/assets/images/footer/insta.svg" loading="lazy" alt="Instagram" />
                    </a>
                </li>

        <li>
          <a href="{{ $social->linked_in }}">
            <img src="{{ asset('web_assets') }}/assets/images/footer/linked.svg" loading="lazy" alt="LinkedIn" />
          </a>
        </li>

        <li>
          <a href="{{ $social->twitter }}">
            <img src="{{ asset('web_assets') }}/assets/images/footer/x.svg" loading="lazy" alt="Twitter" />
          </a>
        </li>

        <li>
          <a href="{{ $social->youtube }}">
            <img src="{{ asset('web_assets') }}/assets/images/footer/youtube.svg" loading="lazy" alt="YouTube" />
          </a>
        </li>

        <li>
          <a href="{{ $social->tiktok }}">
            <img src="{{ asset('web_assets') }}/assets/images/footer/tiktok.svg" loading="lazy" alt="TikTok" />
          </a>
        </li>
      </ul>
      
                <img src="{{ asset('web_assets') }}/assets/images/photo.jpg" class="logo-data" alt="" />
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="contain">
          <ul class="navbar-nav">
            
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                الوزير
              </a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <div class="has-sub-menu">
                  <a class="dropdown-item" href="#">
                    مكتبة الفيديوهات
                  </a>

                  <ul class="list">
                    <li>
                      <a href="#">
                        مكتبة الفيديوهات
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        مكتبة الفيديوهات
                      </a>
                    </li>

                    <li>
                      <a href="#">
                        مكتبة الفيديوهات
                      </a>
                    </li>
                  </ul>
                </div>

                <a class="dropdown-item" href="#">
                  مكتبة الفيديوهات
                </a>
              </div>
            </li>
            
           <li class="nav-item">
              <a href="{{ route('index') }}" class="nav-link active">
                الرئيسية
              </a>
            </li>


            <li class="nav-item">
              <a href="{{ route('about') }}" class="nav-link">
                عن الشركة
              </a>
            </li>
    @foreach ($pages as $page)
        @if ($page->childPages->count() > 0)
            <li class="nav-item dropdown">
                <a href="{{ route('single_page', [$page->id]) }}" class="nav-link dropdown-toggle" id="navbarDropdown{{ $page->id }}" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ $page->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown{{ $page->id }}">
                    @foreach ($page->childPages as $childPage)
                        @if ($childPage->subpages->count() == 0)
                            <li>
                                <a class="dropdown-item" href="{{ route('single_page', [$childPage->id]) }}">{{ $childPage->name }}</a>
                            </li>
                        @else
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ $childPage->name }}</a>
                                <ul class="dropdown-menu">
                                    @foreach ($childPage->subpages as $subpage)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('single_page', [$subpage->id]) }}">{{ $subpage->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @else
            <li class="nav-item">
                @if ($page->page_type == 1)
                    <a href="{{ route('single_page', [$page->id]) }}" class="nav-link">{{ $page->name }}</a>
                @else
                    <a href="{{ $page->link }}" class="nav-link">{{ $page->name }}</a>
                @endif
            </li>
        @endif
    @endforeach



  <li class="nav-item">
    <a href="{{ route('news') }}" class="nav-link">الأخبار</a>
</li>
                  <li class="nav-item">
    <a href="{{ route('tenders') }}" class="nav-link {{ request()->routeIs('tenders') ? 'active' : '' }}">المناقصات</a>
</li>
 
            <li class="nav-item">
              <a href="{{ route('contactus') }}" class="nav-link">
                تواصل معنا
              </a>
            </li>

          </ul>
        </div>
      </div>
    </nav>

   

