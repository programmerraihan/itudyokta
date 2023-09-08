@if ($sliders->isNotEmpty())
    <div id="carouselExampleDark" class="carousel carousel-dark slide hv-100" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @for ($i = 0; $i < $sliders->count(); $i++)
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $i }}"
                    class="@if ($i == 0) active @endif" aria-current="true"
                    aria-label="Slide 1"></button>
            @endfor
        </div>
        <div class="carousel-inner">
            @foreach ($sliders as $key => $slider)
                <div class="carousel-item @if ($key == 0) active @endif" style="height: 350px;"
                    data-bs-interval="10000">
                    <img src="{{ asset('frontend/slider/' . $slider->image) }}" class="d-block w-100"
                        alt="{{ $slider->image }}">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $slider->title }}</h5>
                        <p>{{ $slider->short_title }}</p>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif
