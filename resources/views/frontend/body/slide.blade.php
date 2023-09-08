<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

    @php $i =1; @endphp
    <div class="carousel-inner">

        {{-- @dd($slider); --}}



        @foreach ($slider as $sliderItem)
            <div class="carousel-item {{ $i == '1' ? 'active' : '' }}">

                @php $i++; @endphp

                <a href="{{ $sliderItem->link_image }}">

                    <img src="{{ asset('frontend/slider/' . $sliderItem->image) }}" class="d-block w-100"
                        alt="slider Image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $sliderItem->title }}</h5>
                        <p>{{ $sliderItem->short_title }}</p>
                        {{-- <a href="{{ $sliderItem->link_image }}">More Information</a> --}}
                    </div>
                </a>
            </div>
        @endforeach


    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
