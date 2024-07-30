<footer class="footer__section footer__bg">
    <div class="container">
        <div class="main__footer section--padding">
            <div class="row ">
                <div class="col-lg-6 col-md-8">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title d-none d-sm-u-block">HEAD OFFICE
                            <button class="footer__widget--button" aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                 width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                      transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <div class="footer__widget--inner">
                            <p class="footer__widget--desc"><b>
                                    HEAD OFFICE </b></p><br>
                            <div class="footer__logo">
                                <a class="footer__logo--link" href="{{url('/')}}">
                                    <img class="footer__logo--img" src="{{asset('images/top_logo.png')}}" width="95px"
                                         alt="logo-img">
                                </a>
                            </div>
                            <p class="footer__widget--desc">
                                {{$about->nama}} </p>
                            <p class="footer__widget--desc">
                                <a href="mailto:{{$about->website}}">{{$about->website}}</a>
                            </p>
                            <ul class="footer__widget--info">
                                <li class="footer__widget--info_list">
                                    <svg class="footer__widget--info__icon" width="20" height="23" viewBox="0 0 20 23"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M18.3334 10.1666C18.3334 14.769 10.0001 20.9999 10.0001 20.9999C10.0001 20.9999 1.66675 14.769 1.66675 10.1666C1.66675 5.56421 5.39771 1.83325 10.0001 1.83325C14.6025 1.83325 18.3334 5.56421 18.3334 10.1666Z"
                                              stroke="currentColor" stroke-width="2"></path>
                                        <ellipse cx="10.0001" cy="10.1667" rx="2.5" ry="2.5" stroke="currentColor"
                                                 stroke-width="2"></ellipse>
                                    </svg>
                                    <span class="footer__widget--info__text">{{$about->address}}</span>
                                </li>
                                <li class="footer__widget--info_list">
                                    <svg class="footer__widget--info__icon" width="20" height="20" viewBox="0 0 20 20"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.31 1.52371L18.6133 2.11296C18.6133 2.11296 19.2026 7.41627 13.31 13.3088C7.41748 19.2014 2.11303 18.6133 2.11303 18.6133L1.52377 13.31L5.64971 10.9529L7.71153 13.0148C7.71153 13.0148 9.18467 12.7201 10.9524 10.9524C12.7202 9.18461 13.0148 7.71147 13.0148 7.71147L10.953 5.64965L13.31 1.52371Z"
                                              stroke="currentColor" stroke-width="2"></path>
                                    </svg>
                                    <a class="footer__widget--info__text"
                                       href="tel:+{{$about->phone}}">: {{$about->phone}}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title d-none d-sm-u-block">Our Social Media and Online Store
                            <button class="footer__widget--button" aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                 width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                      transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <div class="footer__widget--inner">
                            <p class="footer__widget--desc"><b>
                                    Our Social Media and Online Store </b></p><br>
                            <ul class="footer__widget--info">
                                @foreach($sosmed as $sm)
                                    <li class="footer__widget--info_list">
                                        <img src="{{$sm->image}}" alt="" width="50px">
                                        <a class="footer__widget--info__text" href="{{$sm->link}}">{{$sm->username}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</footer>
