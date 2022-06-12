@extends('user.layouts.main')

@section('container')

{{-- <div class="container-sm mb-3 min-vh-100"> --}}
{{-- <div class="container-sm mb-3 min-vh-100"> --}}
<section id="section1">
    <div class="container">
        <h1 class="fw-normal pt-5 pb-2 border-bottom">About Cofftea</h1>
        <div class="row pt-4 justify-content-between">
            <div class="col-12 col-lg-7">
                <h3 class="featurred-heading">A Place for You to Find Coffee Beans & Tea Leaf</h3>
                <p class="fs-5 fw-normal text-justify">Cofftea is a shop located in Jakarta that sells coffee beans and tea products. In addition to selling products in stores, we also sell these products online through this website to make it easier for buyers to make transactions. The Cofftea e-commerce website provides various features such as shopping carts and various payment methods to provide convenience for buyers. Currently, the Cofftea e-commerce website is still limited to only serving orders in the Jakarta area.</p>
            </div>
            <div class="col-12 col-lg-5 text-center">
                <img src="/img/about-1.jpg" alt="" class="img-fluid w-100" style="min-width: 20rem; max-width: 27rem;">
                {{-- <img src="https://source.unsplash.com/1280x720?cafe" alt="" class="img-fluid w-100" style="min-width: 20rem; max-width: 27rem;"> --}}
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#a2d9ff" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,197.3C384,192,480,128,576,85.3C672,43,768,21,864,42.7C960,64,1056,128,1152,154.7C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
</section>

<section id="section2" style="background-color: #a2d9ff">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-5 order-2 order-lg-1">
                <img src="/img/about-2.jpg" alt="" class="img-fluid w-100" style="min-width: 20rem; max-width: 27rem;">
                {{-- <img src="https://source.unsplash.com/1280x720?coffee-plantation" alt="" class="img-fluid w-100" style="min-width: 20rem; max-width: 27rem;"> --}}
            </div>
            <div class="col-12 col-lg-7 order-1 order-lg-2">
                <h3 class="featurred-heading">We Ensure Every Product is Quality</h3>
                <p class="fs-5 fw-normal text-justify">By working closely with local farmers from various regions in Indonesia, we hope to produce the best selection of coffee and tea beans and introduce authentic local products widely. The packaging process is also carried out in a hygienic manner to maintain product quality.</p>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#fff" fill-opacity="1" d="M0,160L48,170.7C96,181,192,203,288,224C384,245,480,267,576,250.7C672,235,768,181,864,165.3C960,149,1056,171,1152,181.3C1248,192,1344,192,1392,192L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
    </svg>
</section>

<section id="section3">
    <div class="container">
        <div class="row mb-2 justify-content-between">
            <div class="col-12 col-lg-5 mb-4">
                <h2 class="fs-3 fw-bolder mb-2"><i class="fas fa-address-book"></i> Contact Us</h2>
                <address class="fs-5 fw-normal">
                    <span class="d-block fw-bold">Address:</span>
                    <p>Jl. Casablanca Raya Kav. 88, Menteng Dalam, Kec. Tebet, Daerah Khusus Ibukota Jakarta 12870.
                    </p>
                    <span class="d-block fw-bold">Contact:</span>
                    <p> <i class="fab fa-whatsapp"></i> : 0812 1243 2358</p>
                    <p> <i class="far fa-envelope"></i> : cofftea@gmail.com
                    </p>
                </address>
            </div>
            <div class="col-12 col-lg-6">
                <p class="fs-5 text-start">Check our store location here!</p>
                <div class="mapouter">
                    <div class="gmap_canvas text-start"><iframe width="500" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=kota%20kasablanka&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://123movies-to.org"></a><br>
                        <style>
                            .mapouter {
                                position: relative;
                                text-align: right;
                                height: 500px;
                                width: 600px;
                            }

                        </style>
                        <style>
                            .gmap_canvas {
                                overflow: hidden;
                                background: none !important;
                                height: 500px;
                                width: 600px;
                            }

                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- <section> --}}
{{-- <div class="container">
    <div class="row justify-content-around">
        <div class="col-12 col-md-6">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos architecto mollitia ipsa fuga et provident deleniti quo laboriosam quam repudiandae. Temporibus cum cumque blanditiis id? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, voluptatem odio harum veritatis quae, commodi praesentium exercitationem non aliquid dicta, laborum nemo illo numquam eum tempora consectetur ullam. Praesentium ducim.</p>
        </div>
        <div class="col-12 col-md-4">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos architecto mollitia ipsa fuga et provident deleniti quo laboriosam quam repudiandae. Temporibus cum cumque blanditiis id? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, voluptatem odio harum veritatis quae, commodi praesentium exercitationem non aliquid dicta, laborum nemo illo numquam eum tempora consectetur ullam. Praesentium ducimus voluptas quaerat? Consequatur ratione veniam, sint sit ipsa, dolorum veritatis aspernatur fugiat quae sed laudantium hic voluptat</p>
        </div>
    </div>
</div> --}}
{{-- </section> --}}

{{-- <section> --}}
{{-- <div class="container">
    <div class="row justify-content-around">
        <div class="col-12 col-md-6">
            <img src="https://source.unsplash.com/1200x720?cafe" alt="" class="img-fluid" style="max-height: 20rem; max-width: 20rem;">
        </div>
        <div class="col-12 col-md-4">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos architecto mollitia ipsa fuga et provident deleniti quo laboriosam quam repudiandae. Temporibus cum cumque blanditiis id? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, voluptatem odio harum veritatis quae, commodi praesentium exercitationem non aliquid dicta, laborum nemo illo numquam eum tempora consectetur ullam. Praesentium ducimus voluptas quaerat? Consequatur ratione veniam, sint sit ipsa, dolorum veritatis aspernatur fugiat quae sed laudantium hic voluptates qui, blanditiis mollitia magnam dolores eum est sequi architecto sunt modi iusto! Quod voluptatibus, molestias minus reprehenderit nemo aliquam quos illo fuga amet beatae veritatis laudantium quis magni ut! Recusandae eligendi tempore reiciendis dolores ab dicta facere aut nostrum officiis omnis qui laudantium, impedit dolor amet voluptates labore, a ad debitis? Dolores, veritatis.</p>
        </div>
    </div>
</div> --}}
{{-- </section> --}}

{{-- <section> --}}
{{-- <div class="container">
    <div class="row justify-content-around">
        <div class="col-12 col-md-6">
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos architecto mollitia ipsa fuga et provident deleniti quo laboriosam quam repudiandae. Temporibus cum cumque blanditiis id? Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, voluptatem odio harum veritatis quae, commodi praesentium exercitationem non aliquid dicta, laborum nemo illo numquam eum tempora consectetur ullam. Praesentium ducimus voluptas quaerat? Consequatur ratione veniam, sint sit ipsa, dolorum veritatis aspernatur fugiat quae sed laudantium hic voluptates qui, blanditiis mollitia magnam dolores eum est sequi architecto sunt modi iusto! Quod voluptatibus, molestias minus reprehenderit nemo aliquam quos illo fuga amet beatae veritatis laudantium quis magni ut! Recusandae eligendi tempore reiciendis dolores ab dicta facere aut nostrum officiis omnis qui laudantium, impedit dolor amet voluptates labore, a ad debitis? Dolores, veritatis.</p>
        </div>
        <div class="col-12 col-md-4">
            <img src="https://source.unsplash.com/1200x720?cafe" alt="" class="img-fluid" style="max-height: 20rem; max-width: 20rem;">
        </div>
    </div>
</div> --}}
{{-- </section> --}}

@endsection
