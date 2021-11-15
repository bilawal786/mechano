<!--=====================================-->
<!--=        Footer Area Start       	=-->
<!--=====================================-->
<footer class="footer-area">
    <div class="container">
        <div class="footer-top">
            <div class="footer-social-link">
                <ul class="list-unstyled">
                    <li><a href="https://facebook.com/" data-sal="slide-up" data-sal-duration="500" data-sal-delay="100"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://www.linkedin.com/" data-sal="slide-up" data-sal-duration="500" data-sal-delay="400"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="https://www.instagram.com/" data-sal="slide-up" data-sal-duration="500" data-sal-delay="500"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom" data-sal="slide-up" data-sal-duration="500" data-sal-delay="100">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-copyright">
                        <span class="copyright-text">© {{ ucfirst($settings->company_name)}} {{ \Carbon\Carbon::now()->year }}. All rights reserved by <a href="https://ikaedigital.com/">IkaeDigital</a>.</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-link">
                        <ul class="list-unstyled">
                            @foreach ($pages as $page)
                                @if ($page->id !== 2)
                                    <li><a href="{{ route('front.page', $page->slug) }}">{{ $page->title }}</a></li>
                                @else
                                    @php
                                        $contactPageSlug = $page->slug;
                                        $contactPageTitle = $page->title;
                                    @endphp
                                @endif
                            @endforeach
                            <li><a href="{{ route('front.page', $contactPageSlug) }}">{{ $contactPageTitle }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
