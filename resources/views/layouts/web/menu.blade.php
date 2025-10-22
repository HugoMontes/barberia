<div class="main-menu f-right d-none d-lg-block">
    <nav>
        <ul id="navigation">
            <li class="{{ request()->routeIs('web.index') ? 'active' : '' }}">
                <a href="{{ route('web.index') }}">Home</a>
            </li>
            <li class="{{ request()->routeIs('web.about') ? 'active' : '' }}">
                <a href="{{ route('web.about') }}">About</a>
            </li>
            <li><a href="services.html">Services</a></li>
            <li><a href="portfolio.html">Portfolio</a></li>
            <li><a href="blog.html">Blog</a>
                <ul class="submenu">
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="blog_details.html">Blog Details</a></li>
                    <li><a href="elements.html">Element</a></li>
                </ul>
            </li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
</div>
<div class="header-right-btn f-right d-none d-lg-block ml-30">
    <a href="from.html" class="btn header-btn">became a member</a>
</div>
